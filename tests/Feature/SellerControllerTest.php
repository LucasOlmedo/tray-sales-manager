<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellerControllerTest extends TestCase
{
    use RefreshDatabase;

    private const DEFAULT_COMMISSION = 8.5;

    public function test_index_returns_sellers_list()
    {
        $response = $this->get('/api/sellers');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'email',
                        'commission',
                    ],
                ],
            ]);
    }

    public function test_index_returns_sellers_list_with_filters()
    {
        $filters = [
            'name' => 'Test',
            'email' => 'test@example.com',
        ];

        $response = $this->get('/api/sellers?' . http_build_query($filters));
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'email',
                        'commission',
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

    public function test_create_new_seller()
    {
        $data = [
            'name' => 'Test',
            'email' => 'test@example.com',
            'commission' => 10.00,
        ];

        $response = $this->post('/api/sellers', $data);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'commission',
                ],
            ]);
    }


    public function test_create_new_seller_with_default_commission()
    {
        $data = [
            'name' => 'Test',
            'email' => 'test@example.com'
        ];

        $response = $this->post('/api/sellers', $data);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'commission',
                ],
            ]);

        $response->assertJson([
            'data' => [
                'commission' => self::DEFAULT_COMMISSION,
            ],
        ]);
    }

    public function test_create_new_seller_with_invalid_data()
    {
        $data = [
            'name' => 'Test',
            'email' => 'test.example.com'
        ];

        $response = $this->post('/api/sellers', $data);
        $response->assertStatus(302);
    }
}
