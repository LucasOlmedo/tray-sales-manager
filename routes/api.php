<?php

use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('sellers', SellerController::class)->only('index', 'store');
Route::apiResource('sales', SaleController::class)->only('index', 'store');
