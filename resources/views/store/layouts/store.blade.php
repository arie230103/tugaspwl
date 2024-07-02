<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ARIESHOP</title>

    <link rel="icon" href="{{ asset('assets/img/coffee-shop.png') }}" type="image/x-icon" />

    @include('store.components.css')

    @yield('css')
</head>
<body>
    @include('store.components.topbar')

    @include('store.components.navbar')

    @yield('content')

    @include('store.components.footer')

    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    @include('store.components.js')

    @yield('js')

    <script>
        $(document).ready(() => {
            $('#loginBtn').on('click', () => {
                window.location.href = $("#login").attr('href');
            });

            $('#registerBtn').on('click', () => {
                window.location.href = $("#register").attr('href');
            });
        });
    </script>
</body>
</html>
