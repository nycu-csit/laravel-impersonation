<?php

namespace Workbench\App\Policies;

use Workbench\App\Models\CustomUser;

class CustomUserPolicy
{
    protected $impersonableRoles = ['root', 'sudo'];

    public function impersonate(CustomUser $user): bool
    {
        if (is_null($user) || is_null($user->groups)) {
            return false;
        }

        $groups = collect(json_decode($user->groups));
        return $groups->contains(
            fn ($group) => in_array($group, $this->impersonableRoles)
        );
    }
}
