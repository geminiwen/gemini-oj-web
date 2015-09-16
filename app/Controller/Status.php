<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/15
 * Time: 上午8:06
 */

namespace Gemini\Controller;


use Gemini\Result\Twig;
use L8\Mvc\Controller\AbstractController;

class Status extends AbstractController {
    public function index($page = 1) {
        $statusDAO = new \Gemini\Model\Status();
        $statusList = $statusDAO->asValue(
            $statusDAO->listAll($page, 30),
            ['id', 'problem_id', 'result', 'language', 'time_used', 'memory_used', 'create_time',
                'user' => ['id', 'username']]
        );

        $response = [
            "statusList" => $statusList
        ];


        return new Twig("status/index.twig", $response);

    }

}