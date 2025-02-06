<?php

namespace App\Application\UseCases\Sales;

use App\Application\DTOs\SaleDTO;
use App\Application\Mappers\SaleMapper;
use App\Domain\Entities\Sale;
use App\Domain\Entities\Seller;
use App\Domain\Repositories\SaleRepositoryInterface;

class CreateSaleUseCase
{
    public function __construct(private SaleRepositoryInterface $saleRepository)
    {
    }

    public function execute(Seller $seller, SaleDTO $saleDTO): Sale
    {
        $saleEntity = SaleMapper::fromDTOtoEntity($seller, $saleDTO);
        return $this->saleRepository->save($saleEntity);
    }
}
