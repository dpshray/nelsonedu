<?php

use App\Http\Controllers\Admin\AssignTeacherController;
use App\Http\Controllers\Admin\ClassRoomController;
use App\Http\Controllers\Admin\ClassRoomStudentController;
use App\Http\Controllers\Admin\ExamReportController;
use App\Http\Controllers\Admin\ExamStudentController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\StudyAbroadController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignTeacherExamController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\AnswerController;
use App\Http\Controllers\Student\StudentClassRoomController;
use App\Http\Controllers\Student\StudentExamController;
use App\Http\Controllers\Student\StudentLectureVideoController;
use App\Http\Controllers\Student\StudentStudyMaterialController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\Teacher\ClassMeetingController;
use App\Http\Controllers\Teacher\LectureVideoController;
use App\Http\Controllers\Teacher\OptionController;
use App\Http\Controllers\Teacher\QuestionController;
use App\Http\Controllers\Teacher\StudyMaterialController;
use App\Http\Controllers\TeacherDashboardController;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [HomeController::class, 'home']);
Route::get('about-us', [HomeController::class, 'about']);
Route::get('classes', [HomeController::class, 'classes']);
Route::get('class/details/{id}', [HomeController::class, 'classdetails']);
Route::get('mock-tests', [HomeController::class, 'mocktest']);
Route::get('mock-test/details/{id}', [HomeController::class, 'mocktestdetails']);
Route::get('contact-us', [HomeController::class, 'contact']);
Route::get('notice', [HomeController::class, 'notice']);
Route::get('services', [HomeController::class, 'services']);
Route::get('gallery', [HomeController::class, 'gallery']);
Route::get('notice/details/{id}', [HomeController::class, 'noticedetails']);
Route::get('study-abroad', [HomeController::class, 'studyabroad']);
Route::get('abroad/details/{id}', [HomeController::class, 'abroaddetails']);

// Routes for Templates
Route::get('admin/add-questions-exam/{id}', [HomeController::class, 'addquestionsexam']);
Route::get('admin/showquestions/{id}', [HomeController::class, 'showquestionsexam']);
Route::get('admin/addoptions/{id}', [HomeController::class, 'addoptions']);
Route::get('admin/showclassroom', [HomeController::class, 'showclassroom']);

