<?php

namespace App\Infrastructure\Repositories;

use App\Application\DTOs\Filters\SaleReportFilterDTO;
use App\Application\Mappers\SaleMapper;
use App\Domain\Entities\SaleReport;
use App\Domain\Repositories\SaleReportRepositoryInterface;
use App\Models\Sale;
use DateTime;

class SaleReportRepository implements SaleReportRepositoryInterface
{
    public function getReport(SaleReportFilterDTO $filters): SaleReport
    {
        $report = Sale::query()
            ->when($filters->startPeriod, fn($query, $minDate) => $query->where('created_at', '>=', $minDate))
            ->when($filters->endPeriod, fn($query, $maxDate) => $query->where('created_at', '<=', $maxDate))
            ->when($filters->sellerId, fn($query, $sellerId) => $query->where('seller_id', $sellerId))
            ->get();

        return new SaleReport(
            startPeriod: new DateTime($filters->startPeriod),
            endPeriod: $filters->endPeriod ? new DateTime($filters->endPeriod) : null,
            totalSaleAmount: $report->sum('amount'),
            saleList: $report->map(fn($model) => SaleMapper::fromModelToEntity($model))->toArray(),
        );
    }
}
