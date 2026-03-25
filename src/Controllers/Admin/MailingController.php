<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\Interest;
use App\Models\Programme;

class MailingController extends Controller
{
    public function index()
    {
        $programmeId = (int)($_GET['programme_id'] ?? 0);
        $programmes = Programme::all();
        
        $interests = Interest::allWithProgrammes($programmeId ?: null);

        return $this->render('admin/mailing/index', [
            'title' => 'Mailing List',
            'programmes' => $programmes,
            'interests' => $interests,
            'selectedProgrammeId' => $programmeId
        ]);
    }

    public function export()
    {
        $programmeId = (int)($_GET['programme_id'] ?? 0);
        $interests = Interest::allWithProgrammes($programmeId ?: null);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="mailing_list.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Interest ID', 'Student Name', 'Email', 'Programme', 'Registered At']);

        foreach ($interests as $interest) {
            fputcsv($output, [
                $interest['InterestID'],
                $interest['StudentName'],
                $interest['Email'],
                $interest['ProgrammeName'],
                $interest['RegisteredAt']
            ]);
        }
        fclose($output);
        exit;
    }
}
