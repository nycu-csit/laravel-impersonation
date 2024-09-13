<?php

namespace NycuCsit\Impersonation\Tests;

use Workbench\App\Models\User;
use Illuminate\Support\Facades\Auth;

class ImpersonationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->admin = User::where('role', 'admin')->first();
        $this->user = User::where('role', 'user')->first();
    }

    public function testCanImpersonate()
    {
        $anonymousResponse = $this->get('/impersonation');
        $anonymousResponse->assertStatus(401);

        $userResponse = $this->actingAs($this->user)->get('/impersonation');
        $userResponse->assertStatus(401);

        $adminResponse = $this->actingAs($this->admin)->get('/impersonation');
        $adminResponse->assertStatus(200);
    }

    public function testImpersonationStatus()
    {
        $this->post('/impersonation', ['id' => 1])
          ->assertStatus(401);

        $this->actingAs($this->user)
          ->post('/impersonation', ['id' => 1])
          ->assertStatus(401);

        $this->actingAs($this->admin)
          ->post('/impersonation', ['id' => 1])
          ->assertStatus(302)
          ->assertRedirect(config('impersonation.post_impersonate_route'));
    }

    public function testUserList()
    {
        $view = $this->actingAs($this->admin)->get('/impersonation');
        $view->assertSeeTextInOrder([
          'id', 'name', 'email', 'role',
          '1', 'admin', 'admin@example.com', 'admin',
          '2', 'user', 'user@example.com', 'user',
        ]);
    }

    public function testImpersonation()
    {
        $this->actingAs($this->admin)->post('/impersonation', ['id' => 2]);
        $this->assertEquals(Auth::id(), 2);
    }
}
