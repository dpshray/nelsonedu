<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Exam;
use App\Models\News;
use App\Models\StudyAbroad;

class HomeController extends Controller
{
    public function home()
    {
        $classroom = ClassRoom::orderBy('created_at', 'desc')->get();
        $news = News::latest()->take(3)->get();

        return view('users.home', compact('classroom', 'news'));
    }

    public function about()
    {
        $classroom = ClassRoom::orderBy('created_at', 'desc')->get();

        return view('users.about', compact('classroom'));
    }

    public function classes()
    {
        $classroom = ClassRoom::orderBy('created_at', 'desc')->get();

        return view('users.classes', compact('classroom'));
    }

    public function classdetails($id)
    {
        $detail = ClassRoom::find($id);

        return view('users.classdetails', compact('detail'));
    }

    public function mocktest()
    {
        $exam = Exam::orderBy('created_at', 'desc')->get();

        return view('users.mocktests', compact('exam'));
    }

    public function mocktestdetails($id)
    {
        $detail = Exam::find($id);

        return view('users.mocktestdetails', compact('detail'));
    }

    public function contact()
    {
        return view('users.contact');
    }

    public function addquestionsexam()
    {
        return view('templates.addquestionsexam');
    }

    public function showquestionsexam()
    {
        return view('templates.showquestionsexam');
    }

    public function addoptions()
    {
        return view('templates.addoptions');
    }

    public function showclassroom()
    {
        return view('templates.showclassroom');
    }

    public function notice()
    {
        $news = News::orderBy('created_at', 'desc')->get();

        return view('users.shownotice', compact('news'));
    }

    public function noticedetails($id)
    {
        $detail = News::find($id);
        $news = News::orderBy('created_at', 'desc')->limit(5)->get();

        return view('users.noticedetails', compact('detail', 'news'));
    }

    public function studyabroad()
    {
        $abroad = StudyAbroad::orderBy('created_at', 'desc')->get();

        return view('users.showabroad', compact('abroad'));
    }

    public function abroaddetails($id)
    {
        $detail = StudyAbroad::find($id);
        $abroad = StudyAbroad::orderBy('created_at', 'desc')->limit(5)->get();

        return view('users.abroaddetails', compact('detail', 'abroad'));
    }
}
