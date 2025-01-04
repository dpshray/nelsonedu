<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Question\QuestionStoreRequest;
use App\Http\Requests\Teacher\Question\QuestionUpdateRequest;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    public function index(Exam $exam)
    {
        $questions = Question::select(['id', 'question', 'question_image', 'explanation', 'explanation_image', 'type', 'marks'])->where('exam_id', $exam->id)->latest()->paginate(10);

        return view('teacher.question.index', compact('questions', 'exam'));
    }

    public function create(Exam $exam)
    {
        Gate::authorize('create', [Question::class, $exam]);

        $this->data['title'] = 'Create';
        $this->data['route'] = route('teacher.question.store', $exam->id);
        $this->data['exam'] = $exam;

        return view('teacher.question.create', $this->data);
    }

    public function store(QuestionStoreRequest $request, Exam $exam)
    {
        Gate::authorize('create', [Question::class, $exam]);

        $validated = (object) $request->validated();

        if ($request->hasFile('question_image') && $request->file('question_image')->isValid()) {
            $image = $request->file('question_image');
            $path = 'teacher/question/exam_'.$exam->id.'/question_images/';
            $questionImage = uploadFile($image, $path, disk: 'public');
        }

        if ($request->hasFile('explanation_image') && $request->file('explanation_image')->isValid()) {
            $image = $request->file('explanation_image');
            $path = 'teacher/question/exam_'.$exam->id.'/explanation_images/';
            $explanationImage = uploadFile($image, $path, disk: 'public');
        }

        $question = Question::create([
            'exam_id' => $exam->id,
            'type' => $validated->type,
            'question' => $validated->question,
            'question_image' => $questionImage ?? '',
            'explanation' => $validated->explanation,
            'explanation_image' => $explanationImage ?? '',
            'marks' => $validated->marks,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),

        ]);

        if (! $question) {
            return $this->backWithError('Question Addition Failed');
        }

        return $this->redirectWithSuccess('teacher.question.index', 'New Question Added Successfully.', $exam->id);
    }

    public function edit(Exam $exam, Question $question)
    {
        Gate::authorize('edit', [Question::class, $exam]);
        $this->data['title'] = 'Edit';
        $this->data['route'] = route('teacher.question.update', [$exam->id, $question->id]);
        $this->data['question'] = $question;
        $this->data['exam'] = $exam;

        return view('teacher.question.create', $this->data);
    }

    public function update(QuestionUpdateRequest $request, Exam $exam, Question $question)
    {
        Gate::authorize('edit', [Question::class, $exam]);

        $validated = (object) $request->validated();

        if ($request->hasFile('question_image') && $request->file('question_image')->isValid()) {
            if ($question->question_image) {
                deleteFile($question->question_image);
            }

            $image = $request->file('question_image');
            $path = 'teacher/question/exam_'.$exam->id.'/question_images/';
            $questionImage = uploadFile($image, $path, disk: 'public');
        }

        if ($request->hasFile('explanation_image') && $request->file('explanation_image')->isValid()) {
            if ($question->explanation_image) {
                deleteFile($question->explanation_image);
            }

            $image = $request->file('explanation_image');
            $path = 'teacher/question/exam_'.$exam->id.'/explanation_images/';
            $explanationImage = uploadFile($image, $path, disk: 'public');
        }

        $result = $question->update([
            'exam_id' => $exam->id,
            'type' => $validated->type,
            'question' => $validated->question,
            'question_image' => $questionImage ?? $question?->questionImage,
            'explanation' => $validated->explanation,
            'explanation_image' => $explanationImage ?? $question?->explanationImage,
            'marks' => $validated->marks,
            'updated_by' => auth()->id(),

        ]);

        if (! $result) {
            return $this->backWithError('Question Updation Failed');
        }

        return $this->redirectWithSuccess('teacher.question.index', 'Question Updated Successfully.', $exam->id);
    }

    public function destroy(Exam $exam, Question $question)
    {
        Gate::authorize('delete', [Question::class, $exam]);

        if ($question->question_image) {
            deleteFile($question->question_image, disk: 'public');
        }

        if ($question->explanation_image) {
            deleteFile($question->explanation_image, disk: 'public');
        }

        $deleted = $question->delete();

        if (! $deleted) {
            return $this->backWithError(message: 'Question Deletion Failed');
        }

        return $this->redirectWithSuccess('teacher.question.index', 'Question Deleted Successfully.', $exam->id);
    }
}
