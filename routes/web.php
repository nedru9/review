<?php

use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::get('/review/{token}', [TokenController::class, 'show']);
Route::fallback(function () {
    abort(404, 'Такая страница не существует');
});
