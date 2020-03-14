<?php

namespace App\Repositories;


class OrderRepository
{
    
    public const ORDER_STATUSES = array(
        0 => 'новый',
        10 => 'подтвержден',
        20 => 'завершен'
    );
    
    /**
     * Получить список всех заказов с информацией по партнеру, товарам и стоимости
     * @return array
     */
    public function getOrdersList()
    {
        $query = "SELECT o.*, op.price, op.quantity, p.name as product, p.id as product_id, part.name as partner "
                . "FROM orders o LEFT JOIN order_products op ON o.id = op.order_id "
                . "LEFT JOIN products p ON op.product_id = p.id LEFT JOIN partners part ON o.partner_id = part.id ";
        $res = \DB::select($query);
        
        return $this->combineOrdersList($res);
    }
    
    /**
     * Разбирает результат выборки заказов на удобоваримые данные
     * @param array $res
     * @return array
     */
    private function combineOrdersList($res)
    {
        $orders = [];
        if (is_array($res) && !empty($res)){
            foreach($res as $r){
                if(!isset($orders[$r->id])){
                    $orders[$r->id] = array(
                        'status_id' => $r->status,
                        'status' => self::ORDER_STATUSES[$r->status],
                        'partner_id' => $r->partner_id,
                        'partner' => $r->partner,
                        'client_email' => $r->client_email,
                        'delivery_dt' => $r->delivery_dt,
                        'created_at' => $r->created_at,
                        'products' => array(
                            0 => array(
                                'id' => $r->product_id,
                                'name' => $r->product,
                                'price' => $r->price,
                                'quantity' => $r->quantity
                            )
                        ),
                        'cost' => $r->price*$r->quantity
                    );
                }else {
                    $orders[$r->id]['cost'] += $r->price*$r->quantity;
                    $orders[$r->id]['products'][]= array(
                                'id' => $r->product_id,
                                'name' => $r->product,
                                'price' => $r->price,
                                'quantity' => $r->quantity
                            );
                }
            }
        }
        
        return $orders;
    }
}