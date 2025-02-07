<?php

namespace Tests\Unit;

use App\Domain\Entities\Seller;
use App\Domain\ValueObjects\Commission;
use PHPUnit\Framework\TestCase;

class SellerEntityTest extends TestCase
{
    private const DEFAULT_COMMISSION = 8.5;

    public function test_seller_create_instance()
    {
        $mockData = $this->sellerMockData();

        $seller = new Seller(
            id: $mockData['id'],
            name: $mockData['name'],
            email: $mockData['email'],
            commission: new Commission(value: $mockData['commission']),
        );

        $this->assertInstanceOf(Seller::class, $seller);

        $this->assertEquals($mockData['id'], $seller->id);
        $this->assertEquals($mockData['name'], $seller->name);
        $this->assertEquals($mockData['email'], $seller->email);
        $this->assertEquals($mockData['commission'], $seller->commission->value());
    }

    public function test_seller_default_commission()
    {
        $seller = new Seller(
            id: 1,
            name: 'John Doe',
            email: 'Wl4wU@example.com',
            commission: new Commission(),
        );

        $this->assertInstanceOf(Seller::class, $seller);
        $this->assertInstanceOf(Commission::class, $seller->commission);
        $this->assertEquals(self::DEFAULT_COMMISSION, $seller->commission->value());
    }

    private function sellerMockData()
    {
        return [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'Wl4wU@example.com',
            'commission' => 10,
        ];
    }
}
