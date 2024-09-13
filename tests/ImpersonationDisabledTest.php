<?php

namespace NycuCsit\Impersonation\Tests;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Workbench\App\Models\User;

class ImpersonationDisabledTest extends TestCase
{
    use WithWorkbench;
    use RefreshDatabase;

    // since `register()` in the service provider is using `config()`
    // modifying config value should be set in this function
    // ref: https://github.com/orchestral/testbench/issues/137#issuecomment-267635976
    protected function resolveApplicationConfiguration($app)
    {
        parent::resolveApplicationConfiguration($app);

        tap($app['config'], function (Repository $config) {
            $config->set('impersonation.enabled', false);
        });
    }

    public function testImpersonationDisabled()
    {
        $admin = User::where('role', 'admin')->first();
        $response = $this->actingAs($admin)->get('/impersonation');
        $response->assertStatus(404);
    }
}
