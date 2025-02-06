<?php

namespace App\Application\UseCases\Sellers;

use App\Domain\Entities\Seller;
use App\Domain\Repositories\SellerRepositoryInterface;

class FindSellerUseCase
{
    public function __construct(private SellerRepositoryInterface $sellerRepository)
    {
    }

    public function execute(int $id): Seller
    {
        return $this->sellerRepository->find($id);
    }
}
