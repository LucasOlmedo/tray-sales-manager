<?php

namespace App\Infrastructure\Repositories;

use App\Application\DTOs\Filters\SellerFilterDTO;
use App\Application\Mappers\SellerMapper;
use App\Domain\Entities\Seller as SellerEntity;
use App\Domain\Repositories\SellerRepositoryInterface;
use App\Infrastructure\Exceptions\SaveSellerErrorException;
use App\Infrastructure\Exceptions\SellerNotFoundException;
use App\Models\Seller as SellerModel;
use Exception;
use Illuminate\Pagination\Paginator;
use IteratorAggregate;

class SellerRepository implements SellerRepositoryInterface
{
    /**
     * @return IteratorAggregate<int,SellerEntity>
     */
    public function list(SellerFilterDTO $filters): IteratorAggregate
    {
        /**
         * @var Paginator<int,SellerModel> $pagination
         */
        $pagination = SellerModel::query()
            ->when($filters->name, fn($query, $name) => $query->where('name', 'like', "%{$name}%"))
            ->when($filters->email, fn($query, $email) => $query->where('email', 'like', "%{$email}%"))
            ->paginate($filters->perPage, ['*'], 'page', $filters->page);

        $pagination->through(fn($model) => SellerMapper::fromModelToEntity($model));

        /**
         * @var IteratorAggregate<int,SellerEntity> $pagination
         */
        return $pagination;
    }

    public function save(SellerEntity $seller): SellerEntity
    {
        try {
            $model = SellerMapper::fromEntityToModel($seller);
            $model->save();
            return SellerMapper::fromModelToEntity($model);
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
