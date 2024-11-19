<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassRoom\StoreClassRoomRequest;
use App\Http\Requests\Admin\ClassRoom\UpdateClassRoomRequest;
use App\Models\ClassRoom;

class ClassRoomController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $classrooms = ClassRoom::select(['id', 'name', 'no_of_lectures', 'enrollment_cost', 'target_exam', 'start_date'])->latest()->paginate(10);
        } else {
            $classrooms = auth()->user()->classrooms()->latest()->paginate(10);
        }

        return view('admin.classroom.index', compact('classrooms'));
    }

    public function create()
    {
        $this->data['title'] = 'Create';
        $this->data['route'] = route('admin.classroom.store');

        return view('admin.classroom.create', $this->data);
    }

    public function store(StoreClassRoomRequest $request)
    {
        $validated = (object) $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $path = 'admin/classroom/images/';
            $classroomImage = uploadFile($image, $path);
        }

        $classroom = ClassRoom::create([
            'name' => $validated->name,
            'no_of_lectures' => $validated->no_of_lectures,
            'enrollment_cost' => $validated->enrollment_cost,
            'target_exam' => $validated->target_exam,
            'start_date' => $validated->start_date,
            'image' => $classroomImage ?? '',
            'description' => $validated->description,
        ]);

        if (! $classroom) {
            return $this->backWithError('Classroom Addition Failed');
        }

        return $this->redirectWithSuccess('teacher.classroom.index', 'New Classroom Added Successfully.');
    }

    public function edit(ClassRoom $classroom)
    {
        $this->data['title'] = 'Edit';
        $this->data['classroom'] = $classroom;
        $this->data['route'] = route('admin.classroom.update', ['classroom' => $this->data['classroom']]);

        return view('admin.classroom.create', $this->data);
    }

    public function update(UpdateClassRoomRequest $request, ClassRoom $classroom)
    {
        $validated = (object) $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            deleteFile($classroom->image);

            $image = $request->file('image');
            $path = 'admin/classroom/images/';
            $classroomImage = uploadFile($image, $path);
            $validated->image = $classroomImage;
        }

        $result = $classroom->update([
            'name' => $validated->name,
            'no_of_lectures' => $validated->no_of_lectures,
            'enrollment_cost' => $validated->enrollment_cost,
            'target_exam' => $validated->target_exam,
            'start_date' => $validated->start_date,
            'description' => $validated->description,
            'image' => $validated->image ?? $classroom->image,
        ]);

        if (! $result) {
            return $this->backWithError(message: 'ClassRoom Updation Failed');
        }

        return $this->redirectWithSuccess('teacher.classroom.index', 'Classroom Updated Successfully.');
    }

    public function destroy(ClassRoom $classroom)
    {
        deleteFile($classroom->image);
        $deleted = $classroom->delete();

        if (! $deleted) {
            return $this->backWithError(message: 'Classroom Deletion Failed');
        }

        return $this->redirectWithSuccess('teacher.classroom.index', 'Classroom Deleted Successfully.');
    }
}
