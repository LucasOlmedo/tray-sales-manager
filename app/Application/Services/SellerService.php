<?php

namespace App\Application\Services;

use App\Application\Mappers\SellerMapper;
use App\Application\UseCases\CreateSellerUseCase;
use App\Domain\Entities\Seller;

class SellerService
{
    public function __construct(private CreateSellerUseCase $createSellerUseCase)
    {
    }

    /**
     * @param array<mixed> $data
     */
    public function createSeller(array $data): Seller
    {
        $sellerDTO = SellerMapper::fromArrayToDTO($data);
        return $this->createSellerUseCase->execute($sellerDTO);
    }
}
