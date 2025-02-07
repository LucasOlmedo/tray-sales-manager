<?php

namespace Tests\Unit;

use App\Application\DTOs\SaleDTO;
use App\Application\Mappers\SaleMapper;
use App\Domain\Entities\Sale;
use App\Domain\Entities\Seller;
use App\Domain\ValueObjects\Commission;
use PHPUnit\Framework\TestCase;

class SaleMapperTest extends TestCase
{
    public function test_map_from_array_to_dto()
    {
        $arrayData = [
            'seller_id' => 1,
            'amount' => 100.00,
        ];
        $dtoMapped = SaleMapper::fromArrayToDTO($arrayData);
        $this->assertInstanceOf(SaleDTO::class, $dtoMapped);
    }

    public function test_map_from_dto_to_entity()
    {
        $seller = new Seller(
            id: 1,
            name: 'John Doe',
            email: 'Wl4wU@example.com',
            commission: new Commission(10.00),
        );

        $dto = new SaleDTO(
            sellerId: 1,
            amount: 100.00,
        );
        $entityMapped = SaleMapper::fromDTOtoEntity($seller, $dto);
        $this->assertInstanceOf(Sale::class, $entityMapped);
    }
}
