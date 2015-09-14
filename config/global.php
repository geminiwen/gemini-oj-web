<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/14
 * Time: 下午2:26
 */

list ($dbHost, $dbDatabase) = explode(':', __DB_SERVER__);
$object = [
    'logger'        =>  ['\L8\Helper\Logger', ['/tmp/sf.log', 'DEBUG']],
    'db'            =>  ['\L8\Db\Connector', ['PdoMysql', ['mysql:dbname=' . $dbDatabase . ';host=' . $dbHost,
        'root', '123456', [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
        ]]]],
    'amqp'          => ["AMQPConnection", [
        [
            "host" => $dbHost,
            "vhost" => "/",
            "login" => "gemini",
            "password" => "123456"
        ]
    ]]
];
return $object;