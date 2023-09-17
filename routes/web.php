<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\MenuFilterController;
use App\Http\Controllers\CategoryMenuController;
use App\Http\Controllers\ViewCategoryController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PesananController;

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

//Autentication
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'authenticate')->name('auth');
    Route::post('/logout', 'logout')->name('logout');
});

//Forgot Password
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/forget-password', 'showForgetPasswordForm')->name('forget.password.get');
    Route::post('/forget-password', 'submitForgetPasswordForm')->name('forget.password.post');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
    Route::post('/reset-password', 'submitResetPasswordForm')->name('reset.password.post');
});

//Admin General Page
Route::group(['middleware' => ['auth', 'level:admin,kasir,manager']], function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/transaksi', TransaksiController::class);
    Route::get('/pesanan', [PesananController::class, 'index']);
    Route::put('/pesanan/{id}', [PesananController::class, 'update'])->name('pesanan.update');
});

//Superuser Page
Route::group(['middleware' => ['auth', 'level:admin,manager']], function () {
    Route::resource('/user', UserController::class);
    Route::post('laporan/pesanan', [LaporanController::class, 'pesanan'])->name('laporan.pesanan');
    Route::post('laporan/transaksi', [LaporanController::class, 'transaksi'])->name('laporan.transaksi');
});


//Guest Page
Route::resource('/', HomeController::class);
Route::resource('/category', CategoryMenuController::class);
Route::resource('/menu', MenuController::class);
Route::resource('/about', AboutController::class);


//View By Category
Route::controller(ViewCategoryController::class)->group(function () {
    Route::get('/view-category/{id}', 'index');
});

//Filter and Search
Route::controller(MenuFilterController::class)->group(function () {
    Route::get('/search', 'search')->name('menu.search');
});

//Cart
Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/cart/{id}', [CartController::class, 'tambah'])->where('id', '[0-9]+');
Route::post('/update-cart/{id}', [CartController::class, 'updateCart'])->name('update.cart');
Route::delete('/delete-cart-product/{id}', [CartController::class, 'delete'])->name('delete.cart.product');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');