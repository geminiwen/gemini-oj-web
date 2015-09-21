<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/20
 * Time: 下午2:04
 */

namespace Gemini\Http\Controllers;


use Gemini\Model\Status;

class StatusController extends Controller{

    public function index() {
        $statusList = Status::orderBy("id", "desc")
                              ->paginate(20, ['id', 'problem_id', 'result', 'user_id', 'language', 'time_used', 'memory_used', 'create_time']);

        $response = [
            'statusList'=> $statusList
        ];
        return view("status/index", $response);
    }

    public function problem($id) {
        $statusList = Status::where("problem_id", $id)
                              ->orderBy("id", "desc")
                              ->paginate(20, ['id', 'problem_id', 'result', 'user_id', 'language', 'time_used', 'memory_used', 'create_time']);
        $response = [
            'statusList'=> $statusList
        ];
        return view("status/index", $response);
    }
}