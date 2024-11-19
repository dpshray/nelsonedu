<?php

namespace App\Policies;

use App\Constants\Constants;
use App\Models\User;

class OptionPolicy
{
    public function create(User $user, $question): bool
    {
        return $user->getPermissionsViaRoles()->contains('name', Constants::CAN_CREATE_OPTIONS);
    }

    public function edit(User $user, $question): bool
    {
        return $user->getPermissionsViaRoles()->contains('name', Constants::CAN_EDIT_OPTIONS);
    }

    public function delete(User $user, $question): bool
    {
        return $user->getPermissionsViaRoles()->contains('name', Constants::CAN_DELETE_OPTIONS);

    }
}
