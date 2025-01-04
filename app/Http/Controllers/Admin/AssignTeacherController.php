<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignTeacher\AssignTeacherStoreRequest;
use App\Models\ClassRoom;
use App\Models\User;

class AssignTeacherController extends Controller
{
    public function create(ClassRoom $classroom)
    {
        $this->data['teachers'] = User::select(['id', 'name'])->role(Constants::ROLE_TEACHER)->get();
        $this->data['classroom'] = $classroom->load('teachers:id');
        $this->data['assignedTeachers'] = $this->data['classroom']->teachers->pluck('id')->toArray();

        return view('admin.assign_teacher.create', $this->data);
    }

    public function store(AssignTeacherStoreRequest $request, ClassRoom $classroom)
    {
        $validated = (object) $request->validated();
        $classroom->teachers()->syncWithoutDetaching($validated->teachers);

        return $this->redirectWithSuccess('teacher.classroom.index', 'Teachers Assigned Successfully.');
    }

    public function destroy(ClassRoom $classroom)
    {
        $classroom->teachers()->detach();

        return $this->redirectWithSuccess('teacher.classroom.index', 'Teachers Removed Successfully.');
    }
}
