<?php

namespace App\Application\Services;

use App\Application\DTOs\Filters\SaleFilterDTO;
use App\Application\Mappers\SaleMapper;
use App\Application\UseCases\Sales\CreateSaleUseCase;
use App\Application\UseCases\Sales\ListSalesUseCase;
use App\Application\UseCases\Sellers\FindSellerUseCase;
use App\Domain\Entities\Sale;
use IteratorAggregate;

class SaleService
{
    public function __construct(
        private ListSalesUseCase $listSalesUseCase,
        private CreateSaleUseCase $createSaleUseCase,
        private FindSellerUseCase $findSellerUseCase
    ) {
    }

    /**
     * @param array<mixed> $filters
     * @return IteratorAggregate<Sale>
     */
    public function listSales(array $filters): IteratorAggregate
    {
        $filterDTO = SaleFilterDTO::fromArray($filters);
        return $this->listSalesUseCase->execute($filterDTO);
    }

    /**
     * @param array<mixed> $data
     */
    public function createSale(array $data): Sale
    {
        $saleDTO = SaleMapper::fromArrayToDTO($data);
        $seller = $this->findSellerUseCase->execute($saleDTO->sellerId);
        return $this->createSaleUseCase->execute($seller, $saleDTO);
    }
}
