<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoomStudent;
use Illuminate\Http\Request;

class ClassRoomStudentController extends Controller
{
    public function index()
    {
        $classroomStudents = ClassRoomStudent::with('student', 'classroom')->latest()->paginate(10);

        return view('admin.classroom_student.index', compact('classroomStudents'));
    }

    public function update(Request $request, $classroomStudentId)
    {
        $validatedData = $request->validate([
            'remarks' => ['required', 'string', 'max:500'],
            'payment_status' => ['required', 'string', 'in:Scholarship,Full Paid,Partially Paid'],
        ]);

        $classroomStudent = classroomStudent::findOrFail($classroomStudentId);
        $classroomStudent->update([
            'status' => 1,
            'payment_status' => $validatedData['payment_status'],
            'remarks' => $validatedData['remarks']
        ]);

        return $this->redirectWithSuccess('admin.classroom.student.index', 'Enrollment approved Successfully.');
    }
}
