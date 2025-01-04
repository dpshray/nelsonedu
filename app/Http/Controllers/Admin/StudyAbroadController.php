<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudyAbroad\StudyAbroadStoreRequest;
use App\Http\Requests\Admin\StudyAbroad\StudyAbroadUpdateRequest;
use App\Models\StudyAbroad;

class StudyAbroadController extends Controller
{
    public function index()
    {
        $studyAbroads = StudyAbroad::select(['id', 'country', 'description', 'image'])->latest()->paginate(10);

        return view('admin.study_abroad.index', compact('studyAbroads'));
    }

    public function create()
    {
        $this->data['title'] = 'Create';
        $this->data['route'] = route('admin.study_abroad.store');

        return view('admin.study_abroad.create', $this->data);
    }

    public function store(StudyAbroadStoreRequest $request)
    {
        $validated = (object) $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $path = 'admin/study_abroad/images/';
            $classroomImage = uploadFile($image, $path);
        }

        $classroom = StudyAbroad::create([
            'country' => $validated->country,
            'description' => $validated->description,
            'image' => $classroomImage,
        ]);

        if (! $classroom) {
            return $this->backWithError('Study Abroads Addition Failed');
        }

        return $this->redirectWithSuccess('admin.study_abroad.index', 'New Study Abroad Added Successfully.');
    }

    public function edit(StudyAbroad $studyAbroad)
    {
        $this->data['title'] = 'Edit';
        $this->data['studyAbroad'] = $studyAbroad;
        $this->data['route'] = route('admin.study_abroad.update', ['study_abroad' => $studyAbroad]);

        return view('admin.study_abroad.create', $this->data);
    }

    public function update(StudyAbroadUpdateRequest $request, StudyAbroad $studyAbroad)
    {
        $validated = (object) $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            deleteFile($studyAbroad->image);

            $image = $request->file('image');
            $path = 'admin/study_abroad/images/';
            $studyAbroadImage = uploadFile($image, $path);
            $validated->image = $studyAbroadImage;
        }

        $result = $studyAbroad->update([
            'country' => $validated->country,
            'description' => $validated->description,
            'image' => $validated->image ?? $studyAbroad->image,
        ]);

        if (! $result) {
            return $this->backWithError(message: 'StudyAbroad Updation Failed');
        }

        return $this->redirectWithSuccess('admin.study_abroad.index', 'StudyAbroad Updated Successfully.');
    }

    public function destroy(StudyAbroad $studyAbroad)
    {
        deleteFile($studyAbroad->image);
        $deleted = $studyAbroad->delete();

        if (! $deleted) {
            return $this->backWithError(message: 'StudyAbroad Deletion Failed');
        }

        return $this->redirectWithSuccess('admin.study_abroad.index', 'StudyAbroad Deleted Successfully.');
    }
}
