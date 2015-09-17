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
        $pageSize = 30;
        $problemList = $problemDAO->asValue(
            $problemDAO->listAll($page, $pageSize),
            ["id", "title", "accept", "submit"]
        );

        $problemCount = $problemDAO->count();
        $pageCount = ceil($problemCount / $pageSize);
        $response =  [
            "problems" => $problemList,
            "page" => $page,
            "pageCount" => $pageCount
        ];

        return new Twig("index.twig", $response);
    }
}