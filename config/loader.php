<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/14
 * Time: 下午12:27
 */

require_once __DIR__ . '/../L8/App.php';

if (!defined('__DEFINED__') || !__DEFINED__) {
    define('__PRODUCT__', !empty($_SERVER['PRODUCT']));
    define('__DEV_HOST__', '192.168.99.100');
    define('__DB_SERVER__', __DEV_HOST__ . ':oj');
}

\L8\App::prop('global', require(__DIR__ . '/../config/global.php'));
\L8\App::prop('exec.tmp.dir', __DIR__ . '/../tmp/');

\L8\App::prop('server.controllerPrefix', '\Gemini\Controller');
\L8\App::prop("result.templateDirectory", __DIR__ . '/../template');
\L8\App::autoLoad(__DIR__ . '/../lib');
\L8\App::autoLoad(__DIR__ . '/../app', 'Gemini');