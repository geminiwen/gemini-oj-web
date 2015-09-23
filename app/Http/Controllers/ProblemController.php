<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/20
 * Time: 下午12:55
 */

namespace Gemini\Http\Controllers;


use Gemini\Facades\AMQP;
use Gemini\Model\Problem;
use Gemini\Model\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ProblemController extends Controller{

    public function index() {
        $problems = Problem::paginate(20, ["id", "title", "accept", "submit"]);
        $response = [
            "problems" => $problems
        ];
        return view("problem.index", $response);
    }

    public function detail($id) {
        $problem = Problem::find($id);
        $response = [
            "problem" => $problem
        ];

        return view("problem.detail", $response);
    }

    public function submitForm($id) {
        $problem = Problem::find($id, ["id", "title"]);
        $response = [
            "problem" => $problem
        ];

        return view("problem.submit", $response);
    }

    public function submit(Request $request, $id) {

        $suffix = [
            "c" => ".c",
            "cpp" => ".cpp",
            "java" => ".java",
            "javascript" => ".js"
        ];

        $code = $request->input("code");
        $language = $request->input("language");

        DB::transaction(function () use ($id, $code, $language, $suffix) {
            $user = Auth::user();
            $userId = $user->id;

            $status = Status::create([
                "user_id" => $userId,
                "problem_id" => $id,
                "language" => $language,
                "code" => $code
            ]);
            $sid = $status->id;
            $problem = Problem::find($id);
            $problem->submit = $problem->submit + 1;
            $problem->save();


            $workDir = storage_path("tmp") . uniqid(time());
            mkdir($workDir);

            $args = NULL;
            if ($language == "java") {
                $execPath = "java";
                $args = ["java", "-classpath", $workDir, "Judge"];
                $sourcePath = $workDir . "/Judge.java";
            } else {
                $execPath = $workDir . "/" . uniqid(time());
                $sourcePath = $execPath . $suffix[$language];
            }

            $outputPath = $workDir . "/". uniqid(time());

            $sourceFileHandle = fopen($sourcePath, 'w');
            fwrite($sourceFileHandle, $code);
            fclose($sourceFileHandle);

            $sourcePath = realpath($sourcePath);

            $message = [
                "userId" => $userId,
                "problemId" => $id,
                "statusId" => $sid,
                "args" => $args,
                "sourceFile" => $sourcePath,
                "workDir" => $workDir,
                "execFile" => $execPath,
                "language" => $language,
                "inputFile" => $problem['input_file'],
                "outputFile" => $outputPath,
                "sampleFile" => $problem['output_file'],
                "timeLimit" => $problem['time_limit'],
                "memoryLimit" => $problem['memory_limit']
            ];

            $mqConnection = AMQP::get3FacadeRoot();
            $mqConnection->connect();
            $channel = new \AMQPChannel($mqConnection);
            $exchange = new \AMQPExchange($channel);
            $exchange->publish(json_encode($message),
                "grunner",
                AMQP_NOPARAM,
                ["content_type" => "application/json"]);
        });

        return redirect("/status");

    }
}