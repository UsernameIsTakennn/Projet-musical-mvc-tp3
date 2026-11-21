<?php

namespace App\Controllers;

use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;

class AuthController
{
    public function create()
    {
        if (isset($_SESSION['fingerPrint'])) {
            return View::redirect('home');
        }

        return View::render('auth/create');
    }

    public function store(array $data)
    {
        $val = new Validator;

        $val->field('username', $data['username'] ?? '', 'nom d\'utilisateur')->required();

        $val->field('password', $data['password'] ?? '', 'mot de passe')->required();

        if ($val->isSuccess()) {
            $user = new User;

            if ($user->checkUser($data['username'], $data['password'])) {
                return View::redirect('home');
            }

            $errors = ['login' => 'Nom d\'utilisateur ou mot de passe incorrect'];

            return View::render('auth/create', [
                'errors' => $errors,
                'user' => ['username' => $data['username']]
            ]);
        } else {
            return View::render('auth/create', [
                'errors' => $val->getErrors(),
                'user' => ['username' => $data['username'] ?? '']
            ]);
        }
    }

    public function delete()
    {
        session_destroy();

        return View::redirect('login');
    }
}
