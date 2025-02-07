<?php

use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('sellers', SellerController::class)->only('index', 'store');
Route::apiResource('sales', SaleController::class)->only('index', 'store');

Route::get('report', function () {
    $data = request()->all();
    $report = app(App\Application\Services\SaleReportService::class)->generateReport($data);
    return view('emails.sale_report_email', compact('report'));
});
