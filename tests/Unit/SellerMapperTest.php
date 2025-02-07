<?php

namespace Tests\Unit;

use App\Application\DTOs\SellerDTO;
use App\Application\Mappers\SellerMapper;
use App\Domain\Entities\Seller as SellerEntity;
use PHPUnit\Framework\TestCase;

class SellerMapperTest extends TestCase
{
    public function test_map_from_array_to_dto()
    {
        $arrayData = [
            'name' => 'John Doe',
            'email' => 'Wl4wU@example.com',
            'commission' => 10.00,
        ];
        $dtoMapped = SellerMapper::fromArrayToDTO($arrayData);
        $this->assertInstanceOf(SellerDTO::class, $dtoMapped);
    }

    public function test_map_from_dto_to_entity()
    {
        $dto = new SellerDTO(
            name: 'John Doe',
            email: 'Wl4wU@example.com',
            commission: 10.00,
        );
        $entityMapped = SellerMapper::fromDTOtoEntity($dto);
        $this->assertInstanceOf(SellerEntity::class, $entityMapped);
    }
}
