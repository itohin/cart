<?php

namespace App\Http\Controllers;

use App\Http\Basket\Basket;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function index()
    {
        $this->basket->refresh();

        if (!$this->basket->subTotal()) {
            return redirect()->route('cart.index');
        }

        return view('order.index');
    }

    public function store(OrderRequest $request)
    {
        $this->basket->refresh();

        if (!$this->basket->subTotal()) {
            return redirect()->route('cart.index');
        }

    }
}
