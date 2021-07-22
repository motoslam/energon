<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="./img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" sizes="16x16" href="./img/favicon/favicon-16x16.png" type="image/png">
    <link rel="icon" sizes="32x32" href="./img/favicon/favicon-32x32.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sys.css') }}">
    <title>@yield('pagetitle') - {{ config('app.name') }}</title>
</head>
<body>
<div class="wrapper">
    <div class="wrap-form">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('img/logo-forms.png') }}" alt="">
        </a>
        @yield('content')
    </div>
</div>

<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    $('body').on('click', '.pass-show', function(e) {
        e.preventDefault();
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).closest('div').find('input[type="text"]').attr('type', 'password');
        } else {
            $(this).addClass('active');
            $(this).closest('div').find('input[type="password"]').attr('type', 'text');
        }
    });
</script>
@yield('scripts')

</body>
</html>
