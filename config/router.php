<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/14
 * Time: 下午12:29
 */

$routes = [
    "get:/" => 'Welcome#index',
    "get:/problem/[id]" => "Problem#detail",
    "get:/problem/[id]/submit" => "login:Problem#submitForm",
    "post:/problem/[id]/submit" => "login:Problem#submit",
    "get:/status" => "Status#index",
    "get:/user/register" => "User#registerForm",
    "post:/user/register" => "User#register",
    "get:/user/login" => "User#loginForm",
    "post:/user/login" => "User#login",
    "get:/user/logout" => "User#logout",
    "get:/status/[problemId]" => "Status#problem"
];

return $routes;
