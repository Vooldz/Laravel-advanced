<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\Api\V1\StoreProductRequest;
use App\Http\Requests\Api\V1\UpdateProductRequest;

class ProductController extends BaseController
{

    public $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->productService->getProducts();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $response = $this->productService->createProduct($request);
        return $this->successResponse($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return $this->productService->getProduct($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, product $product)
    {
        $response = $this->productService->updateProduct($request,$product);
        return $this->successResponse($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $this->productService->deleteProduct($product);
        
        return $this->successResponse('Product Deleted Successfully!');
    }
}
