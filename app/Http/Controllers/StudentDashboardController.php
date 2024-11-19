<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class StudentDashboardController extends Controller
{
    public function index()
    {
        Gate::allowIf(fn (User $user) => $user->hasRole(Constants::ROLE_STUDENT) || $user->hasRole(Constants::ROLE_ADMIN));

        return view('student.dashboard');
    }
}
