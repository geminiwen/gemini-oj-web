<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/14
 * Time: 下午12:32
 */

namespace Gemini\controller;


use Gemini\Model\Problem;
use Gemini\Result\Twig;
use L8\Mvc\Controller\AbstractController;

class Welcome extends AbstractController
{
    public function index($page = 1) {
        $problemDAO = new Problem();
        $problemList = $problemDAO->asValue(
            $problemDAO->listAll($page),
            ["id", "title", "accept", "submit"]
        );

        $response =  [
            "problems" => $problemList
        ];

        return new Twig("index.twig", $response);
    }
}