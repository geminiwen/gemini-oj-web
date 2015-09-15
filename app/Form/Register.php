<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/15
 * Time: 下午7:49
 */

namespace Gemini\Form;


use L8\Mvc\Form\AbstractForm;

class Register extends AbstractForm {
    public $username;
    public $password;
    public $repassword;

    public function setUsername($username) {
        $this->validate("require", '必须填写用户名');
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRepassword($repassword) {
        $this->repassword = $repassword;
    }


}