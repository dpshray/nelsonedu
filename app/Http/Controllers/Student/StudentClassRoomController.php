<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class StudentClassRoomController extends Controller
{
    public function index()
    {
        $classrooms = ClassRoom::select(['id', 'name', 'no_of_lectures', 'enrollment_cost', 'target_exam', 'start_date'])->latest()->paginate(10);

        return view('student.classroom.index', compact('classrooms'));
    }

    public function store(Request $request, ClassRoom $classroom)
    {
        $classroom->students()->syncWithoutDetaching(auth()->id());

        return $this->redirectWithSuccess('student.classroom.index', 'Enrollment request sent Successfully.');
    }

    public function show(Classroom $classroom)
    {
        $classroom->load(['class_meetings', 'lecture_videos.study_materials', 'lecture_videos']);

        return view('student.classroom.show', compact('classroom'));
    }

    public function myclassroom()
    {
        $classrooms = auth()->user()->studentClassrooms()->latest()->paginate(10);

        return view('student.classroom.myclassroom', compact('classrooms'));
    }
}
