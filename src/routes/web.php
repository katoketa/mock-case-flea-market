<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;

Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item}', [ItemController::class, 'detail']);

Route::middleware('auth')->group(function () {
    Route::get('/sell', [ItemController::class, 'sell']);
    Route::get('/mypage', [ProfileController::class, 'mypage']);
    Route::get('/mypage/profile', [ProfileController::class, 'edit']);
    Route::post('/mypage/profile', [ProfileController::class, 'update']);
    Route::get('/purchase/{item}', [ItemController::class, 'purchase']);
    Route::get('/purchase/address/{item}', [ItemController::class, 'changeAddress']);
});
