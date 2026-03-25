<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Interest;

class InterestController extends Controller
{
    public function store()
    {
        $programmeId = (int)($_POST['programme_id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (!$programmeId || empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::setFlash('error', 'Please provide a valid name and email.');
            $this->redirect('/programme/' . $programmeId);
        }

        Interest::register($programmeId, $name, $email);
        Session::setFlash('success', 'Thank you for registering your interest!');
        $this->redirect('/programme/' . $programmeId);
    }

    public function withdraw()
    {
        $email = trim($_POST['email'] ?? '');
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::setFlash('error', 'Please provide a valid email to withdraw.');
            $this->redirect('/');
        }

        Interest::withdraw($email);
        Session::setFlash('success', 'You have been successfully removed from our mailing list.');
        $this->redirect('/');
    }
}
