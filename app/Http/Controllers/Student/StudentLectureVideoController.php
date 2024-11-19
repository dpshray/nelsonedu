<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LectureVideo;

class StudentLectureVideoController extends Controller
{
    public function show(LectureVideo $lectureVideo)
    {
        return view('student.lecture_video.show', compact('lectureVideo'));

    }
}
