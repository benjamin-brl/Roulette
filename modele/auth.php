<?php
include_once "bd.user.php";

class Auth
{
    public $User;

    public function __construct()
    {
        $this->User = new User;
    }

    public function login($mail, $psw)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if ($user = $this->User->verifyUser($mail, $psw)) {
            $user = $this->User->getUserByMail($mail);
            if (!empty($user)) {
                $_SESSION["mail"] = $mail;
                $_SESSION["psw"] = $psw;
                $_SESSION["estProf"] = isset($user["estProf"]) ? $user["estProf"] : 0;
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION["mail"]);
        unset($_SESSION["psw"]);
        unset($_SESSION["estProf"]);
    }

    public function isLoggedOn()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $ret = false;

        if (isset($_SESSION["mail"])) {
            $util = $this->User->getUserByMail($_SESSION["mail"]);
            if ($util["mail"] == $_SESSION["mail"] && $util["psw"] == $_SESSION["psw"]) {
                $ret = true;
            }
        }
        return $ret;
    }
}
