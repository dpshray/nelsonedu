<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Teacher\TeacherStoreRequest;
use App\Http\Requests\Admin\Teacher\TeacherUpdateRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::select(['id', 'name', 'email'])->role(Constants::ROLE_TEACHER)->paginate(10);

        return view('admin.teacher.index', compact('teachers'));
    }

    public function create()
    {
        $this->data['title'] = 'Create';
        $this->data['route'] = route('admin.teacher.store');

        return view('admin.teacher.create', $this->data);
    }

    public function store(TeacherStoreRequest $request)
    {
        $validated = (object) $request->validated();

        $user = User::create([
            'name' => $validated->name,
            'email' => $validated->email,
            'password' => Hash::make($validated->password),
        ]);

        $user->assignRole(Constants::ROLE_TEACHER);

        event(new Registered($user));

        if (! $user) {
            return $this->backWithError('Teacher Addition Failed');
        }

        return $this->redirectWithSuccess('admin.teacher.index', 'New Teacher Added Successfully.');
    }

    public function edit(string $id)
    {
        $this->data['title'] = 'Edit';
        $this->data['teacher'] = User::select(['id', 'name', 'email'])->where(['id' => $id])->first();
        $this->data['route'] = route('admin.teacher.update', ['teacher' => $this->data['teacher']]);

        return view('admin.teacher.create', $this->data);
    }

    public function update(TeacherUpdateRequest $request, User $teacher)
    {
        $validated = (object) $request->validated();

        $result = $teacher->update([
            'name' => $validated->name,
            'email' => $validated->email,
            'password' => Hash::make($validated->password),
        ]);

        if (! $result) {
            return $this->backWithError(message: 'Teacher Updation Failed');
        }

        return $this->redirectWithSuccess('admin.teacher.index', 'Teacher Updated Successfully.');
    }

    public function destroy(User $teacher)
    {
        $deleted = $teacher->delete();

        if (! $deleted) {
            return $this->backWithError(message: 'Teacher Deletion Failed');
        }

        return $this->redirectWithSuccess('admin.teacher.index', 'Teacher Deleted Successfully.');
    }
}
