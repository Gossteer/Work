<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserOrderController;
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

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::post('user-order', [UserOrderController::class, 'store'])->name('userorder.store');
    Route::group(['middleware' => ['isadmin']], function () {
        Route::resource('user', UserController::class);
        Route::post('order', [OrderController::class, 'store'])->name('order.store');
        Route::delete('order/{order}', [OrderController::class, 'delete'])->name('order.destroy ');
        Route::delete('user-order/{id}', [UserOrderController::class, 'delete'])->name('userorder.destroy');
        Route::get('user-order', [UserOrderController::class, 'index'])->name('userorder.index');
    });
});

require __DIR__.'/auth.php';
