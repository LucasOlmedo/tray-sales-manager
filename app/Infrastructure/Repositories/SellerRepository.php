<?php

namespace App\Infrastructure\Repositories;

use App\Application\Mappers\SellerMapper;
use App\Domain\Entities\Seller;
use App\Domain\Repositories\SellerRepositoryInterface;
use App\Infrastructure\Exceptions\SaveSellerErrorException;
use Exception;

class SellerRepository implements SellerRepositoryInterface
{
    public function save(Seller $seller): Seller
    {
        try {
            $model = SellerMapper::fromEntityToModel($seller);
            $model->save();
            return $seller;
        } catch (Exception $e) {
            throw new SaveSellerErrorException(
                seller: $seller,
                detailedError: $e->getMessage()
            );
        }
    }
}
