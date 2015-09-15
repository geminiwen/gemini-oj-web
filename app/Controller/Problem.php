<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/14
 * Time: 下午3:14
 */

namespace Gemini\Controller;


use Gemini\Model\Status;
use Gemini\Result\Twig;
use L8\App;
use L8\Helper\Globals;
use L8\Mvc\Controller\AbstractController;
use L8\Mvc\Result\Redirect;

class Problem extends AbstractController {
    use Globals;

    public function detail($id) {
        $problemDAO = new \Gemini\Model\Problem();
        $problem = $problemDAO->asValue(
            $problemDAO->get($id),
            [
                "id", "title", "description", "input", "output", "sample_input", "sample_output",
                "time_limit", "memory_limit", "accept", "submit"
            ]
        );

        $response = [
            "problem" => $problem
        ];

        return new Twig("problem/index.twig", $response);
    }

    public function submitForm($id) {
        $problemDAO = new \Gemini\Model\Problem();
        $problem = $problemDAO->asValue(
            $problemDAO->get($id),
            ["id", "title"]
        );

        $response = [
            "problem" => $problem
        ];
        return new Twig("problem/submit.twig", $response);
    }

    public function submit($id, $language, $code) {
        $statusDAO = new Status();
        $problemDAO = new \Gemini\Model\Problem();

        $status = $statusDAO->add([
           "problem_id" => $id,
           "language" => $language,
           "code" => $code
        ]);

        $statusId = $status['id'];

        $suffix = [
            "c" => ".c",
            "cpp" => ".cpp",
            "java" => ".java",
            "javascript" => ".js"
        ];

        $problem = $problemDAO->get($id);
        $submit = $problem['submit'] + 1;
        $problemDAO->setById($id, ['submit' => $submit]);

        $workDir = App::prop("exec.tmp.dir") . uniqid(time());
        mkdir($workDir);
        $workDir = $this->truepath($workDir);

        $args = NULL;
        if ($language == "java") {
            $execPath = "java";
            $args = ["java", "-classpath", $workDir, "Judge"];
            $sourcePath = $workDir . "/Judge.java";
        } else {
            $execPath = $workDir . "/" . uniqid(time());
            $execPath = $this->truepath($execPath);
            $sourcePath = $execPath . $suffix[$language];
        }

        $outputPath = $workDir . "/". uniqid(time());

        $sourceFileHandle = fopen($sourcePath, 'w');
        fwrite($sourceFileHandle, $code);
        fclose($sourceFileHandle);

        $sourcePath = realpath($sourcePath);
        $outputPath = $this->truepath($outputPath);

        $message = [
            "problemId" => $id,
            "statusId" => $statusId,
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

        $mqConnection = $this("amqp");
        $mqConnection->connect();
        $channel = new \AMQPChannel($mqConnection);
        $exchange = new \AMQPExchange($channel);
        $exchange->publish(json_encode($message),
                           "grunner",
                           AMQP_NOPARAM,
                           ["content_type" => "application/json"]);
        return new Redirect("/status/index");

    }

    private function truepath($path) {
        // whether $path is unix or not
        $unipath = strlen($path) == 0 || $path{0} != '/';
        // attempts to detect if path is relative in which case, add cwd
        if (strpos($path, ':') === false && $unipath)
            $path = getcwd() . DIRECTORY_SEPARATOR . $path;
        // resolve path parts (single dot, double dot and double delimiters)
        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
        $absolutes = array();
        foreach ($parts as $part) {
            if ('.' == $part) continue;
            if ('..' == $part) {
                array_pop($absolutes);
            } else {
                $absolutes[] = $part;
            }
        }
        $path = implode(DIRECTORY_SEPARATOR, $absolutes);
        // resolve any symlinks
        if (file_exists($path) && linkinfo($path) > 0) $path = readlink($path);
        // put initial separator that could have been lost
        $path = !$unipath ? '/' . $path : $path;
        return $path;
    }
}