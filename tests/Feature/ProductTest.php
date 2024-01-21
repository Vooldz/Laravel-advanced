<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    protected $productService;
    protected $product;

    public function setUp(): void {
        parent::setUp();
        $this->productService = $this->app->make('App\Services\ProductService');
        $this->product=[
            'title' => 'Test', 
            'description'=> 'Test Just To Try Our Unit Test (: <3',
            'color' => 'red',
            'size' => '50',
            'price' => '99',
            'user_id' => 1,
        ];
    }
    /**
     * A basic feature test example.
     */
    public function test_create_product_without_data(): void
    {
        $response = $this->post('/api/v1/products');

        $response->assertStatus(500);
    }
    public function test_create_product_without_authentication(): void
    {
        $response = $this->withHeaders(['Accept'=>'application/json'])->post('/api/v1/products', $this->product);

        $response->assertStatus(401);
    }
    public function test_create_product_with_auth()
    {
        $user = User::first();
        $response = $this->withHeaders(['Accept'=>'application/json'])
        ->actingAs($user)
        ->post('/api/v1/products');

        $response->assertStatus(422);
    }
    public function test_create_product_with_auth_success()
    {
        $user = User::where('is_admin' , '1')->first();
        $response = $this->withHeaders(['Accept'=>'application/json'])
        ->actingAs($user)
        ->post('/api/v1/products', $this->product);
        $response->assertStatus(200);
    }
}
