<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/15
 * Time: 下午8:05
 */

namespace Gemini\Model;


class User extends AbstractModel{
    public function getByUsername($username) {
        return $this->getTable()->findBy(["username" => $username]);
    }
}