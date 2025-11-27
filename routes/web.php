<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::post('/review/get-form', [ReviewController::class, 'getReviewForm']);
Route::post('/review/send-form', [ReviewController::class, 'sendReviewForm']);
Route::get('/review/{client}', [ReviewController::class, 'show']);
Route::post('/review/send-review', [ReviewController::class, 'sendReview'])->name('review.sendReview');;
Route::fallback(function () {
    abort(404, 'Такая страница не существует');
});
