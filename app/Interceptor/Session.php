<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/15
 * Time: 下午9:45
 */

namespace Gemini\Interceptor;


use Gemini\Result\Twig;
use L8\Mvc\Controller\ControllerEvent;
use L8\Mvc\Controller\Interceptor\InterceptorInterface;
use L8\Mvc\Result\NotFound;

class Session implements InterceptorInterface {
    /**
     * intercept
     *
     * @param ControllerEvent $event
     */
    public function intercept(ControllerEvent $event) {
        $event->invoke();
        $result = $event->getResult();
        if ($result instanceof Twig && !($result instanceof NotFound)) {
            if (isset($_SESSION['user'])) {
                $result->setData('sessionUser', $_SESSION['user']);
            }
        }
    }


}