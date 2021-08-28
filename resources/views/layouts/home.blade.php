<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Головна сторінка</title>

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="navbar">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link">Адміністративна панель</a>
                @else
                    <div class="w-25 d-flex justify-content-center">
                        <a href="{{ route('login') }}" class="nav-link">Увійти</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">Зареєструватися</a>
                        @endif
                    </div>
                @endauth
            @endif
        </div>
        
        <!-- New articles section -->
        @yield('content')

        <script src="/js/app.js"></script>
    </body>
</html>
