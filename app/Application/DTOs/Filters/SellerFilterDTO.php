<?php

namespace App\Application\DTOs\Filters;

class SellerFilterDTO
{
    public function __construct(
        public ?string $name,
        public ?string $email,
        public int $page,
        public int $perPage,
    ) {
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            page: $data['page'] ?? 1,
            perPage: $data['per_page'] ?? 10,
        );
    }
}
