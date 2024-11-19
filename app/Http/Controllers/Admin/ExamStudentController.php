<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamStudent;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ExamStudentController extends Controller
{
    public function index()
    {
        $examStudents = ExamStudent::with('student', 'exam')->latest()->paginate(10);

        return view('admin.student.index', compact('examStudents'));
    }

    public function update(Request $request, $examStudentId)
    {
        $validatedData = $request->validate([
            'remarks' => ['required', 'string', 'max:500'],
            'payment_status' => ['required', 'string', 'in:Scholarship,Full Paid,Partially Paid'],
        ]);

        $examStudent = ExamStudent::findOrFail($examStudentId);
        $examStudent->update([
            'status' => 1,
            'payment_status' => $validatedData['payment_status'],
            'remarks' => $validatedData['remarks']
        ]);

        return $this->redirectWithSuccess('admin.student.index', 'Enrollment approved Successfully.');
    }

    public function result(Exam $exam)
    {
        $examStudents = DB::select(DB::raw('SELECT 
            student_id,
            SUM(marks) AS marks,
            SUM(marks_per_questions) AS full_marks,
            users.name,
            users.email
        FROM (
            SELECT 
                es.student_id, 
                SUM(answers.marks) AS marks,
                questions.marks AS marks_per_questions
            FROM 
                exam_student AS es
            INNER JOIN 
                exams ON es.exam_id = exams.id 
            INNER JOIN 
                questions ON exams.id = questions.exam_id 
            INNER JOIN 
                answers ON questions.id = answers.question_id 
            WHERE 
                es.exam_id = :examId
                AND es.exam_finished = 1
            GROUP BY 
                es.student_id, answers.question_id
        ) AS student_marks
        INNER JOIN 
            users ON users.id = student_marks.student_id 
        GROUP BY 
            student_id
        ')->getValue(DB::getQueryGrammar()), [
            'examId' => $exam->id,
        ]);

        return view('admin.student.result', compact('examStudents', 'exam'));
    }
}
