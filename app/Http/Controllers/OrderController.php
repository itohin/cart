<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;
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

        $hash = bin2hex(random_bytes(32));

        $customer = Customer::firstOrCreate([
            'email' => $request->email,
            'name' => $request->name
        ]);

        $address = Address::firstOrCreate([
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'postal_code' => $request->postal_code
        ]);

        $order = $customer->orders()->create([
            'hash' => $hash,
            'paid' => false,
            'total' => $this->basket->subTotal() + 5,
            'address_id' => $address->id
        ]);

        $order->products()->saveMany(
            $this->basket->all(),
            $this->getQuantities($this->basket->all())
        );
    }

    protected function getQuantities($items)
    {
        $quantities = [];

        foreach ($items as $item) {
            $quantities[] = ['quantity' => $item->quantity];
        }

        return $quantities;
    }
}
