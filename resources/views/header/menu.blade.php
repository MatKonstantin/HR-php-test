<div class="container">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{route('index')}}">Logo</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="{{Request::is('orders') || Request::is('orders/*') ? 'active' : ''}}"><a href="{{route('orders')}}">Заказы {!!Request::is('orders') || Request::is('orders/*') ? '<span class="sr-only">(current)</span>' : ''!!}</a></li>
      </ul>
    </div>
  </div>
</nav>
</div>