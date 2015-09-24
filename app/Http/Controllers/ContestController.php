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
use Illuminate\Http\Request;

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

    public function decryptForm($id) {
        $response = [
            "id" => $id
        ];

        return view("contest.decrypt", $response);
    }

    public function decrypt(Request $request, $id)  {
        $contest = Contest::find($id);
        $password = $contest->password;
        //TODO check input

        $inputPassword = $request->input("password");

        $hashId = "contest_id_" . hash("sha1", $id);

        if ($password == $inputPassword) {
            $request->session()->put($hashId, $password);
            return redirect()->intended("/contest");
        } else {
            return response("password error", 404);
        }
    }

    public function submit(Request $request, $id, $pid) {
        $code = $request->input("code", "");
        $language = $request->input("language", "");
        //TODO check input
        $contestService = new ContestService();
        $contestService->submit($code, $language, $pid, $id);
        $url = sprintf("/contest/%d/status", $id);
        return redirect($url);

    }
}