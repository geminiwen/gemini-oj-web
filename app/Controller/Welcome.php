<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/14
 * Time: 下午12:32
 */

namespace Gemini\Controller;


use Gemini\Model\Problem;
use Gemini\Result\Twig;
use L8\Mvc\Controller\AbstractController;

class Welcome extends AbstractController
{
    public function index($page = 1) {
        $problemDAO = new Problem();
        $pageSize = 20;
        $problemList = $problemDAO->asValue(
            $problemDAO->listAll($page, $pageSize),
            ["id", "title", "accept", "submit"]
        );

        $problemCount = $problemDAO->count();
        $response =  [
            "problems" => $problemList,
            "page" => $page,
            "pageSize" => $pageSize,
            "total" => $problemCount
        ];

        return new Twig("index.twig", $response);
    }
}