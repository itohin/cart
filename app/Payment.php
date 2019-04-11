<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'failed',
        'tansaction_id'
    ];
}
