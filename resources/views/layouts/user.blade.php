<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Aspire</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
@if(auth()->check())
    @include('inc.navbar')
@endif
<div class="container">
{{--    @if(Request::is('/'))--}}
{{--        @include('inc.showcase')--}}
{{--    @endif--}}
    <div class="row">
        <div class="col-md-8 col-lg-8">
{{--            @include('inc.message')--}}
            @yield('content')
        </div>
        <div class="col-md-4 col-lg-4">
            @include('inc.sidebar')
        </div>
    </div>
</div>
</body>
</html>
