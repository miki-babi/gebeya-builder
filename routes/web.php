<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/telegram/webhook', [TelegramController::class, 'handleWebhook'])->withoutMiddleware([VerifyCsrfToken::class]);
