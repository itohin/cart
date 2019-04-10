<?php

namespace App\Http\Controllers;

use App\Http\Basket\Basket;
use App\Http\Basket\Exceptions\QuantityExceededException;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function index()
    {

        //dd($this->basket->all());
        return view('cart.index');
    }

    public function add($slug, $quantity)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return redirect()->route('home');
        }

        try {
            $this->basket->add($product, $quantity);
        } catch (QuantityExceededException $e) {

        }

        return redirect()->route('cart.index');
    }
}
