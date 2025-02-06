<?php

namespace Tests\Unit;

use App\Domain\Entities\Sale;
use App\Domain\Entities\Seller;
use App\Domain\ValueObjects\Commission;
use PHPUnit\Framework\TestCase;

class SaleEntityTest extends TestCase
{
    public function test_sale_create_instance()
    {
        $mockData = $this->saleMockData();
        $mockSeller = $this->sellerMockData();

        $sale = new Sale(
            id: $mockData['id'],
            seller: $mockSeller,
            amount: $mockData['amount'],
            date: date('Y-m-d H:i:s'),
            appliedCommission: $mockSeller->commission,
        );

        $this->assertInstanceOf(Sale::class, $sale);
        $this->assertEquals($mockSeller->id, $sale->seller->id);
        $this->assertEquals($mockSeller->commission->value(), $sale->appliedCommission->value());
    }

    public function test_sale_get_seller_amount()
    {
        $mockData = $this->saleMockData();
        $mockSeller = $this->sellerMockData();

        $sale = new Sale(
            id: $mockData['id'],
            seller: $mockSeller,
            amount: $mockData['amount'],
            date: date('Y-m-d H:i:s'),
            appliedCommission: $mockSeller->commission,
        );

        $mockSellerValue = ($mockData['amount'] * $mockSeller->commission->value()) / 100;
        $this->assertEquals($mockSellerValue, $sale->getSellerAmount());
    }

    private function saleMockData()
    {
        return [
            'id' => 1,
            'amount' => 100,
        ];
    }

    private function sellerMockData()
    {
        return new Seller(
            id: 1,
            name: 'John Doe',
            email: 'Wl4wU@example.com',
            commission: new Commission(),
        );
    }
}
