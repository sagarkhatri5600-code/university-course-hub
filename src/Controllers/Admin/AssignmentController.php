<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Programme;
use App\Models\Module;
use App\Models\ProgrammeModule;

class AssignmentController extends Controller
{
    public function index()
    {
        $programmes = Programme::all();
        $selectedProgrammeId = (int)($_GET['programme_id'] ?? 0);
        
        $assignedModules = [];
        if ($selectedProgrammeId) {
            $assignedModules = ProgrammeModule::getByProgramme($selectedProgrammeId);
        }

        $allModules = Module::all();

        return $this->render('admin/assignments/index', [
            'title' => 'Assign Modules to Programmes',
            'programmes' => $programmes,
            'selectedProgrammeId' => $selectedProgrammeId,
            'assignedModules' => $assignedModules,
            'allModules' => $allModules
        ]);
    }

    public function store()
    {
        $programmeId = (int)($_POST['programme_id'] ?? 0);
        $moduleId = (int)($_POST['module_id'] ?? 0);
        $year = (int)($_POST['year'] ?? 1);

        if ($programmeId && $moduleId && $year) {
            ProgrammeModule::assign($programmeId, $moduleId, $year);
            Session::setFlash('success', 'Module assigned successfully.');
        } else {
            Session::setFlash('error', 'Invalid input.');
        }

        $this->redirect('/admin/assignments?programme_id=' . $programmeId);
    }

    public function delete($id)
    {
        $programmeId = (int)($_POST['programme_id'] ?? 0);
        ProgrammeModule::remove((int)$id);
        Session::setFlash('success', 'Module unassigned successfully.');
        $this->redirect('/admin/assignments?programme_id=' . $programmeId);
    }
}
