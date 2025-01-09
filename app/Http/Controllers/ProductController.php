<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function ProductDetails(Product $product)
    {
        return view('product-details', compact('product'));
    }
}
