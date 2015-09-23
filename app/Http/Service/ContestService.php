<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/23
 * Time: 下午3:13
 */

namespace Gemini\Http\Service;


use Gemini\Model\Problem;
use Gemini\Model\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
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


}