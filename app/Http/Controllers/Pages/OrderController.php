<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Models\{Order, OrderProduct, Partner, Product};

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = (new OrderRepository())->getOrdersList();
        
        return view('/pages/orders/list',['orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $order->cost = 0;
        // продукты в заказе
        $products = $order->products;
        $prods = [];
        foreach($products as $product){
            $prods[$product->id] = $product;
        }
        // информация о продуктах в заказе
        $o_products = $order->orderProducts;
        foreach($o_products as $kp => $order_product){
            $o_products[$kp]->name = $prods[$order_product->product_id]->name;
            $order->cost += $order_product->quantity*$order_product->price;
        }
        
        $partners = Partner::all();
        $statuses = OrderRepository::ORDER_STATUSES;
        
        return view('/pages/orders/order_edit', compact('partners', 'order', 'o_products', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        // Русификацию ворнингов не делал, так как тестовое задание
        $this->validate($request, [
            'client_email' => 'required|email',
            'partner_id' => 'required|integer',
            'status' => 'required|integer|max:30'
        ]);
        
        $order = Order::find($id);
        $order->client_email = $request->input('client_email');
        $order->partner_id = $request->input('partner_id');
        $order->status = $request->input('status');
        
        $order->save();
        
        return redirect()->route('order_edit', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
