<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MainOrderController;
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
    return redirect()->route('dashboard.welcome');
});

Auth::routes();

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('clients', ClientController::class)->except(['show']);
    Route::resource('orders', OrderController::class)->except(['show']);
    Route::get('orders/create/{client}', [OrderController::class, 'create'])->name('orders.create');
    Route::post('orders/store/{client}', [OrderController::class, 'store'])->name('orders.store');
    Route::get('orders/edit/{client}/{order}', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('orders/update/{client}/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('orders/{order}/products', [MainOrderController::class, 'products'])->name('mainorders.products');
    Route::delete('orders/delete/{order}', [MainOrderController::class, 'destroy'])->name('mainorders.destroy');


});
