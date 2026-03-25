<?php

namespace App\Controllers\Staff;

use App\Core\Controller;
use App\Core\Session;
use App\Core\StaffAuth;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (StaffAuth::check()) {
            $this->redirect('/staff/dashboard');
        }
        return $this->render('staff/auth/login', [
            'title' => 'Staff Login',
        ]);
    }

    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (StaffAuth::attempt($email, $password)) {
            $this->redirect('/staff/dashboard');
        }

        Session::setFlash('error', 'Invalid email or password.');
        $this->redirect('/staff/login');
    }

    public function logout()
    {
        StaffAuth::logout();
        $this->redirect('/staff/login');
    }
}
