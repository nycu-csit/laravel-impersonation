<?php

namespace NycuCsit\Impersonation\Policies;

use Illuminate\Database\Eloquent\Model;
use NycuCsit\Impersonation\Interfaces\ImpersonationPolicyInterface;

/**
 * @implements ImpersonationPolicyInterface<Model>
 */
class ImpersonationPolicy implements ImpersonationPolicyInterface
{
    public function impersonate($user): bool
    {
        return in_array(
            $user?->role,
            config('impersonation.impersonable_roles')
        );
    }
}
