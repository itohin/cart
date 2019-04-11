<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;
use App\Events\OrderWasCreated;
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

    public function show($hash)
    {
        return view('order.show');
    }

    public function store(OrderRequest $request)
    {
        $this->basket->refresh();

        if (!$this->basket->subTotal()) {
            return redirect()->route('cart.index');
        }

        if (!$request->payment_method_nonce) {
            return redirect()->route('order.index');
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

        $result = \Braintree_Transaction::sale([
            'amount' => $this->basket->subTotal() + 5,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if (!$result->success) {
            $order->payment()->create([
                'failed' => true
            ]);
            return redirect()->route('order.index');
        }

        event(new OrderWasCreated($order, $this->basket, $result->transaction->id));
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
