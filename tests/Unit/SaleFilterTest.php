<?php

namespace Tests\Unit;

use App\Application\DTOs\Filters\SaleFilterDTO;
use PHPUnit\Framework\TestCase;

class SaleFilterTest extends TestCase
{
    public function test_sale_filter_from_array()
    {
        $data = [
            'seller_id' => 1,
            'min_date' => '2023-01-01',
            'max_date' => '2023-12-31',
            'page' => 1,
            'per_page' => 10,
        ];

        $filter = SaleFilterDTO::fromArray($data);

        $this->assertInstanceOf(SaleFilterDTO::class, $filter);
        $this->assertEquals(1, $filter->sellerId);
        $this->assertEquals('2023-01-01', $filter->minDate);
        $this->assertEquals('2023-12-31', $filter->maxDate);
        $this->assertEquals(1, $filter->page);
        $this->assertEquals(10, $filter->perPage);
    }
}
