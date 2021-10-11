<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
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


/*
 * Admin Router
 */

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


Route::middleware(['auth:sanctum,admin', 'verified'])->group(function () {
    // Admin Brand Router
    Route::prefix('brand')->group(function () {
        Route::get('/view', [BrandController::class, 'BrandView'])->name('brand.view');
        Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
        Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
        Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
    });

    // Admin Category Router
    Route::prefix('category')->group(function () {
        Route::get('/view', [CategoryController::class, 'CategoryView'])->name('category.view');
        Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
        Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
        Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

        // Admin Sub Category Router
        Route::prefix('sub')->group(function () {
            Route::get('/view', [SubCategoryController::class, 'SubCategoryView'])->name('subCategory.view');
            Route::get('/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subCategory.edit');
            Route::post('/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subCategory.store');
            Route::post('/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subCategory.update');
            Route::get('/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subCategory.delete');

            Route::get('/ajax/{category_id}',
                    [SubCategoryController::class, 'GetSubCategory'])->name('subCategory.ajax');

            // Admin Sub - Sub Category Router
            Route::prefix('sub')->group(function () {
                Route::get('/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('subSubCategory.view');
                Route::get('/edit/{id}', [SubCategoryController::class, 'SubSubCategoryEdit'])->name('subSubCategory.edit');
                Route::post('/store', [SubCategoryController::class, 'SubSubCategoryStore'])->name('subSubCategory.store');
                Route::post('/update', [SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subSubCategory.update');
                Route::get('/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete'])->name('subSubCategory.delete');

                Route::get('/ajax/{subCategory_id}', [SubCategoryController::class, 'GetSubSubCategory'])->name('subSubCategory.ajax');
            });
        });
    });

    // Admin Product Router
    Route::prefix('product')->group(function () {
        Route::get('/add', [ProductController::class, 'addProduct'])->name('product.add');
        Route::post('/store', [ProductController::class, 'storeProduct'])->name('product.store');
        Route::post('/update', [ProductController::class, 'updateProduct'])->name('product.update');
        Route::get('/manage', [ProductController::class, 'manageProduct'])->name('product.manage');
        Route::get('/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
        Route::get('/active/{id}', [ProductController::class, 'activeProduct'])->name('product.active');
        Route::get('/inactive/{id}', [ProductController::class, 'inactiveProduct'])->name('product.inactive');
        Route::get('/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');

        Route::post('/classification/update/', [ProductController::class, 'updateClassification'])->name('product.classification.update');
        Route::post('/image/store/', [ProductController::class, 'addImage'])->name('product.image.store');
        Route::get('/image/delete/{id}', [ProductController::class, 'deleteImage'])->name('product.image.delete');
    });

    // Admin Product Router
    Route::prefix('slide')->group(function () {
        Route::get('/add', [SliderController::class, 'viewSlide'])->name('slide.view');
        Route::post('/store', [SliderController::class, 'storeSlide'])->name('slide.store');
        Route::get('/active/{id}', [SliderController::class, 'activeSlide'])->name('slide.active');
        Route::get('/inactive/{id}', [SliderController::class, 'inactiveSlide'])->name('slide.inactive');
        Route::get('/delete/{id}', [SliderController::class, 'deleteSlide'])->name('slide.delete');
    });
});




