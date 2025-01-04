<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Option\OptionStoreRequest;
use App\Http\Requests\Teacher\Option\OptionUpdateRequest;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Support\Facades\Gate;

class OptionController extends Controller
{
    public function index(Question $question)
    {
        // $options = Question::select(['id', 'option', 'image', 'correct_answer'])->where('question_id', $question->id)->latest()->paginate(10);

        // return view('teacher.option.index', compact('options', 'question'));
    }

    public function create(Question $question)
    {
        Gate::authorize('create', [Option::class, $question]);

        $this->data['title'] = 'Create';
        $this->data['route'] = route('teacher.option.store', $question->id);
        $this->data['question'] = $question;
        $this->data['options'] = Option::select(['id', 'option', 'image', 'correct_answer'])->where('question_id', $question->id)->get();

        return view('teacher.option.create', $this->data);
    }

    public function store(OptionStoreRequest $request, Question $question)
    {
        Gate::authorize('create', [Option::class, $question]);

        $validated = (object) $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $path = 'teacher/option/question'.$question->id.'/images/';
            $optionImage = uploadFile($image, $path, disk: 'public');
        }

        $option = Option::create([
            'question_id' => $question->id,
            'option' => $validated->option,
            'image' => $optionImage ?? null,
            'correct_answer' => $validated->correct_answer,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),

        ]);

        if (! $option) {
            return $this->backWithError('Option Addition Failed');
        }

        return $this->redirectWithSuccess('teacher.option.create', 'New Option Added Successfully.', $question->id);
    }

    public function edit(Question $question, Option $option)
    {
        Gate::authorize('edit', [Option::class, $question]);

        $this->data['title'] = 'Edit';
        $this->data['route'] = route('teacher.option.update', [$question->id, $option->id]);
        $this->data['question'] = $question;
        $this->data['options'] = Option::select(['id', 'option', 'image', 'correct_answer'])->where('question_id', $question->id)->get();
        $this->data['option'] = $option;

        return view('teacher.option.create', $this->data);
    }

    public function update(OptionUpdateRequest $request, Question $question, Option $option)
    {
        Gate::authorize('edit', [Option::class, $question]);

        $validated = (object) $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($option->image) {
                deleteFile($option->image);
            }

            $image = $request->file('image');
            $path = 'teacher/option/question'.$question->id.'/images/';
            $optionImage = uploadFile($image, $path, disk: 'public');
        }

        $result = $option->update([
            'question_id' => $question->id,
            'option' => $validated->option,
            'image' => $optionImage ?? $option->image,
            'correct_answer' => $validated->correct_answer,
            'updated_by' => auth()->id(),
        ]);

        if (! $result) {
            return $this->backWithError('Option Updation Failed');
        }

        return $this->redirectWithSuccess('teacher.option.create', 'Option Updated Successfully.', $question->id);
    }

    public function destroy(Question $question, Option $option)
    {
        Gate::authorize('delete', [Option::class, $question]);

        if ($option->image) {
            deleteFile($option->image, disk: 'public');
        }

        $deleted = $option->delete();

        if (! $deleted) {
            return $this->backWithError(message: 'Option Deletion Failed');
        }

        return $this->redirectWithSuccess('teacher.option.create', 'Option Deleted Successfully.', $question->id);
    }
}
