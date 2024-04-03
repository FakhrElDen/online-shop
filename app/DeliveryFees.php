<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryFees extends Model
{
    protected $fillable = [
        'city', 'price'
    ];

    public function getDeliveryFees($city)
    {
        return $this->where('city', $city)->first();
    }

    public function listDeliveryFees()
    {
        return $this->all();
    }
}
