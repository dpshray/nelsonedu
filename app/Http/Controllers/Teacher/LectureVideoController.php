<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\LectureVideo\LectureVideoStoreRequest;
use App\Models\ClassRoom;
use App\Models\LectureVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class LectureVideoController extends Controller
{
    private $tempPath = 'teacher/classroom/lecture_video/tmp/';

    public function index(ClassRoom $classroom)
    {
        $lectureVideos = LectureVideo::select(['id', 'class_room_id', 'link'])->where('class_room_id', $classroom->id)->latest()->paginate(10);

        return view('teacher.lecture_video.index', compact('lectureVideos', 'classroom'));
    }

    public function show(ClassRoom $classroom, LectureVideo $lectureVideo)
    {
        return view('teacher.lecture_video.show', compact('lectureVideo'));
    }

    public function create(ClassRoom $classroom)
    {
        $this->data['title'] = 'Create';
        $this->data['route'] = route('teacher.lecture_video.store', $classroom->id);
        $this->data['classroom'] = $classroom;

        return view('teacher.lecture_video.create', $this->data);
    }

    public function uploadFile(Request $request)
    {
        // create the file receiver
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException;
        }

        // receive the file
        $save = $receiver->receive();

        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())

            $filePath = uploadFile(file: $save->getFile(), path: $this->tempPath, disk: 'local');
            $fileName = explode('/', $filePath)[4];
            unlink($save->getFile()->getPathname());

            return response()->json([
                'name' => $fileName,
            ]);
        }

        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();

        return response()->json([
            'done' => $handler->getPercentageDone(),
            'status' => true,
        ]);
    }

    // public function store(LectureVideoStoreRequest $request, $classroomId)
    // {
    //     $fileName = $request->input('file');
    //     $destinationPath = 'teacher/classroom/lecture_video/'.$fileName;
    //     Storage::disk('local')->move($this->tempPath.$fileName, $destinationPath);

    //     $lectureVideo = LectureVideo::create([
    //         'class_room_id' => $classroomId,
    //         'file' => $destinationPath,
    //         'created_by' => auth()->id(),
    //     ]);

    //     if (! $lectureVideo) {
    //         deleteFile($destinationPath, disk: 'local');

    //         return $this->backWithError('Lecture Video Addition Failed');
    //     }

    //     return $this->redirectWithSuccess('teacher.classroom.index', 'Lecture Video Added Successfully.');
    // }

    public function store(LectureVideoStoreRequest $request, $classroomId)
    {
        $validated = (object) $request->validated();

        $lectureVideo = LectureVideo::create([
            'class_room_id' => $classroomId,
            'link' => $validated->link,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        if (! $lectureVideo) {
            return $this->backWithError('Lecture Video Addition Failed');
        }

        return $this->redirectWithSuccess('teacher.classroom.index', 'Lecture Video Added Successfully.');
    }

    public function edit(ClassRoom $classroom, LectureVideo $lectureVideo)
    {
        $this->data['title'] = 'Edit';
        $this->data['route'] = route('teacher.lecture_video.update', [$classroom->id, $lectureVideo->id]);
        $this->data['classroom'] = $classroom;
        $this->data['lectureVideo'] = $lectureVideo;

        return view('teacher.lecture_video.create', $this->data);
    }

    public function update(LectureVideoStoreRequest $request, ClassRoom $classroom, LectureVideo $lectureVideo)
    {
        $validated = (object) $request->validated();

        $lectureVideo = $lectureVideo->update([
            'class_room_id' => $classroom->id,
            'link' => $validated->link,
            'updated_by' => auth()->id(),
        ]);

        if (! $lectureVideo) {
            return $this->backWithError('Lecture Video Update Failed');
        }

        return $this->redirectWithSuccess('teacher.lecture_video.index', 'Lecture Video Updated Successfully.', $classroom->id);
    }

    public function destroy(ClassRoom $classroom, LectureVideo $lectureVideo)
    {
        $deleted = $lectureVideo->delete();

        if (! $deleted) {
            return $this->backWithError(message: 'Lecture Video Deletion Failed');
        }

        return $this->redirectWithSuccess('teacher.lecture_video.index', 'Lecture Video Deleted Successfully.', $classroom->id);
    }

    // public function destroy($classroomId)
    // {
    //     $lectureVideos = LectureVideo::select(['id', 'file'])->where('class_room_id', $classroomId)->get();
    //     $lectureVideos->each(function ($lectureVideo) {
    //         deleteFile($lectureVideo->file, disk: 'local');

    //         $lectureVideo->delete();
    //     });

    //     return $this->redirectWithSuccess('teacher.classroom.index', 'Lecture Video Deleted Successfully.');
    // }
}
