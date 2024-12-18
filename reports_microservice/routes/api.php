<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('api')->group(function () {
    Route::get('/products-category', [ReportController::class, 'ProductsWithCategory']);
    Route::get('/products-order-price', [ReportController::class, 'ProductsOrdered']);
    Route::get('/products-zero-stock', [ReportController::class, 'ProductsZeroStock']);
    Route::get('/products-with-stock-above-ten', [ReportController::class, 'ProductStockTen']);
});
