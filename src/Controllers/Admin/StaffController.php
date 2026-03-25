<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Staff;

class StaffController extends Controller
{
    public function index()
    {
        $staffList = Staff::all();
        return $this->render('admin/staff/index', [
            'title' => 'Manage Staff',
            'staffList' => $staffList,
        ]);
    }

    public function create()
    {
        return $this->render('admin/staff/form', [
            'title' => 'Add Staff',
            'member' => null,
        ]);
    }

    public function store()
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($name === '' || $email === '' || $password === '') {
            Session::setFlash('error', 'Name, email, and password are required.');
            $this->redirect('/admin/staff/create');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::setFlash('error', 'Please enter a valid email address.');
            $this->redirect('/admin/staff/create');
        }

        if (Staff::findByEmail($email)) {
            Session::setFlash('error', 'That email is already in use.');
            $this->redirect('/admin/staff/create');
        }

        if (strlen($password) < 8) {
            Session::setFlash('error', 'Password must be at least 8 characters.');
            $this->redirect('/admin/staff/create');
        }

        Staff::create($name, $email, password_hash($password, PASSWORD_DEFAULT));
        Session::setFlash('success', 'Staff member created.');
        $this->redirect('/admin/staff');
    }

    public function edit($id)
    {
        $member = Staff::findById((int) $id);
        if (!$member) {
            Session::setFlash('error', 'Staff member not found.');
            $this->redirect('/admin/staff');
        }
        return $this->render('admin/staff/form', [
            'title' => 'Edit Staff',
            'member' => $member,
        ]);
    }

    public function update($id)
    {
        $id = (int) $id;
        $member = Staff::findById($id);
        if (!$member) {
            Session::setFlash('error', 'Staff member not found.');
            $this->redirect('/admin/staff');
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $revoke = !empty($_POST['revoke_portal']);

        if ($name === '') {
            Session::setFlash('error', 'Name is required.');
            $this->redirect('/admin/staff/edit/' . $id);
        }

        if ($revoke) {
            Staff::revokePortalAccess($id, $name);
            Session::setFlash('success', 'Staff updated; portal access revoked.');
            $this->redirect('/admin/staff');
        }

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::setFlash('error', 'A valid email is required for portal access.');
            $this->redirect('/admin/staff/edit/' . $id);
        }

        if (Staff::emailExistsForOther($email, $id)) {
            Session::setFlash('error', 'That email is already in use.');
            $this->redirect('/admin/staff/edit/' . $id);
        }

        $newHash = null;
        if ($password !== '') {
            if (strlen($password) < 8) {
                Session::setFlash('error', 'Password must be at least 8 characters.');
                $this->redirect('/admin/staff/edit/' . $id);
            }
            $newHash = password_hash($password, PASSWORD_DEFAULT);
        }

        Staff::update($id, $name, $email, $newHash);
        Session::setFlash('success', 'Staff member updated.');
        $this->redirect('/admin/staff');
    }

    public function delete($id)
    {
        $id = (int) $id;
        if (Staff::isReferenced($id)) {
            Session::setFlash('error', 'Cannot delete: this person is assigned as a programme or module leader. Reassign them first.');
            $this->redirect('/admin/staff');
        }
        if (!Staff::findById($id)) {
            Session::setFlash('error', 'Staff member not found.');
            $this->redirect('/admin/staff');
        }
        if (Staff::delete($id)) {
            Session::setFlash('success', 'Staff member deleted.');
        } else {
            Session::setFlash('error', 'Could not delete staff member.');
        }
        $this->redirect('/admin/staff');
    }
}
