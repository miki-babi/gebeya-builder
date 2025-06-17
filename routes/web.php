<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

Route::post('/telegram/webhook', [TelegramController::class, 'handleWebhook'])->withoutMiddleware([VerifyCsrfToken::class]);



Route::get('/', function () {
    return view('welcome');
});

Route::get('products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
Route::post('products/store', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
Route::get('products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('products/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
Route::put('products/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
Route::delete('products/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');


Route::post('orders/place', [App\Http\Controllers\OrderController::class, 'place'])->name('orders.place');
Route::get('orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
Route::get('orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
Route::get('orders/{id}/edit', [App\Http\Controllers\OrderController::class, 'edit'])->name('orders.edit');
Route::put('orders/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('orders.update');
Route::delete('orders/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('orders.destroy');


Route::post('/telegram/startapp', function (Request $request) {
    Log::info('Telegram Start Param: ', ['start_param' => $request->start_param]);
    Log::info('Telegram User Info: ', ['user' => $request->user]);

    return response()->json(['status' => 'logged']);
})->name('telegram.startapp');