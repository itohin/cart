<?php

namespace App\Http\Basket;


use App\Http\Basket\Exceptions\QuantityExceededException;
use App\Product;

class Basket
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function add(Product $product, $quantity)
    {
        if ($this->has($product)) {
            $quantity = $this->get($product)['quantity'] + $quantity;
        }

        $this->update($product, $quantity);
    }

    public function update(Product $product, $quantity)
    {
        if (!$this->product->find($product->id)->hasStock($quantity)) {
            throw new QuantityExceededException();
        }

        if ($quantity === 0) {
            $this->remove($product);
            return;
        }

        session()->put("cart.{$product->id}", [
            'product_id' => (int) $product->id,
            'quantity' => (int) $quantity
        ]);
    }

    public function remove(Product $product)
    {
        session()->forget("cart.{$product->id}");
    }

    public function has(Product $product)
    {
        return session()->has("cart.{$product->id}");
    }

    public function get(Product $product)
    {
        return session("cart.{$product->id}");
    }

    public function clear()
    {
        session()->forget('cart');
    }

    public function all()
    {
        $ids = array_map(function ($item) {
            return $item['product_id'];
        }, session('cart'));

        $products = $this->product->find($ids);

        $items = $products->map(function ($product) {
            $product->quantity = $this->get($product)['quantity'];
            return $product;
        });

        return $items;
    }

    public function itemsCount()
    {
        if (!session()->has('cart')) {
            return 0;
        }

        return count(session('cart'));
    }

    public function refresh()
    {
        foreach ($this->all() as $item)
        {
            if (!$item->hasStock($item->quantity)) {
                $this->update($item, $item->stock);
            }
        }
    }

    public function subTotal()
    {
        $total = $this->all()->reduce(function ($carry, $item) {
            if (!$item->outOfStock()) {
                $carry = $carry + $item->price * $item->quantity;
            }
            return $carry;
        }, 0);

        return $total;
    }
}