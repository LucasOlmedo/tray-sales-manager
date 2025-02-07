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
        /**
         * @var int|null $data['seller_id']
         * @var string|null $data['min_date']
         * @var string|null $data['max_date']
         * @var int $data['page']
         * @var int $data['per_page']
         *
         * @phpstan-ignore-next-line
         */
        return new self(
            sellerId: $data['seller_id'] ?? null,
            minDate: $data['min_date'] ?? null,
            maxDate: $data['max_date'] ?? null,
            page: $data['page'] ?? 1,
            perPage: $data['per_page'] ?? 10,
        );
    }
}
