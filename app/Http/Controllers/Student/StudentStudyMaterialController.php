<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use Illuminate\Support\Facades\Storage;

class StudentStudyMaterialController extends Controller
{
    public function preview(StudyMaterial $studyMaterial)
    {
        $fileName = request()->get('fileName');
        $filePath = $studyMaterial->file;
        $fileUrl = Storage::url($filePath);

        return view('teacher.study_material.shownotes', compact('fileUrl', 'studyMaterial'));
    }
}
