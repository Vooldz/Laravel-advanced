<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductService
{

    public function getProducts()
    {
        $products = Product::with('detail');
        return $products;
    }

    public function createProduct(Request $request)
    {
        $validated = $request->validated();

        $product = Product::create($validated);

        $product->detail()->create($validated);

        return $product->load('detail');
    }

    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validated();

        $product->user_id = $validated['user_id'];
        $product->title = $validated['title'];
        $product->description = $validated['description'];
        $product->detail->size = $validated['size'];
        $product->detail->color = $validated['color'];
        $product->detail->price = $validated['price'];

        $product->detail->save();

        return $product->load('detail');
    }

    public function getProduct(Product $product)
    {
        return $product->load('detail');
    }

    public function deleteProduct(Product $product)
    {
        optional($product->detail)->delete();
        optional($product->image)->delete();
        $product->reviews()->delete();
        $product->delete();
    }
}
