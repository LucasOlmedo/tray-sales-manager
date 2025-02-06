<?php

namespace App\Application\UseCases\Sales;

use App\Application\DTOs\Filters\SaleFilterDTO;
use App\Domain\Entities\Sale;
use App\Domain\Repositories\SaleRepositoryInterface;
use IteratorAggregate;

class ListSalesUseCase
{
    public function __construct(private SaleRepositoryInterface $saleRepository)
    {
    }

    /**
     * @return IteratorAggregate<Sale>
     */
    public function execute(SaleFilterDTO $filters): IteratorAggregate
    {
        return $this->saleRepository->list($filters);
    }
}
