<?php

namespace Workbench\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Workbench\App\Models\CustomUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Workbench\Models\CustomUser>
 */
class CustomUserFactory extends Factory
{
    protected $model = CustomUser::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'uid' => fake()->randomNumber(),
            'shell' => '/bin/zsh',
            'groups' => ['www'],
        ];
    }
}
