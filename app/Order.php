<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'promocode_id',
        'subtotal_price',
        'total_price',
        'delivery_fees',
        'order_code'
    ];

    public function getOrders($user_id)
    {
        return $this->where('user_id', $user_id)->get();
    }
}
