<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Commission;

class Sale
{
    public function __construct(
        public ?int $id,
        public Seller $seller,
        public float $amount,
        public string $date,
        public Commission $appliedCommission
    ) {
    }

    public function getSellerAmount(): float
    {
        return $this->amount * $this->appliedCommission->value() / 100;
    }
}
