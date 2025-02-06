<?php

namespace App\Domain\ValueObjects;

final class Commission
{
    private const DEFAULT_VALUE = 8.5;

    public function __construct(
        private ?float $value = null,
    ) {
    }

    public function value(): float
    {
        return $this->value ?? self::DEFAULT_VALUE;
    }
}
