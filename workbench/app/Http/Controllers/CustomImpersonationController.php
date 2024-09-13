<?php

namespace Workbench\App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use NycuCsit\Impersonation\Http\Controllers\ImpersonationController as Controller;

class CustomImpersonationController extends Controller
{
    protected $impersonableRoles = ['root', 'sudo'];

    public function canImpersonate(?Model $user): bool
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
