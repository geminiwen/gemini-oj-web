<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/14
 * Time: 下午12:27
 */

require_once __DIR__ . '/../L8/App.php';

\L8\App::prop('server.controllerPrefix', '\Gemini\Controller');
\L8\App::prop("result.templateDirectory", __DIR__ . '/../template');
\L8\App::autoLoad(__DIR__ . '/../lib');
\L8\App::autoLoad(__DIR__ . '/../app', 'Gemini');