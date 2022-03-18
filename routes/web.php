<?php

use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\UserController;
use App\Models\Specialty;
use GuzzleHttp\Middleware;
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

Route::prefix('cms/admin')->group(function(){
    Route::view('/login', 'cms.auth.login')->name('auth.login');
});

Route::prefix('cms/admin')->middleware('auth:web,admin')->group(function () {
    Route::view('/', 'cms.dashboard');
    Route::resource('specialties', SpecialtyController::class);
    Route::resource('users', UserController::class);
});


