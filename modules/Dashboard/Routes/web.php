<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Modules\Dashboard\Http\Controllers\DashboardController;
use Modules\Dashboard\Http\Controllers\ProfileController;
use Modules\Dashboard\Http\Controllers\SiteController;

Route::group(['prefix' => 'dashboard', 'middleware' => ['web', 'auth', 'canAccessAdmin'], 'as' => 'app.admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'canAccessAdmin'], 'as' => 'app.admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
    });
    Route::group(['prefix' => 'site', 'as' => 'site.'], function () {
        Route::get('/', [SiteController::class, 'index'])->name('index');
    });
});
