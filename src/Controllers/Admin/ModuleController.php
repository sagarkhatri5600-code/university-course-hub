<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Module;
use App\Models\Staff;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        return $this->render('admin/modules/index', [
            'title' => 'Manage Modules',
            'modules' => $modules
        ]);
    }

    public function create()
    {
        $staff = Staff::all();
        
        return $this->render('admin/modules/form', [
            'title' => 'Create Module',
            'staff' => $staff,
            'module' => null
        ]);
    }

    public function store()
    {
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'leader_id' => (int)($_POST['leader_id'] ?? 0),
            'description' => trim($_POST['description'] ?? ''),
            'image' => trim($_POST['image'] ?? '')
        ];

        Module::create($data);
        Session::setFlash('success', 'Module created successfully.');
        $this->redirect('/admin/modules');
    }

    public function edit($id)
    {
        $module = Module::find((int)$id);
        if (!$module) {
            Session::setFlash('error', 'Module not found.');
            $this->redirect('/admin/modules');
        }

        $staff = Staff::all();

        return $this->render('admin/modules/form', [
            'title' => 'Edit Module',
            'staff' => $staff,
            'module' => $module
        ]);
    }

    public function update($id)
    {
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'leader_id' => (int)($_POST['leader_id'] ?? 0),
            'description' => trim($_POST['description'] ?? ''),
            'image' => trim($_POST['image'] ?? '')
        ];

        Module::update((int)$id, $data);
        Session::setFlash('success', 'Module updated successfully.');
        $this->redirect('/admin/modules');
    }

    public function delete($id)
    {
        Module::delete((int)$id);
        Session::setFlash('success', 'Module deleted successfully.');
        $this->redirect('/admin/modules');
    }
}
