<?php

namespace App\Providers;

use App\Domain\Repositories\SaleReportRepositoryInterface;
use App\Domain\Repositories\SaleRepositoryInterface;
use App\Domain\Repositories\SellerRepositoryInterface;
use App\Infrastructure\Repositories\SaleReportRepository;
use App\Infrastructure\Repositories\SaleRepository;
use App\Infrastructure\Repositories\SellerRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(SellerRepositoryInterface::class, SellerRepository::class);
        $this->app->bind(SaleRepositoryInterface::class, SaleRepository::class);
        $this->app->bind(SaleReportRepositoryInterface::class, SaleReportRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
