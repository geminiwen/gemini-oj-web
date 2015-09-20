<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/20
 * Time: 下午3:33
 */

namespace Gemini\Facades;


use Illuminate\Support\Facades\Facade;

class AMQP extends Facade{
    protected static function getFacadeAccessor() {
        return "amqp";
    }

}