<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;

class ProductsExport implements FromArray
{

    public function array(): array
    {
        $list = [];
        $products = Product::all();
        foreach ($products as $product) {
            $list[] = [
                "title"=> $product->title,
                "description"=> $product->description,
                "userName"=> $product->user->name,
            ];
        }
        return $list;    
        
    }
}
