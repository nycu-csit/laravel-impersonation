<?php

namespace Workbench\Database\Seeders;

use Illuminate\Database\Seeder;
use Workbench\App\Models\CustomUser;
use Workbench\App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(2)
            ->sequence(
                [
                    'name' => 'admin',
                    'email' => 'admin@example.com',
                    'role' => 'admin',
                ],
                [
                    'name' => 'user',
                    'email' => 'user@example.com',
                    'role' => 'user',
                ]
            )
            ->create();

        CustomUser::factory()
            ->count(3)
            ->sequence(
                [
                    'uuid' => 'e1ab7cd0-098a-432b-8150-ca904756620e',
                    'name' => 'root',
                    'uid' => 0,
                    'shell' => '/bin/sh',
                    'groups' => '["root"]',
                ],
                [
                    'uuid' => '463a3506-b24a-4501-984e-60a4b6799910',
                    'name' => 'owo',
                    'uid' => 1000,
                    'shell' => '/bin/zsh',
                    'groups' => '["sudo", "owo"]',
                ],
                [
                    'uuid' => '803ea4d4-e725-4c49-ae3a-85e56082fba2',
                    'name' => 'www-data',
                    'uid' => 33,
                    'shell' => '/usr/sbin/nologin',
                    'groups' => '["www-data"]',
                ],
            )
            ->create();
    }
}
