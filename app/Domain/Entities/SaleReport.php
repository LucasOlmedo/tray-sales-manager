<?php

namespace App\Domain\Entities;

use DateTime;

class SaleReport
{
    /**
     * @param DateTime $startPeriod
     * @param DateTime|null $endPeriod
     * @param float $totalSaleAmount
     * @param array<int,Sale> $saleList
     */
    public function __construct(
        public DateTime $startPeriod,
        public ?DateTime $endPeriod,
        public float $totalSaleAmount,
        public array $saleList,
    ) {}

    public function getTotalCommissionAmount(): float
    {
        return array_reduce(
            $this->saleList,
            fn(float $amount, Sale $sale) => $amount + $sale->getSellerAmount(),
            0.0
        );
    }
}
