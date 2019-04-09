<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        if (!$product) {
            abort(404);
        }
        return view('products.product', compact('product'));
    }
}
