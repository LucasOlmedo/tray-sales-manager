<?php

namespace App\Application\UseCases;

use App\Application\DTOs\SellerDTO;
use App\Application\Mappers\SellerMapper;
use App\Domain\Entities\Seller;
use App\Domain\Repositories\SellerRepositoryInterface;

class CreateSellerUseCase
{
    public function __construct(private SellerRepositoryInterface $sellerRepository)
    {
    }

    public function execute(SellerDTO $sellerDTO): Seller
    {
        $sellerEntity = SellerMapper::fromDTOtoEntity($sellerDTO);
        return $this->sellerRepository->save($sellerEntity);
    }
}
