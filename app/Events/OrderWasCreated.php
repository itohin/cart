<?php

namespace App\Events;

use App\Http\Basket\Basket;
use App\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    public $basket;

    public $transactionId;


    public function __construct(Order $order, Basket $basket, $transactionId)
    {
        $this->order = $order;
        $this->basket = $basket;
        $this->transactionId = $transactionId;
    }

}
