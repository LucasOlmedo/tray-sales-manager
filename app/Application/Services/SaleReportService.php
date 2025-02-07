<?php

namespace App\Application\Services;

use App\Application\DTOs\Filters\SaleReportFilterDTO;
use App\Application\UseCases\Reports\GenerateSaleReportUseCase;
use App\Domain\Entities\SaleReport;

class SaleReportService
{
    public function __construct(private GenerateSaleReportUseCase $generateSaleReportUseCase)
    {
    }

    public function generateReport(array $filters): SaleReport
    {
        $filtersDTO = SaleReportFilterDTO::fromArray($filters);
        return $this->generateSaleReportUseCase->execute($filtersDTO);
    }
}
