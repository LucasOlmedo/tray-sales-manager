<?php

namespace App\Application\Services;

use App\Application\Mappers\SellerMapper;
use App\Application\UseCases\Sellers\CreateSellerUseCase;
use App\Application\UseCases\Sellers\FindSellerUseCase;
use App\Domain\Entities\Seller;

class SellerService
{
    public function __construct(
        private CreateSellerUseCase $createSellerUseCase,
        private FindSellerUseCase $findSellerUseCase
    ) {
    }

    /**
     * @param array<mixed> $data
     */
    public function createSeller(array $data): Seller
    {
        $sellerDTO = SellerMapper::fromArrayToDTO($data);
        return $this->createSellerUseCase->execute($sellerDTO);
    }

    public function findSeller(int $id): ?Seller
    {
        return $this->findSellerUseCase->execute($id);
    }
}
