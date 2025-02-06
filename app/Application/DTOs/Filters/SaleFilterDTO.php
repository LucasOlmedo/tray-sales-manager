<?php

namespace App\Application\DTOs\Filters;

class SaleFilterDTO
{
    public function __construct(
        public ?int $sellerId,
        public ?string $minDate,
        public ?string $maxDate,
        public int $page,
        public int $perPage,
    ) {
    }

    /**
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            sellerId: $data['seller_id'] ?? null,
            minDate: $data['min_date'] ?? null,
            maxDate: $data['max_date'] ?? null,
            page: $data['page'] ?? 1,
            perPage: $data['per_page'] ?? 10,
        );
    }
}
