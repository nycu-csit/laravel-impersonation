<?php

namespace Workbench\App\Policies;

use NycuCsit\Impersonation\Interfaces\ImpersonationPolicyInterface;
use Workbench\App\Models\CustomUser;

/**
 * @implements ImpersonationPolicyInterface<CustomUser>
 */
class CustomImpersonationPolicy implements ImpersonationPolicyInterface
{
    protected $impersonableRoles = ['root', 'sudo'];

    public function impersonate($user): bool
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
