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

    public function getProblemListByCId($id,$pageCount) {
        $tableName = "contest_problem_" .hash("md5", $id);
        $column = ["id", "title", "accept", "submit"];
        $query = DB::table($tableName);
        $total = $query->getCountForPagination();

        $query->forPage(
            $page = Paginator::resolveCurrentPage("page"),
            $perPage = $pageCount
        );

        $items = $query->get($column);
        return new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => "page",
        ]);
    }

    public function getProblem($id, $pid, $columns = ['*']) {
        $tableName = "contest_problem_" .hash("md5", $id);
        $query = DB::table($tableName);

        $query->where("id", $pid);
        return $query->first($columns);
    }

    public function getStatus($id, $pid, $column = ["*"], $pageCount = 20) {
        $tableName = "contest_status_" .hash("md5", $id);
        $query = DB::table($tableName)->where("problem_id", $pid);
        $total = $query->getCountForPagination();

        $query->forPage(
            $page = Paginator::resolveCurrentPage("page"),
            $perPage = $pageCount
        );

        $items = $query->get($column);
        foreach ($items as $item) {
            $pid = $item->problem_id;
            $uid = $item->user_id;

            $item->problem = Problem::find($pid);
            $item->user = User::find($uid);
        }

        return new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => "page",
        ]);
    }


}