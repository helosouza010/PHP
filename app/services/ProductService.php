<?php

namespace App\Services;
use App\Models\Product;

class ProductService
{
    public function storeProduct($data)
    {
        return Product::create($data);
    }
}