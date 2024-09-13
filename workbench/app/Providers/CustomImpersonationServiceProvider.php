<?php

namespace Workbench\App\Providers;

use Workbench\App\Http\Controllers\CustomImpersonationController;
use NycuCsit\Impersonation\ImpersonationServiceProvider as ServiceProvider;
use NycuCsit\Impersonation\Http\Controllers\ImpersonationController as VendorImpersonationController;

class CustomImpersonationServiceProvider extends ServiceProvider
{
    public function bindController(): void
    {
        $this->app->bind(VendorImpersonationController::class, CustomImpersonationController::class);
    }
}
