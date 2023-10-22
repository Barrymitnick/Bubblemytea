<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PoppingController;

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

Route::get('/register', function () {
    return view('register');
});

// Route::get('/cart', function () {
//     return view('cart');
// });


Route::get('/', [AuthController::class, 'autoLogin']);

Route::get('login', [AuthController::class, 'autoLogin']);

Route::post('registration', [AuthController::class, 'registration'])->name('auth.register');

Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::get('home', [ProductController::class, 'index'])->name('product.fetch');

Route::post('home', [OrderController::class, 'add'])->name('order.add');

Route::get('cart', [OrderController::class, 'getAll']);

Route::post('cart', [OrderController::class, 'deleteOrder'])->name('order.delete');

Route::post('order', [OrderController::class, 'checkoutOrder'])->name('order.checkout');

Route::get('history', [OrderController::class, 'fetchOrderHistory'])->name('order.history');

Route::get('profil', [AuthController::class, 'showUser'])->name('user.show');

Route::get('login', [AuthController::class, 'signOut'])->name('user.logout');

Route::post('profil', [AuthController::class, 'update'])->name('user.update');

Route::get('admin', [ProductController::class, 'getData'])->name('admin.fetch');

Route::post('admin', [PoppingController::class, 'deleteOrEdit'])->name('poppings.edit');

Route::post('/', [PoppingController::class, 'add'])->name('popping.add');

Route::get('product', [ProductController::class, 'add'])->name('product.add');

Route::post('product', [ProductController::class, 'edit'])->name('product.edit');

