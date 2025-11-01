<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    @stack('styles')
    <title>@yield('title','site')</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<body>

<nav>
        <a href="{{ route('home') }}">Bosh sahifa</a>
        <a href="{{ route('qizlar.index') }}">Qizlar</a>
        <a href="{{ route('tadbir.index') }}">Tadbirlar</a>
        <a href="{{ route('aloqa') }}">Aloqa</a>
        @guest
            <a href="{{ route('login') }}"
               class="text-blue-600 hover:text-blue-800 font-semibold">
                Kirish
            </a>
        @endguest
        @auth
            <a href="{{ route('qizlar.create') }}">Ro'yxatga olish</a>
        <a href="#"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="font-bold text-pink-800 hover:underline hover:text-pink-900 transition">
            Chiqish
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>


    @endauth
</nav>
    @yield('content')
<footer>
    <p>© 2025 “Yil Ayoli” loyihasi. Barcha huquqlar himoyalangan.</p>
</footer>
</body>
</html>
