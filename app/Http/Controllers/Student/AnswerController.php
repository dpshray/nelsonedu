<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamStudent;
use App\Models\Marksheet;
use App\Models\Option;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    public function index() {}

    public function create(Exam $exam)
    {
        $questions = $exam->questions->load('options');

        return view('student.answer.create', compact('questions', 'exam'));
    }

    public function store(Request $request, Exam $exam)
    {
        $questionAnswers = $request->except('_token');
        try {
            foreach ($questionAnswers as $questionIndex => $answers) {
                $questionId = explode('_', $questionIndex)[1];
                $question = Question::find($questionId);
                $correctOptionsCount = $question->options->pluck('correct_answer')->sum();
                $marksPerCorrectOption = $question->marks / $correctOptionsCount;

                foreach ($answers as $answerId) {
                    $option = Option::find($answerId);
                    if ($option->correct_answer) {
                        $marks = $marksPerCorrectOption;
                    } else {
                        $marks = 0;
                        if ($exam->negative_marking_percent) {
                            $marks = -1 * abs(($exam->negative_marking_percent * $question->marks) / 100);
                        }
                    }
                    Answer::create([
                        'user_id' => auth()->id(),
                        'question_id' => $questionId,
                        'option_id' => $answerId,
                        'is_correct' => $option->correct_answer,
                        'marks' => $marks,
                        'exam_id' => $exam->id,
                    ]);
                }
            }
            $examStudent = ExamStudent::where('exam_id', $exam->id)->where('student_id', auth()->id())->firstOrFail();
            $examStudent->update([
                'exam_finished' => 1,
                'updated_at' => now(),
            ]);

            $this->createMarksheet($exam);

            return $this->redirectWithSuccess('student.exam.myexam', 'Answers Submitted Successfully.');
        } catch (Exception $e) {
            return $this->backWithError('Answer Submission Failed. Please Report to Admin');
        }
    }

    private function createMarksheet($exam)
    {
        $result = collect($this->getResult($exam));
        $fullMarks = $result->pluck('question_marks')->sum();
        $obtainedMarks = $result->pluck('answer_marks_per_question')->sum();
        $percentage = round(($obtainedMarks / $fullMarks) * 100,2);

        Marksheet::create([
            'student_id' => auth()->id(),
            'exam_id' => $exam->id,
            'full_marks' => $fullMarks,
            'obtained_marks' => $obtainedMarks,
            'percentage' => $percentage,
        ]);
    }

    public function result(Exam $exam)
    {
        // $answers = Answer::with(['question', 'question.options', 'option'])->where('user_id', auth()->id())->whereIn('question_id', $exam->questions->pluck('id')->toArray())->get();
        $answers = $this->getResult($exam);

        return view('student.answer.result', compact('answers', 'exam'));
    }

    private function getResult($exam)
    {
        $result = DB::select(DB::raw('SELECT 
            answers.user_id, 
            answers.question_id,
            GROUP_CONCAT(answers.marks) AS marks,
            MAX(questions.marks) as question_marks, 
            sum(answers.marks) as answer_marks_per_question,   
            MAX(questions.question) as question,
            MAX(questions.question_image) as question_image,
            MAX(questions.explanation) as explanation,
            MAX(questions.explanation_image) as explanation_image,
            GROUP_CONCAT(options.option) AS options,
            GROUP_CONCAT(options.image) AS option_images,
            GROUP_CONCAT(is_correct) AS is_correct, 
            MAX(correct_answer.correct) as correct,
            MAX(correct_answer.correct_image) as correct_image
        FROM 
            answers 
        INNER JOIN 
            options ON answers.question_id = options.question_id AND answers.option_id = options.id 
        INNER JOIN 
            (SELECT 
                question_id, 
                GROUP_CONCAT(options.option) AS correct,
                GROUP_CONCAT(options.image) AS correct_image
            FROM 
                options 
            WHERE 
                correct_answer = 1 
            GROUP BY 
                question_id) AS correct_answer ON answers.question_id = correct_answer.question_id 
        INNER JOIN 
            questions ON answers.question_id = questions.id
        WHERE 
            answers.user_id = :userId
            AND questions.exam_id = :examId
        GROUP BY 
            answers.user_id, answers.question_id')->getValue(DB::getQueryGrammar()), [
            'userId' => auth()->id(),
            'examId' => $exam->id,
        ]);

        return $result;
    }

    public function edit(Answer $answer)
    {
        //
    }

    public function update(Request $request, Answer $answer)
    {
        //
    }

    public function destroy(Answer $answer)
    {
        //
    }
}
