<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Связь с продуктами в заказе
     */
    public function orderProducts()
    {
        return $this->hasMany('App\Models\OrderProduct');
    }
}
