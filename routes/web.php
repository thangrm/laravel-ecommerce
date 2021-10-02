<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;

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

// User Router
Route::get('/', [IndexController::class,'index']);

Route::group(['prefix' => 'user'], function () {
    Route::middleware(['auth:sanctum,web', 'verified'])->group(function () {
        Route::get('/logout', [IndexController::class, 'userLogout'])->name('user.logout');
        Route::get('/profile', [IndexController::class, 'userProfile'])->name('user.profile');
        Route::get('/password', [IndexController::class, 'userPassword'])->name('user.password');

        Route::post('profile/edit', [IndexController::class, 'editProfile'])->name('user.profile.edit');
        Route::post('/password', [IndexController::class, 'changePassword'])->name('user.password.change');
    });
});


Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Admin Router

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'loginform'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth:sanctum,admin', 'verified'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.index');
        })->name('admin.dashboard');

        Route::get('/profile', [AdminProfileController::class, 'profile'])->name('admin.profile');
        Route::post('/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::post('/password', [AdminProfileController::class, 'password'])->name('admin.password');
    });
});

// Admin Brand Router

Route::prefix('brand')->group(function(){
    Route::get('/view', [BrandController::class,'BrandView'])->name('brand.view');
    Route::get('/edit/{id}', [BrandController::class,'BrandEdit'])->name('brand.edit');
    Route::post('/store', [BrandController::class,'BrandStore'])->name('brand.store');
    Route::post('/update', [BrandController::class,'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class,'BrandDelete'])->name('brand.delete');
});

// Admin Category Router

Route::prefix('category')->group(function(){
    Route::get('/view', [CategoryController::class,'CategoryView'])->name('category.view');
    Route::get('/edit/{id}', [CategoryController::class,'CategoryEdit'])->name('category.edit');
    Route::post('/store', [CategoryController::class,'CategoryStore'])->name('category.store');
    Route::post('/update', [CategoryController::class,'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class,'CategoryDelete'])->name('category.delete');
});