<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;

Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item}', [ItemController::class, 'detail']);

Route::middleware('auth')->group(function () {
    Route::get('/sell', [ItemController::class, 'sell']);
    Route::get('/mypage', [ProfileController::class, 'mypage']);
});
