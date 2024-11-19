<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\StudyMaterial\StudyMaterialStoreRequest;
use App\Models\ClassRoom;
use App\Models\LectureVideo;
use App\Models\StudyMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StudyMaterialController extends Controller
{
    public function index(ClassRoom $classroom)
    {
        // $studyMaterials = StudyMaterial::with('lectureVideo')->select(['id', 'file', 'lecture_video_id'])->where('class_room_id', $classroom->id)->latest()->paginate(10);

        // $this->data['studyMaterials'] = $studyMaterials;
        // $this->data['classroom'] = $classroom;
        // $this->data['fileNames'] = $studyMaterials
        //     ->map(function ($item) {
        //         return explode('_', $item->file);
        //     })
        //     ->map(function ($arrayName) {
        //         return end($arrayName);
        //     })
        //     ->map(function ($fullname) {
        //         return explode('.', $fullname)[0];
        //     });


        // return view('teacher.study_material.index', $this->data);

        $this->data['lectureVideos'] = LectureVideo::with('study_materials')->select(['id', 'link'])->where('class_room_id', $classroom->id)->latest()->paginate(10);
        $this->data['classroom'] = $classroom;
        
        return view('teacher.study_material.index', $this->data);
    }

    public function create(ClassRoom $classroom)
    {
        $this->data['title'] = 'Create';
        $this->data['route'] = route('teacher.study_material.store', $classroom->id);
        $this->data['classroom'] = $classroom;

        return view('teacher.study_material.create', $this->data);
    }

    public function store(StudyMaterialStoreRequest $request, $classroomId)
    {
        $validated = (object) $request->validated();

        $filesPath = [];
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $path = 'teacher/classroom/study_material/';
                    $filePath = uploadFile(file: $file, path: $path, disk: 'public');
                    $filesPath[] = $filePath;
                }
            }
        }

        DB::beginTransaction();

        try {
            
            $lectureVideo = LectureVideo::create([
                'class_room_id' => $classroomId,
                'link' => $validated->video_link,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);


            $data = [];
            foreach ($filesPath as $filePath) {
                array_push($data, [
                    'class_room_id' => $classroomId,
                    'lecture_video_id' => $lectureVideo->id,
                    'file' => $filePath,
                    'created_by' => auth()->id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $result = StudyMaterial::insert($data);

            DB::commit();

        } catch (\Exception $e) {
            Log::error('Study Material insertion failed: ' . $e->getMessage());

            throw $e;
        }

        if (! $result) {
            return $this->backWithError('Study Material Addition Failed');
        }

        return $this->redirectWithSuccess('teacher.classroom.index', 'Study Material Added Successfully.');
    }

    public function show(StudyMaterial $studyMaterial) {}

    public function edit(ClassRoom $classroom, LectureVideo $lectureVideo)
    {
        $this->data['title'] = 'Edit';
        $this->data['route'] = route('teacher.study_material.update', [$classroom->id, $lectureVideo->id]);
        $this->data['classroom'] = $classroom;
        $this->data['lectureVideo'] = $lectureVideo;

        return view('teacher.study_material.create', $this->data);
    }

    public function update(StudyMaterialStoreRequest $request, ClassRoom $classroom, LectureVideo $lectureVideo)
    {
        $validated = (object) $request->validated();

        $filesPath = [];
        if ($request->hasFile('file')) {
            $lectureVideo->study_materials->each(function ($studyMaterial) {
                deleteFile($studyMaterial->file, disk: 'public');
    
                $studyMaterial->delete();
            });

            $files = $request->file('file');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $path = 'teacher/classroom/study_material/';
                    $filePath = uploadFile(file: $file, path: $path, disk: 'public');
                    $filesPath[] = $filePath;
                }
            }
        }

        DB::beginTransaction();

        try {
            $result = $lectureVideo->update([
                'class_room_id' => $classroom->id,
                'link' => $validated->video_link,
                'updated_by' => auth()->id(),
            ]);

            $data = [];
            foreach ($filesPath as $filePath) {
                array_push($data, [
                    'class_room_id' => $classroom->id,
                    'lecture_video_id' => $lectureVideo->id,

                    'file' => $filePath,
                    'created_by' => auth()->id(),
                    'updated_at' => now(),
                ]);
            }

            $result = StudyMaterial::insert($data);
            
            DB::commit();

        } catch (\Exception $e) {
            Log::error('Study Material insertion failed: ' . $e->getMessage());

            throw $e;
        }


        if (! $result) {
            return $this->backWithError('Study Material Updation Failed');
        }

        return $this->redirectWithSuccess('teacher.study_material.index', 'Study Material Updated Successfully.', $classroom->id);
    }

    // public function destroy(ClassRoom $classroom, StudyMaterial $studyMaterial)
    // {
    //     deleteFile($studyMaterial->file, disk: 'local');
    //     $deleted = $studyMaterial->delete();

    //     if (! $deleted) {
    //         return $this->backWithError('Study Material Deletion Failed');
    //     }

    //     return $this->redirectWithSuccess('teacher.study_material.index', 'Study Material Deleted Successfully.', $classroom->id);
    // }

    public function destroy(ClassRoom $classroom, LectureVideo $lectureVideo)
    {
        $lectureVideo->study_materials->each(function ($studyMaterial) {
            deleteFile($studyMaterial->file, disk: 'public');

            $studyMaterial->delete();
        });

        $deleted = $lectureVideo->delete();

        if (! $deleted) {
            return $this->backWithError(message: 'Study Material Deletion Failed');
        }

        return $this->redirectWithSuccess('teacher.study_material.index', 'Study Material Deleted Successfully.', $classroom->id);
    }

    public function preview(ClassRoom $classroom, StudyMaterial $studyMaterial)
    {
        $fileName = request()->get('fileName');
        $filePath = $studyMaterial->file;
        $fileUrl = Storage::url($filePath);

        //return Storage::response($studyMaterial->file, $fileName);
        return view('teacher.study_material.shownotes', compact('fileUrl', 'studyMaterial'));
    }
}
