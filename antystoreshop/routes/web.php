<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Web\HomeController;
// use App\Http\Controllers\Web\CategoryController as WebCategoryController;

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


//danh muc
Route::resource('categories', CategoriesController::class);
Route::prefix('/categories')->group(function () {
    Route::get('/active/{id}', [CategoryController::class, 'active'])->name('categories.active');
    Route::get('/unactive/{id}', [CategoryController::class, 'unactive'])->name('categories.unactive');
});
Route::resource('brands', BrandController::class);
//san pham

Route::prefix('products')->group(function () {
    Route::get('/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::get('/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/forceDelete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
    Route::get('/active/{id}', [ProductController::class, 'active'])->name('products.active');
    Route::get('/unactive/{id}', [ProductController::class, 'unactive'])->name('products.unactive');
});
Route::resource('products', ProductController::class);
//tai khoan
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginAdmin'])->name('login.loginAdmin');

Route::group(['prefix' => 'frontend'], function () {
    Route::resource('home', HomeController::class);
    Route::get('/category/{slug}/{id}', [WebCategoryController::class,'index'])->name('category.product');

});
