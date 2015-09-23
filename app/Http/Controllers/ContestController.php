<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/23
 * Time: 下午2:55
 */

namespace Gemini\Http\Controllers;


use Gemini\Http\Service\ContestService;
use Gemini\Model\Contest;

class ContestController extends Controller
{
    public function index() {
        $contests = Contest::paginate(20, ["id", "title", "start_time", "is_secret"]);
        $response = [
            "contests" => $contests
        ];

        return view("contest.index", $response);
    }

    public function detail($id) {
        $contestService = new ContestService();
        $problems = $contestService->getProblemListByContestId($id, ["id", "title", "accept", "submit"]);
        $response = [
            "problems" => $problems,
            "id" => $id
        ];
        return view("contest.problem_list", $response);
    }

    public function problem($id, $pid) {
        $contestService = new ContestService();
        $problem = $contestService->getProblem($id, $pid);
        $response = [
            "problem" => $problem,
            "id" => $id
        ];
        return view("contest.problem_detail", $response);
    }

    public function submitForm($id, $pid) {
        $contestService = new ContestService();
        $problem = $contestService->getProblem($id, $pid, ["id", "title"]);
        $response = [
            "problem" => $problem,
            "id" => $id
        ];

        return view("contest.problem_submit", $response);
    }

    public function problemStatus($id, $pid) {
        $contestService = new ContestService();
        $statusList = $contestService->problemStatus($id, $pid);
        $response = [
            "statusList" => $statusList,
            "id" => $id
        ];

        return view("contest.status", $response);
    }

    public function status($id) {
        $contestService = new ContestService();
        $statusList = $contestService->status($id);
        $response = [
            "statusList" => $statusList,
            "id" => $id
        ];

        return view("contest.status", $response);
    }

    public function rankList($id) {
        $contestService = new ContestService();
        $rankList = $contestService->rankList($id);
        $problemList = $contestService->getProblemListByContestId($id, ['id'], NULL);

        $response = [
            "rankList" => $rankList,
            "problems" => $problemList,
            "id" => $id,
        ];

        return view("contest.rank_list", $response);
    }
}