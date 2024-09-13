<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Workbench\Database\Factories\CustomUserFactory;

class CustomUser extends Authenticatable
{
    use HasFactory;
    use HasUuids;

    protected $table = 'custom-users';

    protected $primaryKey = 'uuid';

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'groups' => 'array',
        ];
    }

    protected static function newFactory(): Factory
    {
        return CustomUserFactory::new();
    }
}
