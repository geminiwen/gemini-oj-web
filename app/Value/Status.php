<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/15
 * Time: 上午8:23
 */

namespace Gemini\Value;


use Gemini\Model\User;
use L8\Mvc\Value\AbstractValue;

class Status extends AbstractValue {

    public function getUser() {
        $userDAO = new User();
        $userId = $this->user_id;
        //TODO not complete
        return $userDAO->get($userId);
    }

}