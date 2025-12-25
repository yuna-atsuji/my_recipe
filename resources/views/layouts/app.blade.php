<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'My Recipe') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

   {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'My Recipe') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center gap-3">
                        <li class="nav-item">
                            <a class="nav-link nav-underline" href="{{ route('recipes.index') }}">
                                All Recipe
                            </a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-dark btn-sm" href="{{ route('login') }}">
                                        Sign in
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-dark btn-sm" href="{{ route('register') }}">
                                        Sign up
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link nav-underline" href="{{ route('recipes.create') }}">
                                    Add Recipe
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link nav-underline" href="{{ route('mypage.index') }}">
                                    My page
                                </a>
                            </li>

                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-dark btn-sm px-4">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <footer class="bg-light">
            <h5 >&copy;Yuna</h5>
        </footer>
    </div>
    @if ($errors->any())
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof bootstrap === 'undefined') return;
            const el = document.getElementById('editProfile');
            if (!el) return;
            const modal = new bootstrap.Modal(el);
            modal.show();
        });
        </script>
@endif

</body>
</html>
