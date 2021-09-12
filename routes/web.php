<?php

use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\web\CartController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LangController;
use App\Http\Controllers\web\OrderController;
use App\Http\Controllers\web\ProductController;
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


Route::resource('lang', LangController::class)->only('store', 'destroy');

Route::middleware('lang')->group(function () {
    Route::resource('/', HomeController::class)->only('index');
    Route::resource('/category', CategoryController::class)->only('show')->parameters(['category' => 'category']);
    Route::resource('/product', ProductController::class)->only('show')->parameters(['product' => 'product']);

    Route::get('/cart/', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add-product/{product}', [CartController::class, 'store'])->name('addToCart');
    Route::patch('/cart/update-product/', [CartController::class, 'update'])->name('updateCart');
    Route::delete('/cart/delete-product/', [CartController::class, 'destroy'])->name('deleteFromCart');

    Route::resource('/order', OrderController::class)->only('index', 'show', 'store', 'destroy');
});


Route::prefix('dashboard')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard.home');
    Route::resource('/users', UserController::class)->only(['index', 'show', 'destroy']);
    // toggle user status
    Route::patch('user/activate/{user}', [UserController::class, 'active']);
    Route::patch('user/deactivate/{user}', [UserController::class, 'deactive']);
    // toggle user role
    Route::patch('user/promote/{user}', [UserController::class, 'promote']);
    Route::patch('user/demote/{user}', [UserController::class, 'demote']);

    // toggle product status
    Route::patch('product/activate/{product}', [AdminProductController::class, 'active']);
    Route::patch('product/deactivate/{product}', [AdminProductController::class, 'deactive']);

    Route::resource('categories', AdminCategoryController::class);
    Route::resource('products', AdminProductController::class)->except(['create', 'edit']);
    Route::resource('orders', AdminOrderController::class)->except(['create', 'edit']);
});

require __DIR__ . '/auth.php';