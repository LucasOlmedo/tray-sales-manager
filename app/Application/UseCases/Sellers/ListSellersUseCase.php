<?php

namespace App\Application\UseCases\Sellers;

use App\Application\DTOs\Filters\SellerFilterDTO;
use App\Domain\Entities\Seller;
use App\Domain\Repositories\SellerRepositoryInterface;
use IteratorAggregate;

class ListSellersUseCase
{
    public function __construct(private SellerRepositoryInterface $sellerRepository)
    {
    }

    /**
     * @return IteratorAggregate<Seller>
     */
    public function execute(SellerFilterDTO $filters): IteratorAggregate
    {
        return $this->sellerRepository->list($filters);
    }
}
