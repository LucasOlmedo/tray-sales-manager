<?php

namespace App\Domain\ValueObjects;

class Commission
{
    private const DEFAULT_VALUE = 8.5;

    public function __construct(
        private ?float $value = self::DEFAULT_VALUE,
    ) {}

    public function value(): float
    {
        return $this->value;
    }
}
