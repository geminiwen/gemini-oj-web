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
        $pageSize = 30;

        $statusList = $statusDAO->asValue(
            $statusDAO->listAll($page, $pageSize),
            ['id', 'problem_id', 'result', 'language', 'time_used', 'memory_used', 'create_time',
                'user' => ['id', 'username']]
        );

        $statusCount = $statusDAO->count();

        $pageCount = ceil($statusCount / $pageSize);
        $response = [
            "statusList" => $statusList,
            "page" => $page,
            "pageCount" => $pageCount
        ];


        return new Twig("status/index.twig", $response);

    }

}