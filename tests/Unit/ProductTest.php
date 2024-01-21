<?php

namespace Tests\Unit;

use Tests\TestCase;

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
     * A basic unit test example.
     */

    public function test_product_create_database(): void
    {
        $createdProduct = $this->productService->createProduct($this->product);
        $this->assertDatabaseHas('products', [
            'title' => 'Test',
        ]);
        $this->assertDatabaseHas('product_details', [
            'size' => 50,
        ]);
    }

    public function test_delete_product_database()
    {
        $this->productService->deleteProduct(['id'=> 1]);
        $this->assertDatabaseMissing('products', ['id'  => 1]);
    }
}
