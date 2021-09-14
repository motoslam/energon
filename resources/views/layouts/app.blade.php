<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{ url('/') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="./img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" sizes="16x16" href="./img/favicon/favicon-16x16.png" type="image/png">
    <link rel="icon" sizes="32x32" href="./img/favicon/favicon-32x32.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sys.css') }}">
    <link rel="stylesheet" href="{{ asset('css/suggestions.css') }}" />
    <livewire:styles />
    <title>{{ $title ?? config('app.name') }}</title>
</head>
<body style="overflow-y: scroll;">
<div class="wrapper {{ $wrapperCss ?? '' }}">
    @include('layouts.navigation')

    <div class="content-box">
    {{ $header }}
        <!--<img class="decor1" src="{{ asset('img/decor1.png') }}" alt="">
        <img class="decor2" src="{{ asset('img/decor2.png') }}" alt="">-->
        {{ $slot }}
    </div>
</div>

<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<livewire:scripts />
<script src="{{ asset('js/app.js') }}"></script>
{{ $scripts ?? '' }}

</body>
</html>
