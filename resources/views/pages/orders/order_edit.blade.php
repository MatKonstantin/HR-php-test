@extends('layout.master')
@section('body')
<h1>Редактирование заказа №{{$order->id}}</h1>

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form class="form-horizontal" method="POST" action="{{route('order_update',['id'=>$order->id])}}">
  <div class="form-group">
    <label for="client_email" class="col-sm-2 control-label">Электронная почта</label>
    <div class="col-sm-10">
      <input type="email" name="client_email" class="form-control" id="client_email" placeholder="xxx@xxx.xx" required value="{{$order->client_email}}">
    </div>
  </div>
  <div class="form-group">
    <label for="partner_id" class="col-sm-2 control-label">Партнер</label>
    <div class="col-sm-10">
        <select class="form-control" id="partner_id" name="partner_id">
          @foreach($partners as $partner)
          <option value="{{$partner->id}}" @if(isset($order->partner_id) && (!empty($order->partner_id) || $order->partner_id === 0) && $order->partner_id === $partner->id) selected @endif>{{$partner->name}}</option>
          @endforeach
        </select>
    </div>
  </div>
  <div class="form-group">
    <label for="status" class="col-sm-2 control-label">Статус заказа</label>
    <div class="col-sm-10">
        <select class="form-control" name="status" id="status">
          @foreach($statuses as $sid => $status)
          <option value="{{$sid}}" @if($order->status === $sid) selected @endif>{{$status}}</option>
          @endforeach
        </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Состав заказа</label>
    <div class="col-sm-10">
      <p class="form-control-static">
        @foreach($o_products as $kp => $product) @if($kp !== 0) <br> @endif {{$product->name}} - {{$product->quantity}} шт. @endforeach
      </p>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Сумма заказа</label>
    <div class="col-sm-10">
      <p class="form-control-static">{{$order->cost}} руб.</p>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Сохранить заказ</button>
    </div>
  </div>
  {{ csrf_field() }}
</form>

@endsection