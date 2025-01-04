<?php

namespace App\Policies;

use App\Constants\Constants;
use App\Models\User;

class ExamPolicy
{
    public function create(User $user): bool
    {
        return $user->getPermissionsViaRoles()->contains('name', Constants::CAN_CREATE_EXAMS);
    }

    public function index(User $user): bool
    {
        return $user->getPermissionsViaRoles()->contains('name', Constants::CAN_VIEW_EXAMS);
    }
}
