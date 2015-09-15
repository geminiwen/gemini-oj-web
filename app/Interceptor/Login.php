<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/15
 * Time: 下午9:13
 */

namespace Gemini\Interceptor;


use L8\Mvc\Controller\ControllerEvent;
use L8\Mvc\Controller\Interceptor\InterceptorInterface;
use L8\Mvc\Result\Redirect;

class Login implements InterceptorInterface{
    /**
     * intercept
     *
     * @param ControllerEvent $event
     */
    public function intercept(ControllerEvent $event) {
        if (!isset($_SESSION['login'])) {
            $event->setResult(new Redirect('/user/login'));
        }
    }

}