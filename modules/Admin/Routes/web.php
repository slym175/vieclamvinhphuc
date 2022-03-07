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

use Modules\Admin\Http\Controllers\DashboardController;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'canAccessAdmin'], 'as' => 'app.admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
