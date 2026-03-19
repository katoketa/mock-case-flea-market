<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PurchaseHistoryController;

Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item}', [ItemController::class, 'detail']);

Route::middleware('auth')->group(function () {
    Route::get('/sell', [ItemController::class, 'sell']);
    Route::post('/sell', [ItemController::class, 'create']);
    Route::get('/mypage', [ProfileController::class, 'mypage']);
    Route::get('/mypage/profile', [ProfileController::class, 'edit']);
    Route::post('/mypage/profile', [ProfileController::class, 'update']);
    Route::post('/item/{item}', [CommentController::class, 'create']);
    Route::patch('/item/{item}', [ItemController::class, 'createFavorite']);
    Route::delete('/item/{item}', [ItemController::class, 'destroyFavorite']);
    Route::get('/purchase/{item}', [ItemController::class, 'purchase']);
    Route::post('/purchase/{item}', [PurchaseHistoryController::class, 'payment']);
    Route::get('/purchase/address/{item}', [ItemController::class, 'editAddress']);
    Route::post('/purchase/address/{item}', [ItemController::class, 'updateAddress']);
});
