<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\TransactionController as DashboardTransactionController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\HomeController as StoreHomeController;
use App\Http\Controllers\Store\ProductController as StoreProductController;
use App\Http\Controllers\Store\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('store.index');
});

Auth::routes();

Route::prefix('store')->group(function () {
    Route::get('/', [StoreHomeController::class, 'index'])->name('store.index');

    // Product Store Route
    Route::controller(StoreProductController::class)->group(function () {
        Route::get('/product/all', 'index')->name('store.product.index');
        Route::get('/product/all/{slug}', 'getBySlug')->name('store.product.getBySlug');
        Route::get('/product/detail/{id}', 'show')->name('store.product.show');
    });

    // Cart Product Route
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart/all', 'index')->name('store.cart.index');
        Route::post('/cart/add/{id}', 'addCart')->name('store.cart.addCart');
        Route::delete('/cart/destroy/{id}', 'destroy')->name('store.cart.destroy');
    });

    // Transaction Route
    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transactions/{id}', 'index')->name('store.transaction.index');
        Route::post('/transactions', 'store')->name('store.transaction.store');
        Route::post('/transactions/upload/{id}', 'upload')->name('store.transaction.upload');
    });
});

Route::get('/forcelogout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
});

Route::group(['middleware' => 'role:Super Admin'], function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
        Route::put('/update-picture', [HomeController::class, 'updateProfilePicture'])->name('update.profile.picture');
        Route::put('/update-profile', [HomeController::class, 'updateProfile'])->name('update.profile');

        // User Route
        Route::controller(UserController::class)->group(function () {
            Route::get('/user', 'index')->name('user.index');
            Route::get('/user/create', 'create')->name('user.create');
            Route::post('/user/store', 'store')->name('user.store');
            Route::get('/user/edit/{id}', 'edit')->name('user.edit');
            Route::put('/user/update/{id}', 'update')->name('user.update');
            Route::delete('/user/destroy/{id}', 'destroy')->name('user.destroy');
        });

        // Product Route
        Route::controller(ProductController::class)->group(function () {
            Route::get('/product', 'index')->name('product.index');
            Route::get('/product/create', 'create')->name('product.create');
            Route::post('/product/store', 'store')->name('product.store');
            Route::get('/product/edit/{id}', 'edit')->name('product.edit');
            Route::put('/product/update/{id}', 'update')->name('product.update');
            Route::delete('/product/destroy/{id}', 'destroy')->name('product.destroy');
        });

        // Category Product Route
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category', 'index')->name('category.index');
            Route::get('/category/create', 'create')->name('category.create');
            Route::post('/category/store', 'store')->name('category.store');
            Route::get('/category/edit/{id}', 'edit')->name('category.edit');
            Route::put('/category/update/{id}', 'update')->name('category.update');
            Route::delete('/category/destroy/{id}', 'destroy')->name('category.destroy');
        });

        // Transaction Verification Route
        Route::controller(DashboardTransactionController::class)->group(function () {
            Route::get('/transactions', 'index')->name('transactions.index');
            Route::put('/transactions/verification/{id}/{status}', 'edit')->name('transactions.verification');
        });
    });
});
