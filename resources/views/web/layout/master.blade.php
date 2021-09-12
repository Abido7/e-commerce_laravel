<!DOCTYPE html>
<html lang="en" dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('title')
</head>

<body>
    <x-navbar></x-navbar>
    @yield('content')
</body>

</html>
