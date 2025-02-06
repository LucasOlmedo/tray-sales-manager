<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Seller;

interface SellerRepositoryInterface
{
    public function save(Seller $seller): Seller;
}
