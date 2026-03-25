<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Programme;
use App\Models\Level;
use App\Models\ProgrammeModule;

class ProgrammeController extends Controller
{
    public function index()
    {
        $search = $_GET['search'] ?? '';
        $level = $_GET['level'] ?? '';
        
        $programmes = Programme::all($search, $level);
        $levels = Level::all();
        
        return $this->render('programme/index', [
            'title' => 'Programmes',
            'programmes' => $programmes,
            'levels' => $levels,
            'search' => $search,
            'selectedLevel' => $level
        ]);
    }

    public function show($id)
    {
        $programme = Programme::find((int)$id);
        if (!$programme) {
            $this->redirect('/programmes');
        }

        $modules = ProgrammeModule::getByProgramme((int)$id);

        $modulesByYear = [];
        foreach ($modules as $module) {
            $modulesByYear[$module['Year']][] = $module;
        }

        return $this->render('programme/show', [
            'title' => $programme['ProgrammeName'],
            'programme' => $programme,
            'modulesByYear' => $modulesByYear
        ]);
    }
}
