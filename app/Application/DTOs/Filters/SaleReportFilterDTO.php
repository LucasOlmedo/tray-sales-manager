<?php

namespace App\Application\DTOs\Filters;

class SaleReportFilterDTO
{
    public function __construct(
        public string $startPeriod,
        public ?string $endPeriod,
        public ?int $sellerId,
    ) {}

    /**
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): self
    {
        /**
         * @var array $data{start_period: string}
         * @var array $data{end_period: string|null}
         * @var array $data{seller_id: int|null}
         *
         * @phpstan-ignore-next-line
         */
        return new self(
            startPeriod: isset($data['start_period']) ? date($data['start_period']) : now()->startOfDay()->format('Y-m-d H:i:s'),
            endPeriod: isset($data['end_period']) ? date($data['end_period']) : null,
            sellerId: $data['seller_id'] ?? null,
        );
    }
}
