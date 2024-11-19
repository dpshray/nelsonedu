<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\NewsStoreRequest;
use App\Http\Requests\Admin\News\NewsUpdateRequest;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $newes = News::select(['id', 'title', 'description', 'image'])->latest()->paginate(10);

        return view('admin.news.index', compact('newes'));
    }

    public function create()
    {
        $this->data['title'] = 'Create';
        $this->data['route'] = route('admin.news.store');

        return view('admin.news.create', $this->data);
    }

    public function store(NewsStoreRequest $request)
    {
        $validated = (object) $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $path = 'admin/news/images/';
            $classroomImage = uploadFile($image, $path);
        }

        $classroom = News::create([
            'title' => $validated->title,
            'description' => $validated->description,
            'image' => $classroomImage,
        ]);

        if (! $classroom) {
            return $this->backWithError('News/Events Addition Failed');
        }

        return $this->redirectWithSuccess('admin.news.index', 'New News/Event Added Successfully.');
    }

    public function edit(News $news)
    {
        $this->data['title'] = 'Edit';
        $this->data['news'] = $news;
        $this->data['route'] = route('admin.news.update', ['news' => $news]);

        return view('admin.news.create', $this->data);
    }

    public function update(NewsUpdateRequest $request, News $news)
    {
        $validated = (object) $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            deleteFile($news->image);

            $image = $request->file('image');
            $path = 'admin/news/images/';
            $newsImage = uploadFile($image, $path);
            $validated->image = $newsImage;
        }

        $result = $news->update([
            'title' => $validated->title,
            'description' => $validated->description,
            'image' => $validated->image ?? $news->image,
        ]);

        if (! $result) {
            return $this->backWithError(message: 'News Updation Failed');
        }

        return $this->redirectWithSuccess('admin.news.index', 'News Updated Successfully.');
    }

    public function destroy(News $news)
    {
        deleteFile($news->image);
        $deleted = $news->delete();

        if (! $deleted) {
            return $this->backWithError(message: 'News Deletion Failed');
        }

        return $this->redirectWithSuccess('admin.news.index', 'News Deleted Successfully.');
    }
}
