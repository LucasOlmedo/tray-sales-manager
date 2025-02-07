<?php

namespace App\Domain\Repositories;

use App\Application\DTOs\Filters\SaleReportFilterDTO;
use App\Domain\Entities\SaleReport;

interface SaleReportRepositoryInterface
{
    public function getReport(SaleReportFilterDTO $filters): SaleReport;
}
