<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class StudentExamController extends Controller
{
    public function index()
    {
        $exams = Exam::select(['id', 'title', 'target', 'price', 'negative_marking_percent'])->latest()->paginate(10);

        return view('student.exam.index', compact('exams'));
    }

    public function store(Request $request, Exam $exam)
    {
        $exam->students()->syncWithoutDetaching(auth()->id());

        return $this->redirectWithSuccess('student.exam.index', 'Enrollment request sent Successfully.');
    }

    public function myexam()
    {
        $exams = auth()->user()->studentExams()->latest()->paginate(10);

        return view('student.exam.myexam', compact('exams'));
    }
}
