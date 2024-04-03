<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $fillable = [
        'promocode', 'value', 'valid_date'
    ];

    public function checkPromocode($promocode)
    {
        $dateNow = now();
        return $this->where('promocode', $promocode)->where('valid_date', '>', $dateNow)->get();
    }

    public function promocodeValue($promocode)
    {
        return Promocode::where('promocode', $promocode)->get('value');
    }

    public function getPromocodeId($promocode)
    {
        return Promocode::where('promocode', $promocode)->first();
    }
}
