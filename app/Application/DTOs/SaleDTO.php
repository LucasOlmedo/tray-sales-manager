<?php

namespace App\Application\DTOs;

class SaleDTO
{
    public function __construct(
        public int $sellerId,
        public float $amount
    ) {
    }
}
