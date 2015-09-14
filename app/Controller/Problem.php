<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/14
 * Time: 下午3:14
 */

namespace Gemini\Controller;


use Gemini\Result\Twig;
use L8\Mvc\Controller\AbstractController;

class Problem extends AbstractController
{
    public function detail($id) {
        $problemDAO = new \Gemini\Model\Problem();
        $problem = $problemDAO->asValue(
            $problemDAO->queryById($id),
            ["id", "title", "description", "input", "output", "sample_input", "sample_output",
             "time_limit", "memory_limit", "accept", "submit"]
        );

        $response = [
            "problem" => $problem
        ];

        return new Twig("problem/index.twig", $response);
    }

    public function submitForm($id) {
        $problemDAO = new \Gemini\Model\Problem();
        $problem = $problemDAO->asValue(
            $problemDAO->queryById($id),
            ["id", "title"]
        );

        $response = [
            "problem" => $problem
        ];
        return new Twig("problem/submit.twig", $response);
    }
}