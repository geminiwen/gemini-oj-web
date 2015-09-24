<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/23
 * Time: 下午3:13
 */

namespace Gemini\Http\Service;


use Gemini\Facades\AMQP;
use Gemini\Model\Problem;
use Gemini\Model\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContestService {

    public function getProblemListByContestId($id, $columns = ['*'], $pageCount = 20) {
        $tableName = "contest_problem_" .hash("md5", $id);
        $query = DB::table($tableName);

        if ($pageCount != NULL) {
            $total = $query->getCountForPagination();

            $query->forPage(
                $page = Paginator::resolveCurrentPage("page"),
                $perPage = $pageCount
            );

            $items = $query->get($columns);
            return new LengthAwarePaginator($items, $total, $perPage, $page, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => "page",
            ]);
        } else {
            $items = $query->get($columns);
            return $items;
        }

    }

    public function getProblem($id, $pid, $columns = ['*']) {
        $tableName = "contest_problem_" .hash("md5", $id);
        $query = DB::table($tableName);

        $query->where("id", $pid);
        return $query->first($columns);
    }

    public function problemStatus($id, $pid, $column = ["*"], $pageCount = 20) {
        $hashId = hash("md5", $id);
        $statusTableName = "contest_status_" . $hashId;
        $problemTableName = "contest_problem_" . $hashId;
        $query = DB::table($statusTableName)->where("problem_id", $pid);
        $total = $query->getCountForPagination();

        $query->forPage(
            $page = Paginator::resolveCurrentPage("page"),
            $perPage = $pageCount
        );

        $items = $query->get($column);
        foreach ($items as $item) {
            $pid = $item->problem_id;
            $uid = $item->user_id;

            $item->problem = DB::table($problemTableName)->find($pid);
            $item->user = User::find($uid);
        }

        return new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => "page",
        ]);
    }

    public function status($id, $column = ["*"], $pageCount = 20) {
        $hashId = hash("md5", $id);
        $statusTableName = "contest_status_" . $hashId;
        $problemTableName = "contest_problem_" . $hashId;
        $query = DB::table($statusTableName);
        $total = $query->getCountForPagination();

        $query->forPage(
            $page = Paginator::resolveCurrentPage("page"),
            $perPage = $pageCount
        );

        $items = $query->get($column);
        foreach ($items as $item) {
            $pid = $item->problem_id;
            $uid = $item->user_id;

            $item->problem = DB::table($problemTableName)->find($pid);
            $item->user = User::find($uid);
        }

        return new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => "page",
        ]);
    }

    public function rankList($id, $column = ['*'], $pageCount = 20) {
        $hashId = hash("md5", $id);
        $rankListTableName = "contest_ranklist_" . $hashId;

        $query = DB::table($rankListTableName);
        $query->distinct();
        $total = $query->getCountForPagination(["user_id"]);

        $query->forPage(
            $page = Paginator::resolveCurrentPage("page"),
            $perPage = $pageCount
        );

        $userIds = $query->get(['user_id']); //先搜出所有的用户

        $items = [];
        foreach ($userIds as $uid) {
            $uid = $uid->user_id;
            $items[$uid] = [];
            $items[$uid]['user'] =  User::find($uid, ['id', 'username']);
            $items[$uid]['problem'] = DB::table($rankListTableName)->where("user_id", $uid)->get(); //搜出这些用户对应的解题
        }

        usort($items, function ($a, $b) {
            $calc = function ($item) {
                $sum = 0;
                foreach ($item['problem'] as $p) {
                    if ($p->time_used != NULL) {
                        $sum += 10000;
                    }
                    $sum -= 0.01 * ($p->attempt);
                    $sum = $sum < 0? 0 : $sum;
                }
                return $sum;
            };

            $sumA = $calc($a);
            $sumB = $calc($b);
            return $sumB - $sumA;
        });

        return new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => "page",
        ]);
    }

    public function submit($code, $language, $pid, $id) {
        $suffix = [
            "c" => ".c",
            "cpp" => ".cpp",
            "java" => ".java",
            "javascript" => ".js"
        ];
        DB::transaction(function () use ($pid, $id, $code, $language, $suffix) {
            $user = Auth::user();
            $userId = $user->id;

            $hashId = hash("md5", $id);
            $statusTableName = "contest_status_" . $hashId;
            $problemTableName = "contest_problem_" . $hashId;

            $sid = DB::table($statusTableName)
                ->inserGetId([
                    "user_id" => $userId,
                    "problem_id" => $id,
                    "language" => $language,
                    "code" => $code
                ]);

            $query = DB::table($problemTableName);
            $problem = $query->find($pid);
            $query->increment("submit");

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
                "problemId" => $pid,
                "contestId" => $id,
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

            $mqConnection = AMQP::getFacadeRoot();
            $mqConnection->connect();
            $channel = new \AMQPChannel($mqConnection);
            $exchange = new \AMQPExchange($channel);
            $exchange->publish(json_encode($message),
                "grunner",
                AMQP_NOPARAM,
                ["content_type" => "application/json"]);
        });
    }


}