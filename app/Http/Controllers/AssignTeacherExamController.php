<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Http\Requests\AssignTeacherExamRequest;
use App\Models\Exam;
use App\Models\User;

class AssignTeacherExamController extends Controller
{
    public function create(Exam $exam)
    {
        $this->data['teachers'] = User::select(['id', 'name'])->role(Constants::ROLE_TEACHER)->get();
        $this->data['exam'] = $exam->load('teachers:id');
        $this->data['assignedTeachers'] = $this->data['exam']->teachers->pluck('id')->toArray();

        return view('admin.assign_teacher_exam.create', $this->data);
    }

    public function store(AssignTeacherExamRequest $request, Exam $exam)
    {
        $validated = (object) $request->validated();
        $exam->teachers()->syncWithoutDetaching($validated->teachers);

        return $this->redirectWithSuccess('teacher.exam.index', 'Teachers Assigned Successfully.');
    }

    public function destroy(Exam $exam)
    {
        $exam->teachers()->detach();

        return $this->redirectWithSuccess('teacher.exam.index', 'Teachers Removed Successfully.');
    }
}
