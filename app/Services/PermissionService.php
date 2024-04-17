<?php

namespace App\Services;

use App\Enums\Roles;
use App\Models\User;

class PermissionService
{
    /**
     * Grant/remove admin access to/from user
     *
     * @param User $user
     * @return void
     */
    public function toggleAdminRole(User $user): void
    {
        if ($user->hasRole(Roles::SuperAdmin->value)) {
            $user->removeRole(Roles::SuperAdmin->value);
        } else {
            $user->assignRole(Roles::SuperAdmin->value);
        }
    }
}