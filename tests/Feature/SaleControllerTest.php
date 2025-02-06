<?php

namespace Tests\Feature;

use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_sales_list()
    {
        $this->mockSaleModel();

        $response = $this->get('/api/sales');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'email',
                        'applied_commission',
                        'amount',
                        'seller_amount',
                        'date',
                    ],
                ],
            ]);
    }

    public function test_index_returns_sales_list_with_filters()
    {
        $filters = [
            'seller_id' => 1,
            'min_date' => '2020-01-01',
            'max_date' => '2020-12-31',
        ];

        $this->mockSaleModel();

        $response = $this->get('/api/sales?' . http_build_query($filters));
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'email',
                        'applied_commission',
                        'amount',
                        'seller_amount',
                        'date',
                    ],
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'links' => [
                        '*' => [
                            'url',
                            'label',
                            'active',
                        ],
                    ],
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ]);
    }

    public function test_create_new_sale()
    {
        $seller = $this->mockSellerModel();
        $data = [
            'seller_id' => $seller->id,
            'amount' => 100.00,
        ];

        $response = $this->post('/api/sales', $data);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'applied_commission',
                    'amount',
                    'seller_amount',
                    'date',
                ],
            ]);
    }

    public function test_create_new_sale_with_invalid_data()
    {
        $seller = $this->mockSellerModel();
        $data = [
            'seller_id' => $seller->id,
            'amount' => 'invalid',
        ];

        $response = $this->post('/api/sales', $data);
        $response->assertStatus(302);
    }

    public function mockSaleModel()
    {
        $seller = $this->mockSellerModel();
        $sale = Sale::create([
            'seller_id' => $seller->id,
            'amount' => 100.00,
            'date' => now(),
            'applied_commission' => $seller->commission_percentage,
        ]);

        return $sale;
    }

    private function mockSellerModel()
    {
        return Seller::create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'commission_percentage' => 10.00,
        ]);
    }
}
