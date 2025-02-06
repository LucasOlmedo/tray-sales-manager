<?php

namespace App\Domain\Repositories;

use App\Application\DTOs\Filters\SellerFilterDTO;
use App\Domain\Entities\Seller;
use IteratorAggregate;

interface SellerRepositoryInterface
{
    /**
     * @return IteratorAggregate<Seller>
     */
    public function list(SellerFilterDTO $filters): IteratorAggregate;
    public function save(Seller $seller): Seller;
    public function find(int $id): Seller;
}
