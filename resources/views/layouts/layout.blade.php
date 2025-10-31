<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    @stack('styles')
    <title>@yield('title','site')</title>
</head>
<body>

<nav>
    <a href="{{ route('home') }}">Bosh sahifa</a>
    <a href="{{ route('qizlar.index') }}">Qizlar</a>
    <a href="#">Yutuqlar</a>
    <a href="#">Ovoz berish</a>
    <a href="#">Aloqa</a>
    @auth()
        <a href="{{ route('qizlar.create') }}">ro'yxatga olish</a>
    @endauth
</nav>
    @yield('content')
<footer>
    <p>© 2025 “Yil Ayoli” loyihasi. Barcha huquqlar himoyalangan.</p>
</footer>
</body>
</html>
