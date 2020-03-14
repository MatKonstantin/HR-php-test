<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    /**
     * Получить описание продукта в заказе
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    
    /**
     * Связь с заказом
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
