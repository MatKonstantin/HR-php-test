<!DOCTYPE>
<html lang="ru" id="pjaxcontainer">
    <head>
        @section('head')
        @include('header.head')
        @show
    </head>
    <body>
        <header>
            @section('header')
            @include('header.header')
            @show
        </header>
        <main>
            <div class="container">
                @yield('body')
            </div>
        </main>
        <footer>
            @section('footer')
            @include('footer.footer')
            @show
        </footer>
        <div id='scripts' class="scripts">
            @section('scripts')
            @include('footer.scripts')
            @show
        </div>
    </body>
</html>