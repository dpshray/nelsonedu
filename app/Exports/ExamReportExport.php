<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExamReportExport implements FromCollection, WithHeadings
{
    public function __construct(private int $examId) {}

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $examStudents = DB::select(DB::raw('SELECT 
            users.name,
            users.email,
            SUM(marks_per_questions) AS full_marks,
            SUM(marks) AS marks,
            ROUND((SUM(marks) / SUM(marks_per_questions)) * 100, 2) AS percent
        FROM (
            SELECT 
                es.student_id, 
                SUM(answers.marks) AS marks,
                MAX(questions.marks) AS marks_per_questions
            FROM 
                exam_student AS es
            INNER JOIN 
                exams ON es.exam_id = exams.id 
            INNER JOIN 
                questions ON exams.id = questions.exam_id 
            INNER JOIN 
                answers ON questions.id = answers.question_id 
                AND answers.user_id = es.student_id
            WHERE 
                es.exam_id = :examId
                AND es.exam_finished = 1
            GROUP BY 
                es.student_id, answers.question_id
        ) AS student_marks
        INNER JOIN 
            users ON users.id = student_marks.student_id 
        GROUP BY 
            student_id, users.name, users.email
        ')->getValue(DB::getQueryGrammar()), [
            'examId' => $this->examId,
        ]);

        return collect($examStudents);
    }

    public function headings(): array
    {
        return [
            'Student Name',
            'Student Email',
            'Full Marks',
            'Obtained Marks',
            'Percentage',
        ];
    }
}
