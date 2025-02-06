<?php

namespace App\Infrastructure\Repositories;

use App\Application\DTOs\Filters\SaleFilterDTO;
use App\Application\Mappers\SaleMapper;
use App\Domain\Entities\Sale as SaleEntity;
use App\Domain\Repositories\SaleRepositoryInterface;
use App\Infrastructure\Exceptions\SaveSaleErrorException;
use App\Models\Sale as SaleModel;
use Exception;
use Illuminate\Pagination\Paginator;
use IteratorAggregate;

class SaleRepository implements SaleRepositoryInterface
{
    /**
     * @return IteratorAggregate<int,SaleEntity>
     */
    public function list(SaleFilterDTO $filters): IteratorAggregate
    {
        /**
         * @var Paginator<int,SaleModel> $pagination
         */
        $pagination = SaleModel::query()
            ->when($filters->sellerId, fn($query, $sellerId) => $query->where('seller_id', $sellerId))
            ->when($filters->minDate, fn($query, $minDate) => $query->where('created_at', '>=', $minDate))
            ->when($filters->maxDate, fn($query, $maxDate) => $query->where('created_at', '<=', $maxDate))
            ->paginate($filters->perPage, ['*'], 'page', $filters->page);

        $pagination->through(fn($model) => SaleMapper::fromModelToEntity($model));

        /**
         * @var IteratorAggregate<int,SaleEntity> $pagination
         */
        return $pagination;
    }

    public function save(SaleEntity $sale): SaleEntity
    {
        try {
            $model = SaleMapper::fromEntityToModel($sale);
            $model->save();
            return SaleMapper::fromModelToEntity($model);
        } catch (Exception $e) {
            throw new SaveSaleErrorException(
                sale: $sale,
                detailedError: $e->getMessage()
            );
        }
    }
}
