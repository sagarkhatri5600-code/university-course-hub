<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\Programme;
use App\Models\Module;
use App\Models\Interest;

class DashboardController extends Controller
{
    public function index()
    {
        $programmes = Programme::all();
        $modules = Module::all();
        $interests = Interest::allWithProgrammes();

        return $this->render('admin/dashboard/index', [
            'title' => 'Admin Dashboard',
            'stats' => [
                'programmes' => count($programmes),
                'modules' => count($modules),
                'interests' => count($interests)
            ]
        ]);
    }
}
