<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/15
 * Time: 下午7:45
 */

namespace Gemini\Controller;


use Gemini\Form\Register;
use Gemini\Result\Twig;
use L8\App;
use L8\Mvc\Controller\AbstractController;
use L8\Mvc\Result\Redirect;

class User extends AbstractController {

    public function registerForm() {
        return new Twig("user/register.twig");
    }

    public function register(Register $register) {
        $userDAO = new \Gemini\Model\User();
        $username = $register->username;

        $user = $userDAO->getByUsername($username);
        do {
            if ($user != NULL) {
                $response = [
                    "message" => "用户已存在"
                ];
                return new Twig("common/error.twig", $response);
            }
            $password = $register->password;
            $rePassword = $register->repassword;
            if ($password != $rePassword) {
                $response = [
                    "message" => "两次密码输入不一致"
                ];
                return new Twig("common/error.twig", $response);
            }
            $hashPassword = password_hash($password, PASSWORD_BCRYPT);

            $user = $userDAO->add([
                "username" => $username,
                "password" => $hashPassword
            ]);

            $user = $userDAO->asValue($user,
                ['username', 'id']
            );

            $_SESSION['user'] = $user;

        } while(false);

        return new Redirect("/");
    }

    public function loginForm() {
        return new Twig("user/login.twig");
    }

    public function login($username, $password) {
        if ($username == NULL) {
            $response = [
                "message" => "用户名不能为空"
            ];
            return new Twig("common/error.twig", $response);
        }

        if ($password == NULL) {
            $response = [
                "message" => "密码不能为空"
            ];
            return new Twig("common/error.twig", $response);
        }

        $userDAO = new \Gemini\Model\User();

        $user = $userDAO->getByUsername($username);
        do {
            if ($user == NULL) {
                $response = [
                    "message" => "用户不存在"
                ];
                return new Twig("common/error.twig", $response);
                break;
            }

            $savePassword = $user['password'];

            $verifyResult = password_verify($password, $savePassword);
            if (!$verifyResult) {
                $response = [
                    "message" => "密码错误"
                ];
                return new Twig("common/error.twig", $response);
                break;
            }
            $user = $userDAO->asValue($user,
                ['username', 'id']
            );
            $_SESSION['user'] = $user;
        } while(false);
        return new Redirect("/");
    }

    public function logout() {
        unset($_SESSION['user']);
        return new Redirect("/");
    }
}