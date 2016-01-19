<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container">


    <header class="row">
        <div class="col-md-1"></div>

        <div class="col-md-10">
            @include('includes.header')
        </div>
        <div class="col-md-1"></div>

    </header>

    <div id="main" class="row">
        <div class="col-md-1"></div>

        <div class="col-md-10">

                @yield('content')

        </div>
        <div class="col-md-1"></div>
    </div>

    <footer class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            @include('includes.footer')
        </div>
        <div class="col-md-1"></div>
    </footer>

</div>
</body>
</html>