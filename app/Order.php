<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'hash',
        'total',
        'paid',
        'address_id',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders_products')->withPivot('quantity');
    }
}
