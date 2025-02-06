<?php

namespace App\Infrastructure\Repositories;

use App\Application\Mappers\SaleMapper;
use App\Domain\Entities\Sale;
use App\Domain\Repositories\SaleRepositoryInterface;
use App\Infrastructure\Exceptions\SaveSaleErrorException;
use Exception;

class SaleRepository implements SaleRepositoryInterface
{
    public function save(Sale $sale): Sale
    {
        try {
            $model = SaleMapper::fromEntityToModel($sale);
            $model->save();
            return $sale;
        } catch (Exception $e) {
            throw new SaveSaleErrorException(
                sale: $sale,
                detailedError: $e->getMessage()
            );
        }
    }
}
