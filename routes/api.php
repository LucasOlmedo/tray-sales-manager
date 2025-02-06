<?php

use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('sellers', SellerController::class)->only('index', 'store');
