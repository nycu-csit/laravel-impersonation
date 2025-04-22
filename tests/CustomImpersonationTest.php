<?php

namespace NycuCsit\Impersonation\Tests;

use Illuminate\Support\Facades\Auth;
use NycuCsit\Impersonation\Tests\CustomImpersonationPolicyTestCase as TestCase;
use Workbench\App\Models\CustomUser;

class CustomImpersonationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->root = CustomUser::where('name', 'root')->first();
        $this->sudo = CustomUser::where('name', 'owo')->first();
        $this->wwwData = CustomUser::where('name', 'www-data')->first();
    }

    public function testCanImpersonate()
    {
        $anonymousResponse = $this->get('/impersonation');
        $anonymousResponse->assertStatus(403);

        $rootResponse = $this->actingAs($this->root)->get('/impersonation');
        $rootResponse->assertStatus(200);

        $sudoResponse = $this->actingAs($this->sudo)->get('/impersonation');
        $sudoResponse->assertStatus(200);

        $wwwDataResponse = $this->actingAs($this->wwwData)->get('/impersonation');
        $wwwDataResponse->assertStatus(403);
    }

    public function testImpersonationStatus()
    {
        $rootUuid = $this->root->uuid;

        $this->post('/impersonation', ['id' => $rootUuid])
            ->assertStatus(403);

        $this->actingAs($this->root)
            ->post('/impersonation', ['id' => $rootUuid])
            ->assertStatus(302)
            ->assertRedirect('/meow');

        $this->actingAs($this->sudo)
            ->post('/impersonation', ['id' => $rootUuid])
            ->assertStatus(302)
            ->assertRedirect('/meow');

        $this->actingAs($this->wwwData)
            ->post('/impersonation', ['id' => $rootUuid])
            ->assertStatus(403);
    }

    public function testUserList()
    {
        $view = $this->actingAs($this->root)->get('/impersonation');
        $view->assertSeeTextInOrder([
            'uuid', 'name', 'uid', 'groups',
            'e1ab7cd0-098a-432b-8150-ca904756620e', 'root', '0', '["root"]',
            '463a3506-b24a-4501-984e-60a4b6799910', 'owo', '1000', '["sudo", "owo"]',
            '803ea4d4-e725-4c49-ae3a-85e56082fba2', 'www-data', '33', '["www-data"]',
        ])
            ->assertDontSeeText('/bin/sh')
            ->assertDontSeeText('/bin/zsh')
            ->assertDontSeeText('/usr/sbin/nologin');

    }

    public function testImpersonation()
    {
        $wwwDataUuid = $this->wwwData->uuid;
        $this->actingAs($this->root)->post('/impersonation', ['id' => $wwwDataUuid]);
        $this->assertEquals(Auth::id(), $wwwDataUuid);
    }
}
