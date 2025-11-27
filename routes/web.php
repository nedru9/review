<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::post('/review/get-form', [ReviewController::class, 'getReviewForm']);
Route::post('/review/{client}/send-review', [ReviewController::class, 'sendReviewForm'])->name('review.sendReviewForm');
Route::get('/review/{client}', [ReviewController::class, 'show']);

Route::fallback(function () {
    abort(404, 'Такая страница не существует');
});
