<?php

use Illuminate\Http\Request;
use Modules\Location\Http\Controllers\APIs\LocationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1/location', 'app.apis.location.'], function () {
    Route::get('/', [LocationController::class, 'index'])->name('index');
    Route::post('/get_locations', [LocationController::class, 'getLocations'])->name('get_locations');
    Route::post('/store_location', [LocationController::class, 'storeLocation'])->name('store_location');
});
