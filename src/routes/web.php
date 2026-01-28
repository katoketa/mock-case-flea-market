<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item}', [ItemController::class, 'detail']);

Route::middleware('auth')->group(function () {
    //
});
