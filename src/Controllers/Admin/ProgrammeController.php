<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Programme;
use App\Models\Level;
use App\Models\Staff;

class ProgrammeController extends Controller
{
    public function index()
    {
        $programmes = Programme::all();
        return $this->render('admin/programmes/index', [
            'title' => 'Manage Programmes',
            'programmes' => $programmes
        ]);
    }

    public function create()
    {
        $levels = Level::all();
        $staff = Staff::all();
        
        return $this->render('admin/programmes/form', [
            'title' => 'Create Programme',
            'levels' => $levels,
            'staff' => $staff,
            'programme' => null
        ]);
    }

    public function store()
    {
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'level_id' => (int)($_POST['level_id'] ?? 0),
            'leader_id' => (int)($_POST['leader_id'] ?? 0),
            'description' => trim($_POST['description'] ?? ''),
            'image' => trim($_POST['image'] ?? '')
        ];

        Programme::create($data);
        Session::setFlash('success', 'Programme created successfully.');
        $this->redirect('/admin/programmes');
    }

    public function edit($id)
    {
        $programme = Programme::find((int)$id);
        if (!$programme) {
            Session::setFlash('error', 'Programme not found.');
            $this->redirect('/admin/programmes');
        }

        $levels = Level::all();
        $staff = Staff::all();

        return $this->render('admin/programmes/form', [
            'title' => 'Edit Programme',
            'levels' => $levels,
            'staff' => $staff,
            'programme' => $programme
        ]);
    }

    public function update($id)
    {
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'level_id' => (int)($_POST['level_id'] ?? 0),
            'leader_id' => (int)($_POST['leader_id'] ?? 0),
            'description' => trim($_POST['description'] ?? ''),
            'image' => trim($_POST['image'] ?? '')
        ];

        Programme::update((int)$id, $data);
        Session::setFlash('success', 'Programme updated successfully.');
        $this->redirect('/admin/programmes');
    }

    public function delete($id)
    {
        Programme::delete((int)$id);
        Session::setFlash('success', 'Programme deleted successfully.');
        $this->redirect('/admin/programmes');
    }
}
