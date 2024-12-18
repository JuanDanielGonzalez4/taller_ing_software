<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportsController;
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


Route::get('/products-category', [ReportsController::class, 'ProductsWithCategory']);
Route::get('/products-price', [ReportsController::class, 'ProductsOrdered']);
Route::get('/products-stock', [ReportsController::class, 'ProductsZeroStock']);
Route::get('/products-stock-ten', [ReportsController::class, 'ProductStockTen']);
