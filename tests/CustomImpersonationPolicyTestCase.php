<?php

namespace NycuCsit\Impersonation\Tests;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Workbench\App\Models\CustomUser;
use NycuCsit\Impersonation\Tests\TestCase as BaseTestCase;

class CustomImpersonationPolicyTestCase extends BaseTestCase
{
    use WithWorkbench;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    protected function defineEnvironment($app): void
    {
        parent::defineEnvironment($app);

        tap($app['config'], function (Repository $config) {
            $config->set('auth.providers.users.model', CustomUser::class);

            $config->set('impersonation', [
                'post_impersonation_route' => '/meow',

                'display_columns' => [
                    'uuid',
                    'name',
                    'uid',
                    'groups',
                ],
            ]);
        });
    }
}
