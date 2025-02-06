<?php

namespace App\Infrastructure\Repositories;

use App\Application\Mappers\SellerMapper;
use App\Domain\Entities\Seller as SellerEntity;
use App\Domain\Repositories\SellerRepositoryInterface;
use App\Infrastructure\Exceptions\SaveSellerErrorException;
use App\Infrastructure\Exceptions\SellerNotFoundException;
use App\Models\Seller as SellerModel;
use Exception;

class SellerRepository implements SellerRepositoryInterface
{
    public function save(SellerEntity $seller): SellerEntity
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

    public function find(int $id): SellerEntity
    {
        try {
            $model = SellerModel::findOrFail($id);
            return SellerMapper::fromModelToEntity($model);
        } catch (Exception $e) {
            throw new SellerNotFoundException(previous: $e);
        }
    }
}
