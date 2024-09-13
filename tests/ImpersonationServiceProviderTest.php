<?php

namespace NycuCsit\Impersonation\Tests;

use NycuCsit\Impersonation\Tests\TestCase;

class ImpersonationServiceProviderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testRoutes(): void
    {
        $routes = $this->app['router']->getRoutes();
        $this->assertNotNull($routes->getByName('impersonation.list'));
        $this->assertNotNull($routes->getByName('impersonation.impersonate'));
    }
}
