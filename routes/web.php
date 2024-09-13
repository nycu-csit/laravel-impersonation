<?php

namespace NycuCsit\Impersonation\routes;

use Illuminate\Support\Facades\Route;
use NycuCsit\Impersonation\Http\Controllers\ImpersonationController;

Route::prefix('/impersonation')
    ->group(function () {
        Route::get(
            '/',
            [ImpersonationController::class, 'listUser']
        )->name('impersonation.list');

        Route::post(
            '/',
            [ImpersonationController::class, 'impersonateUser']
        )->name('impersonation.impersonate');
    });
