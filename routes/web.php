<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Admin

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'loginform'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.login.logout');

    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