//end for Routes for Templates

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('isAdmin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('news', NewsController::class);
        Route::resource('study_abroad', StudyAbroadController::class);
        Route::get('dashboard', [AdminController::class, 'index'])->name('index');
        Route::resource('teacher', TeacherController::class)->except('show');
        Route::resource('classroom', ClassRoomController::class)->except(['index', 'show']);
        Route::resource('student', ExamStudentController::class)->only(['index', 'update']);

        Route::get('class_room_student', [ClassRoomStudentController::class, 'index'])->name('classroom.student.index');
        Route::put('class_room_student/{id}', [ClassRoomStudentController::class, 'update'])->name('classroom.student.update');

        Route::get('classroom/{classroom}/assign_teacher', [AssignTeacherController::class, 'create'])->name('assign_teacher.create');
        Route::post('classroom/{classroom}/assign_teacher', [AssignTeacherController::class, 'store'])->name('assign_teacher.store');
        Route::delete('classroom/{classroom}/assign_teacher', [AssignTeacherController::class, 'destroy'])->name('assign_teacher.destroy');

        Route::get('exam/{exam}/assign_teacher_exam', [AssignTeacherExamController::class, 'create'])->name('assign_teacher_exam.create');
        Route::post('exam/{exam}/assign_teacher_exam', [AssignTeacherExamController::class, 'store'])->name('assign_teacher_exam.store');
        Route::delete('exam/{exam}/assign_teacher_exam', [AssignTeacherExamController::class, 'destroy'])->name('assign_teacher_exam.destroy');

        Route::get('recording', [ClassMeetingController::class, 'getMeetingRecording']);
        Route::get('participants', [ClassMeetingController::class, 'getMeetingParticipants']);

    });

    Route::prefix('teacher')->name('teacher.')->group(function () {
        Route::get('dashboard', [TeacherDashboardController::class, 'index'])->name('index');
        Route::resource('exam', ExamController::class);
        Route::resource('classroom', ClassRoomController::class)->only('index');

        Route::get('classroom/{classroom}/study_material', [StudyMaterialController::class, 'index'])->name('study_material.index');
        Route::get('classroom/{classroom}/study_material/create', [StudyMaterialController::class, 'create'])->name('study_material.create');
        Route::get('classroom/{classroom}/study_material/{study_material}', [StudyMaterialController::class, 'preview'])->name('study_material.preview');
        Route::post('classroom/{classroom}/study_material', [StudyMaterialController::class, 'store'])->name('study_material.store');
        Route::get('classroom/{classroom}/study_material/{lectureVideo}/edit', [StudyMaterialController::class, 'edit'])->name('study_material.edit');
        Route::put('classroom/{classroom}/study_material/{lectureVideo}/update', [StudyMaterialController::class, 'update'])->name('study_material.update');
        Route::delete('classroom/{classroom}/study_material/{lectureVideo}', [StudyMaterialController::class, 'destroy'])->name('study_material.destroy');

        Route::get('classroom/{classroom}/lecture_video', [LectureVideoController::class, 'index'])->name('lecture_video.index');
        Route::get('classroom/{classroom}/lecture_video/create', [LectureVideoController::class, 'create'])->name('lecture_video.create');
        // Route::post('lecture_video/upload', [LectureVideoController::class, 'uploadFile'])->name('lecture_video.upload');
        Route::post('classroom/{classroom}/lecture_video', [LectureVideoController::class, 'store'])->name('lecture_video.store');
        Route::get('classroom/{classroom}/lecture_video/{lectureVideo}/show', [LectureVideoController::class, 'show'])->name('lecture_video.show');
        Route::get('classroom/{classroom}/lecture_video/{lectureVideo}/edit', [LectureVideoController::class, 'edit'])->name('lecture_video.edit');
        Route::put('classroom/{classroom}/lecture_video/{lectureVideo}', [LectureVideoController::class, 'update'])->name('lecture_video.update');
        Route::delete('classroom/{classroom}/lecture_video/{lectureVideo}', [LectureVideoController::class, 'destroy'])->name('lecture_video.destroy');

        Route::get('classroom/{classroom}/class-meeting/', [ClassMeetingController::class, 'index'])->name('class_meeting.index');
        Route::get('classroom/{classroom}/class-meeting/create', [ClassMeetingController::class, 'create'])->name('class_meeting.create');
        Route::post('classroom/{classroom}/class-meeting', [ClassMeetingController::class, 'store'])->name('class_meeting.store');
        Route::get('classroom/{classroom}/class-meeting/{classMeeting}/show', [ClassMeetingController::class, 'show'])->name('class_meeting.show');
        Route::get('classroom/{classroom}/class-meeting/{classMeeting}/edit', [ClassMeetingController::class, 'edit'])->name('class_meeting.edit');
        Route::put('classroom/{classroom}/class-meeting/{classMeeting}', [ClassMeetingController::class, 'update'])->name('class_meeting.update');
        Route::delete('classroom/{classroom}/class-meeting/{classMeeting}', [ClassMeetingController::class, 'destroy'])->name('class_meeting.destroy');

        Route::get('exam/{exam}/question/create', [QuestionController::class, 'create'])->name('question.create');
        Route::post('exam/{exam}/question', [QuestionController::class, 'store'])->name('question.store');
        Route::get('exam/{exam}/question', [QuestionController::class, 'index'])->name('question.index');
        Route::get('exam/{exam}/question/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
        Route::put('exam/{exam}/question/{question}', [QuestionController::class, 'update'])->name('question.update');
        Route::delete('exam/{exam}/question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');
        Route::get('exam/{exam}/question/create', [QuestionController::class, 'create'])->name('question.create');

        Route::get('question/{question}/option/create', [OptionController::class, 'create'])->name('option.create');
        Route::post('question/{question}/option', [OptionController::class, 'store'])->name('option.store');
        Route::get('question/{question}/option', [OptionController::class, 'index'])->name('option.index');
        Route::get('question/{question}/option/{option}/edit', [OptionController::class, 'edit'])->name('option.edit');
        Route::put('question/{question}/option/{option}', [OptionController::class, 'update'])->name('option.update');
        Route::delete('question/{question}/option/{option}', [OptionController::class, 'destroy'])->name('option.destroy');

        Route::get('exam/{exam}/student/result', [ExamStudentController::class, 'result'])->name('student.result');

        Route::get('/export-exam-report/{exam}', [ExamReportController::class, 'download'])->name('download-result');
    });

    Route::prefix('student')->controller(StudentDashboardController::class)->name('student.')->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');

        Route::get('exam', [StudentExamController::class, 'index'])->name('exam.index');
        Route::get('myexam', [StudentExamController::class, 'myexam'])->name('exam.myexam');
        Route::post('exam/{exam}', [StudentExamController::class, 'store'])->name('exam.store');
        Route::get('classroom', [StudentClassRoomController::class, 'index'])->name('classroom.index');
        Route::post('classroom/{classroom}', [StudentClassRoomController::class, 'store'])->name('classroom.store');
        Route::get('classroom/{classroom}', [StudentClassRoomController::class, 'show'])->name('classroom.show');
        Route::get('myclassroom', [StudentClassRoomController::class, 'myclassroom'])->name('classroom.myclassroom');
        Route::get('study_material/{studyMaterial}/preview', [StudentStudyMaterialController::class, 'preview'])->name('study_material.preview');
        Route::get('lecture_video/{lectureVideo}/show', [StudentLectureVideoController::class, 'show'])->name('lecture_video.show');

        Route::controller(AnswerController::class)->name('answer.')->group(function () {
            Route::get('exam/{exam}/question/create', 'create')->name('create');
            Route::post('exam/{exam}/question/', 'store')->name('store');
            Route::get('exam/{exam}/answer/result', 'result')->name('result');
        });
    });

    Route::prefix('exam')->controller(ExamController::class)->name('exam.')->group(function () {
        Route::get('/create', 'create')->name('create');
    });
});

require __DIR__.'/auth.php';
