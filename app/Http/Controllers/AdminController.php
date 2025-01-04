<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index()
    {
        Gate::allowIf(fn (User $user) => $user->hasRole(Constants::ROLE_ADMIN));

        return view('admin.index');
    }

    public function showaddclass()
    {
        Gate::allowIf(fn (User $user) => $user->hasRole(Constants::ROLE_ADMIN));

        return view('admin.showaddclass');
    }

    public function showclasses()
    {
        Gate::allowIf(fn (User $user) => $user->hasRole(Constants::ROLE_ADMIN));

        return view('admin.showclasses');
    }
}
