<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/review/{token}', [ReviewController::class, 'show']);
Route::post('/review/send-review', [ReviewController::class, 'sendReview']);
Route::fallback(function () {
    abort(404, 'Такая страница не существует');
});
