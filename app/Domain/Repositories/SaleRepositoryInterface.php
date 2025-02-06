<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Sale;
use App\Application\DTOs\Filters\SaleFilterDTO;
use IteratorAggregate;

interface SaleRepositoryInterface
{
    /**
     * @return IteratorAggregate<int,Sale>
     */
    public function list(SaleFilterDTO $filters): IteratorAggregate;
    public function save(Sale $sale): Sale;
}
