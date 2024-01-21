<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Events\newProductMail;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\Event;


class ProductService
{

    public function getProducts()
    {
        $products = Product::with('detail')->get();
        return $products;
    }

    public function createProduct($request)
    {
        
        if (!is_array($request)){
            $validated = $request->validated();
        }else{
            $validated = $request;
        }
        $product = Product::create($validated);

        $product->detail()->create($validated);

        // Event::dispatch(new newProductMail($product));

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

    public function deleteProduct($product)
    {
        if (!is_array($product)){
            optional($product->detail)->delete();
            optional($product->image)->delete();
            $product->reviews()->delete();
            $product->delete();
            return;
        }
        Product::where('id', $product['id'])->delete();
    }
}
