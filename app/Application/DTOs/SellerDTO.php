<?php

namespace App\Application\DTOs;

class SellerDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public ?float $commission,
    ) {
    }
}
