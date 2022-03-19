<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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

Route::prefix('cms')->middleware('guest:user,admin')->group(function () {
    Route::get('/{guard}/login', [AuthController::class, 'showLoginView'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('cms/admin')->middleware('auth:user,admin')->group(function () {
    Route::view('/', 'cms.dashboard');
    Route::resource('specialties', SpecialtyController::class);
    Route::resource('users', UserController::class);
    Route::resource('admins', AdminController::class);
    Route::get('logout',[AuthController::class,'logout'])->name('auth.logout');
});
