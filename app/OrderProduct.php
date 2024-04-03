<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'user_id', 
        'product_id', 
        'order_id', 
        'price', 
        'quantity'
    ];

    public function createOrderProduct($arrProduct, $user_id, $order_id)
    {
        $arrProductOrder = array();
        
        foreach ($arrProduct as $key) {
            $price = $key['price'] * $key['quantity'];
            $arrProductOrder[] = $this->create([
                'user_id'       => $user_id,
                'order_id'      => $order_id,
                'product_id'    => $key['id'],
                'price'         => $price,
                'quantity'      => $key['quantity'],
            ]);
        }

        return $arrProductOrder;
    }
}
