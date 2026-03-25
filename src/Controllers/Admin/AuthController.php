<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            $this->redirect('/admin/dashboard');
        }
        return $this->render('admin/auth/login', [
            'title' => 'Admin Login'
        ]);
    }

    public function login()
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (Auth::attempt($username, $password)) {
            $this->redirect('/admin/dashboard');
        } else {
            Session::setFlash('error', 'Invalid username or password.');
            $this->redirect('/admin/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('/admin/login');
    }
}
