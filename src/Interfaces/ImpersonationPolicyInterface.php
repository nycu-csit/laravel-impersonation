<?php

namespace NycuCsit\Impersonation\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 */
interface ImpersonationPolicyInterface
{
    /**
     * @param T $user
     * @return bool
     */
    public function impersonate($user): bool;
}
