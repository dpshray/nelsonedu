<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Exam\ExamStoreRequest;
use App\Http\Requests\Admin\Exam\ExamUpdateRequest;
use App\Models\Exam;
use Illuminate\Support\Facades\Gate;

class ExamController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {

            $exams = Exam::select(['id', 'title', 'target', 'price', 'negative_marking_percent', 'status'])->latest()->paginate(10);
        } else {
            $exams = auth()->user()->exams()->latest()->paginate(10);
        }

        return view('admin.exam.index', compact('exams'));
    }

    public function create()
    {
        Gate::authorize('create', Exam::class);

        $this->data['title'] = 'Create';
        $this->data['route'] = route('admin.exam.store');

        return view('admin.exam.create', $this->data);
    }

    public function store(ExamStoreRequest $request)
    {
        $validated = (object) $request->validated();
        $description = nl2br($validated->description);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $path = 'admin/exam/images/';
            $examImage = uploadFile($image, $path);
            // $imagePath = $request->file('image')->store('exam_images', 'public'); // stores in storage/app/public/exam_images
        }

        $exam = Exam::create([
            'title' => $validated->title,
            'target' => $validated->target,
            'price' => $validated->price,
            'image' => $examImage ?? '',
            'description' => $description,
            'negative_marking_percent' => $validated->negative_marking_percent ?? null,
            'status' => $validated->status,
        ]);

        if (! $exam) {
            return $this->backWithError('Exam Addition Failed');
        }

        return $this->redirectWithSuccess('admin.exam.index', 'New Exam Added Successfully.');
    }

    public function edit(string $id)
    {
        $this->data['title'] = 'Edit';
        $this->data['exam'] = Exam::find($id, ['id', 'title', 'target', 'price', 'description', 'negative_marking_percent', 'status']);
        $this->data['route'] = route('admin.exam.update', ['exam' => $this->data['exam']]);

        return view('admin.exam.create', $this->data);
    }

    public function update(ExamUpdateRequest $request, Exam $exam)
    {
        $validated = (object) $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            deleteFile($exam->image);

            $image = $request->file('image');
            $path = 'admin/exam/images/';
            $examImage = uploadFile($image, $path);
            $validated->image = $examImage;
        }

        $result = $exam->update([
            'title' => $validated->title,
            'target' => $validated->target,
            'price' => $validated->price,
            'description' => $validated->description,
            'image' => $validated->image ?? $exam->image,
            'negative_marking_percent' => $validated->negative_marking_percent ?? null,
            'status' => $validated->status,
        ]);

        if (! $result) {
            return $this->backWithError(message: 'Exam Updation Failed');
        }

        return $this->redirectWithSuccess('admin.exam.index', 'Exam Updated Successfully.');
    }

    public function destroy(Exam $exam)
    {
        deleteFile($exam->image);
        $deleted = $exam->delete();

        if (! $deleted) {
            return $this->backWithError(message: 'Exam Deletion Failed');
        }

        return $this->redirectWithSuccess('admin.exam.index', 'Exam Deleted Successfully.');

    }
}
