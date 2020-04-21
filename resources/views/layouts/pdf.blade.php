<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Basic Corporation') }}</title>
    <style>
        @font-face {
            font-family: 'DejaVu Serif';
            src: url({{ storage_path().'/fonts/dejavu/DejaVuSerif.eot'}});
            src: url({{ storage_path().'/fonts/dejavu/DejaVuSerif.eot?#iefix'}}) format('embedded-opentype'),
            url({{ storage_path().'/fonts/dejavu/DejaVuSerif.woff2'}}) format('woff2'),
            url({{ storage_path().'/fonts/dejavu/DejaVuSerif.woff'}}) format('woff'),
            url({{ storage_path().'/fonts/dejavu/DejaVuSerif.ttf'}}) format('truetype'),
            url({{ storage_path().'/fonts/dejavu/DejaVuSerif.svg#DejaVuSerif'}}) format('svg');
            font-weight: normal;
            font-style: normal;
        }
    </style>

    {{--    <link href="{{ asset('/fonts/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css"/>--}}
    {{--    <link href="{{ asset('/fonts/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css"/>--}}

{{--        <link href="{{ asset('css/backend/pdf.css') }}" rel="stylesheet" media="all">--}}
    <link href="{{public_path('css/backend/pdf.css') }}" rel="stylesheet" media="all">
</head>
<body>
<div id="app">

    <main class="py-5">
        @yield('content')
    </main>
</div>
</body>
</html>
