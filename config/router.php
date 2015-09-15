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
    "get:/problem/[id]/submit" => "Problem#submitForm",
    "post:/problem/[id]/submit" => "Problem#submit",
    "get:/status/index" => "Status#index"

];

return $routes;
