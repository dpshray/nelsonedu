<?php

namespace App\Policies;

use App\Constants\Constants;
use App\Models\User;

class QuestionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct() {}

    public function create(User $user, $exam): bool
    {

        if (! $user->getPermissionsViaRoles()->contains('name', Constants::CAN_CREATE_QUESTIONS)) {
            return false;
        }

        return $exam->isAssignedTo($user->id);
    }

    public function edit(User $user, $exam): bool
    {

        if (! $user->getPermissionsViaRoles()->contains('name', Constants::CAN_EDIT_QUESTIONS)) {
            return false;
        }

        return $exam->isAssignedTo($user->id);
    }

    public function delete(User $user, $exam): bool
    {

        if (! $user->getPermissionsViaRoles()->contains('name', Constants::CAN_DELETE_QUESTIONS)) {
            return false;
        }

        return $exam->isAssignedTo($user->id);
    }
}
