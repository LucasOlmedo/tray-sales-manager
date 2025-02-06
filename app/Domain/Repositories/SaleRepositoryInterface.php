<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Sale;

interface SaleRepositoryInterface
{
    public function save(Sale $sale): Sale;
}
