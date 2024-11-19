<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        Gate::allowIf(fn (User $user) => $user->hasRole(Constants::ROLE_TEACHER) || $user->hasRole(Constants::ROLE_ADMIN));

        return view('teacher.index');
    }
}
