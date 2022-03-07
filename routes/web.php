<?php

use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::group(['middleware' => ['web', 'isAuthView']], function () {
    Auth::routes();

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/');
    })->middleware(['auth', 'signed'])->name('verification.verify');
});

Route::get('/setting/language/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'vi'])) {
        abort(400);
    }
    App::setLocale($locale);
    return redirect('/');
});
