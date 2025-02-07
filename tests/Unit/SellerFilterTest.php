<?php

namespace Tests\Unit;

use App\Application\DTOs\Filters\SellerFilterDTO;
use PHPUnit\Framework\TestCase;

class SellerFilterTest extends TestCase
{
    public function test_seller_filter_from_array()
    {
        $data = [
            'name' => 'John Doe',
            'email' => '6oFbP@example.com',
            'page' => 1,
            'per_page' => 10,
        ];

        $filter = SellerFilterDTO::fromArray($data);

        $this->assertInstanceOf(SellerFilterDTO::class, $filter);
        $this->assertEquals('John Doe', $filter->name);
        $this->assertEquals('6oFbP@example.com', $filter->email);
        $this->assertEquals(1, $filter->page);
        $this->assertEquals(10, $filter->perPage);
    }
}
