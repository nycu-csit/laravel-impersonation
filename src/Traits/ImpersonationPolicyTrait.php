<?php

namespace NycuCsit\Impersonation\Traits;

use Illuminate\Database\Eloquent\Model;

trait ImpersonationPolicyTrait
{
    /**
     * @param Model $user
     * @return bool
     */
    public function impersonate($user): bool
    {
        return in_array(
            $user?->role,
            config('impersonation.impersonable_roles')
        );
    }
}
