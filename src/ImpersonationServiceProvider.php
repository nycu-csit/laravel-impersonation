<?php

namespace NycuCsit\Impersonation;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use NycuCsit\Impersonation\Http\Controllers\ImpersonationController;
use NycuCsit\Impersonation\Policies\ImpersonationPolicy;

class ImpersonationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfig();

        if (!config('impersonation.enabled')) {
            return;
        }

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'impersonation');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishConfig();
        $this->registerPolicy();
        $this->bindController();
    }

    protected function mergeConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/impersonation.php', 'impersonation');
    }

    protected function publishConfig(): void
    {
        $this->publishes(
            [__DIR__ . '/../config/impersonation.php' => config_path('impersonation.php')],
            'impersonation'
        );
    }

    protected function registerPolicy(): void
    {
        $userModelName = config('auth.providers.users.model');
        Gate::policy($userModelName, config('impersonation.policy', ImpersonationPolicy::class));
    }

    protected function bindController(): void
    {
        $this->app->bind(ImpersonationController::class, ImpersonationController::class);
    }
}
