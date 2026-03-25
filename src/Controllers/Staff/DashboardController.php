<?php

namespace App\Controllers\Staff;

use App\Core\Controller;
use App\Core\Session;
use App\Core\StaffAuth;
use App\Models\Staff;

class DashboardController extends Controller
{
    public function index()
    {
        if (!StaffAuth::check()) {
            $this->redirect('/staff/login');
        }

        $staffId = (int) Session::get('staff_id');
        $modulesLed = Staff::getModulesLedByStaff($staffId);
        $impactRows = Staff::getProgrammeImpactForStaff($staffId);

        $impactByProgramme = [];
        foreach ($impactRows as $row) {
            $pid = $row['ProgrammeID'];
            if (!isset($impactByProgramme[$pid])) {
                $impactByProgramme[$pid] = [
                    'ProgrammeName' => $row['ProgrammeName'],
                    'LevelName' => $row['LevelName'],
                    'rows' => [],
                ];
            }
            $impactByProgramme[$pid]['rows'][] = $row;
        }

        return $this->render('staff/dashboard/index', [
            'title' => 'My teaching',
            'modulesLed' => $modulesLed,
            'impactByProgramme' => $impactByProgramme,
        ]);
    }
}
