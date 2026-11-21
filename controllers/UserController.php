<?php

namespace App\Controllers;

use App\Models\Privilege;
use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UserController
{
    public function create()
    {
        Auth::session();
        Auth::privilege(1);

        $privilege = new Privilege;
        $privileges = $privilege->select('privilege');

        return View::render('user/create', ['privileges' => $privileges]);
    }

    public function store(array $data)
    {
        Auth::session();
        Auth::privilege(1);

        $val = new Validator;

        $val->field('name', $data['name'] ?? '')->required()->min(2)->max(50);
        $val->field('username', $data['username'] ?? '')->max(50)->required()->unique('User');
        $val->field('password', $data['password'] ?? '')->required()->max(20)->min(6);
        $val->field('email', $data['email'] ?? '')->required()->email()->unique('User');
        $val->field('privilege_id', $data['privilege_id'] ?? '', 'Privilege')->required()->int();

        if ($val->isSuccess()) {
            $user = new User;
            $data['password'] = $user->hashPassword($data['password']);

            $insert = $user->insert($data);

            if ($insert) {
                return View::redirect('login');
            } else {
                return View::render('error');
            }
        } else {
            $privilege = new Privilege;
            $privileges = $privilege->select('privilege');

            return View::render('user/create', [
                'errors' => $val->getErrors(),
                'privileges' => $privileges,
                'user' => $data
            ]);
        }
    }

    public function register()
    {
        if (isset($_SESSION['fingerPrint'])) {
            return View::redirect('home');
        }

        return View::render('user/register');
    }

    public function storeRegister(array $data)
    {
        $val = new Validator;

        $val->field('name', $data['name'] ?? '')->required()->min(2)->max(50);
        $val->field('username', $data['username'] ?? '')->required()->max(50)->unique('User');
        $val->field('email', $data['email'] ?? '')->required()->email()->unique('User');
        $val->field('password', $data['password'] ?? '')->required()->min(8)->max(72);

        if ($val->isSuccess()) {
            $user = new User;

            $insert = $user->insert([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $user->hashPassword($data['password']),
                'privilege_id' => 2
            ]);

            if ($insert) {
                $user->checkUser($data['username'], $data['password']);

                return View::redirect('home');
            }

            return View::render('error');
        } else {
            return View::render('user/register', [
                'errors' => $val->getErrors(),
                'user' => $data
            ]);
        }
    }
}
