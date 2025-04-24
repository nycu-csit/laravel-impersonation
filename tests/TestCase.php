<?php

namespace NycuCsit\Impersonation\Tests;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Workbench\App\Models\User;

class TestCase extends BaseTestCase
{
    use WithWorkbench;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    protected function defineEnvironment($app): void
    {
        tap($app['config'], function (Repository $config) {
            $config->set('auth.providers.users', [
              'driver' => 'eloquent',
              'model' => User::class,
            ]);
        });
    }
}
