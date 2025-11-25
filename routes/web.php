<?php

use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::get('/review/{token}', [TokenController::class, 'show']);

// Маршрут для всех остальных URL
Route::fallback(function () {
    abort(404, 'Такая страница не существует'); // Это вызовет страницу 404
});
