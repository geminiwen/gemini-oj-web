<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 8/28/15
 * Time: 3:02 PM
 */
require_once __DIR__ . '/config/loader.php';

\L8\App::run(require(__DIR__ . '/config/router.php'));