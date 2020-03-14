<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    
    /**
     * Получить все продукты в заказе
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product','order_products');
    }
    
    /**
     * Получить информацию по продуктам в заказе
     */
    public function orderProducts()
    {
        return $this->hasMany('App\Models\OrderProduct');
    }
    
}
