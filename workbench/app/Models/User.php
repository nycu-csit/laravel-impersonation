<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Workbench\Database\Factories\UserFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'test-users';

    public $timestamps = false;

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }
}
