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

use Modules\Location\Http\Controllers\LocationController;

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'canAccessAdmin'], 'as' => 'app.admin.'], function () {
    Route::group(['prefix' => 'location', 'as' => 'location.'], function () {
        Route::get('/', [LocationController::class, 'index'])->name('index');
    });
});
