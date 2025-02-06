<?php

namespace App\Http\Resources;

use App\Domain\Entities\Seller;
use App\Domain\ValueObjects\Commission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method getSellerAmount()
 *
 * @property int $id
 * @property Seller $seller
 * @property string $name
 * @property string $email
 * @property Commission $appliedCommission
 * @property float $amount
 * @property string $date
 */
class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->seller->name,
            'email' => $this->seller->email,
            'applied_commission' => $this->appliedCommission->value(),
            'amount' => $this->amount,
            'seller_amount' => $this->getSellerAmount(),
            'date' => $this->date,
        ];
    }
}
