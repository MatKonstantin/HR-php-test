@extends('layout.master')
@section('body')
<h1>Список заказов</h1>
<table class="table table-bordered table-responsive table-hover">
    <thead
        <th>
            <td class="text-center">id</td>
            <td class="text-center">Партнер</td>
            <td class="text-center">Стоимость</td>
            <td class="text-center">Состав</td>
            <td class="text-center">Статус</td>
        </th>
    </thead>
    @if(isset($orders) && !empty($orders))
    <tbody>
        @foreach($orders as $id => $order)
        <tr>
          <td class="text-center"><a href="{{route('order_edit',['order_id'=>$id])}}">{{$id}}</a></td>
            <td>{{$order['partner']}}</td>
            <td class="text-right">{{$order['cost']}}</td>
            <td>@foreach($order['products'] as $kp => $product) @if($kp!==0) <br> @endif {{$product['name']}} - {{$product['quantity']}} шт. @endforeach</td>
            <td class="text-center">{{$order['status']}}</td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>

@endsection