<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExamReportExport;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use Maatwebsite\Excel\Facades\Excel;

class ExamReportController extends Controller
{
    public function download(Exam $exam)
    {
        return Excel::download(new ExamReportExport($exam->id), $exam->title.'_report.xlsx');
    }
}
