<?php

namespace App\Application\Services;

use App\Application\DTOs\Filters\SellerFilterDTO;
use App\Application\Mappers\SellerMapper;
use App\Application\UseCases\Sellers\CreateSellerUseCase;
use App\Application\UseCases\Sellers\FindSellerUseCase;
use App\Application\UseCases\Sellers\ListSellersUseCase;
use App\Domain\Entities\Seller;
use IteratorAggregate;

class SellerService
{
    public function __construct(
        private ListSellersUseCase $listSellersUseCase,
        private CreateSellerUseCase $createSellerUseCase,
        private FindSellerUseCase $findSellerUseCase
    ) {
    }

    /**
     * @param array<mixed> $filters
     * @return IteratorAggregate<Seller>
     */
    public function listSellers(array $filters): IteratorAggregate
    {
        $filterDTO = SellerFilterDTO::fromArray($filters);
        return $this->listSellersUseCase->execute($filterDTO);
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
