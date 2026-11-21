<?php

namespace App\Providers;

use App\Providers\View;

class Auth
{
    static public function session()
    {
        if (
            isset($_SESSION['fingerPrint']) &&
            $_SESSION['fingerPrint'] == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])
        ) {
            return true;
        } else {
            return View::redirect('login');
        }
    }

    static public function privilege(int $id)
    {
        if (
            isset($_SESSION['user_privilege']) &&
            $_SESSION['user_privilege'] == $id
        ) {
            return true;
        } else {
            return View::redirect('login');
        }
    }
}
