<?php

namespace App\Application\UseCases\Reports;

use App\Application\DTOs\Filters\SaleReportFilterDTO;
use App\Domain\Entities\SaleReport;
use App\Domain\Repositories\SaleReportRepositoryInterface;

class GenerateSaleReportUseCase
{
    public function __construct(private SaleReportRepositoryInterface $saleReportRepository)
    {
    }

    public function execute(SaleReportFilterDTO $filters): SaleReport
    {
        return $this->saleReportRepository->getReport($filters);
    }
}
