@extends('layout.master')
@section('body')
@if(isset($temp) && !empty($temp))
<h1>Температура в Брянске градусов по Цельсию: {{$temp}}</h1></div>
@endif

@endsection