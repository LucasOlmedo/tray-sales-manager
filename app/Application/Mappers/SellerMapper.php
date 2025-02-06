<?php

namespace App\Application\Mappers;

use App\Application\DTOs\SellerDTO;
use App\Domain\Entities\Seller as SellerEntity;
use App\Domain\ValueObjects\Commission;
use App\Models\Seller as SellerModel;

class SellerMapper
{
    /**
     * @param array<mixed> $data
     */
    public static function fromArrayToDTO(array $data): SellerDTO
    {
        return new SellerDTO(
            name: $data['name'],
            email: $data['email'],
            commission: $data['commission'] ?? null,
        );
    }

    public static function fromDTOtoEntity(SellerDTO $sellerDTO): SellerEntity
    {
        return new SellerEntity(
            id: null,
            name: $sellerDTO->name,
            email: $sellerDTO->email,
            commission: new Commission($sellerDTO->commission),
        );
    }

    public static function fromEntityToModel(SellerEntity $seller): SellerModel
    {
        $sellerModel = SellerModel::findOrNew($seller->id);
        $sellerModel->name = $seller->name;
        $sellerModel->email = $seller->email;
        $sellerModel->commission_percentage = $seller->commission->value();
        return $sellerModel;
    }

    public static function fromModelToEntity(SellerModel $sellerModel): SellerEntity
    {
        return new SellerEntity(
            id: $sellerModel->id,
            name: $sellerModel->name,
            email: $sellerModel->email,
            commission: new Commission($sellerModel->commission_percentage),
        );
    }
}
