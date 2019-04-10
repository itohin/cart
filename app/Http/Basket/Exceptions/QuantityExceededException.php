<?php

namespace App\Http\Basket\Exceptions;

use Exception

class QuantityExceededException extends Exception
{
    protected $message = 'Maximum stock for this item.';
}