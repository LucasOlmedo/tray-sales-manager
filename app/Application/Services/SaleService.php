<?php

namespace App\Application\Services;

use App\Application\Mappers\SaleMapper;
use App\Application\UseCases\Sales\CreateSaleUseCase;
use App\Application\UseCases\Sellers\FindSellerUseCase;
use App\Domain\Entities\Sale;

class SaleService
{
    public function __construct(
        private CreateSaleUseCase $createSaleUseCase,
        private FindSellerUseCase $findSellerUseCase
    ) {
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
