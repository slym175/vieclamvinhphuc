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

use UniSharp\LaravelFilemanager\Lfm;

Route::group(['prefix' => 'media', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
