<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Commission;

class Seller
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $email,
        public Commission $commission,
    ) {}
}
