<?php

namespace App\Application\Mappers;

use App\Application\DTOs\SaleDTO;
use App\Domain\Entities\Sale as SaleEntity;
use App\Domain\Entities\Seller;
use App\Domain\ValueObjects\Commission;
use App\Models\Sale as SaleModel;

class SaleMapper
{
    /**
     * @param array<mixed> $data
     */
    public static function fromArrayToDTO(array $data): SaleDTO
    {
        return new SaleDTO(
            sellerId: $data['seller_id'],
            amount: $data['amount'],
        );
    }

    public static function fromDTOtoEntity(Seller $seller, SaleDTO $saleDTO): SaleEntity
    {
        return new SaleEntity(
            id: null,
            seller: $seller,
            amount: $saleDTO->amount,
            date: date('Y-m-d H:i:s'),
            appliedCommission: new Commission($seller->commission->value()),
        );
    }

    public static function fromEntityToModel(SaleEntity $sale): SaleModel
    {
        $saleModel = SaleModel::findOrNew($sale->id);
        $saleModel->seller_id = $sale->seller->id;
        $saleModel->amount = $sale->amount;
        $saleModel->date = $sale->date;
        $saleModel->applied_commission = $sale->appliedCommission->value();
        return $saleModel;
    }

    public static function fromModelToEntity(SaleModel $saleModel): SaleEntity
    {
        return new SaleEntity(
            id: $saleModel->id,
            seller: SellerMapper::fromModelToEntity($saleModel->seller),
            amount: $saleModel->amount,
            date: $saleModel->date,
            appliedCommission: new Commission($saleModel->applied_commission),
        );
    }
}
