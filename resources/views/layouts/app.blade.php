<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Trang Tin Tức') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .navbar-brand {
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }
        .nav-link {
            font-weight: 600;
            color: #444;
            transition: color 0.2s;
        }
        .nav-link:hover {
            color: #0d6efd !important; /* Màu xanh primary */
        }
        .dropdown-item:active {
            background-color: #0d6efd;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top border-top border-4 border-primary">
            <div class="container">
                <a class="navbar-brand fw-bold text-uppercase text-primary" href="{{ url('/') }}">
                    <i class="bi bi-newspaper me-1"></i> {{ config('', 'NEWS') }}
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">Thời sự</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Thể thao</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Công nghệ</a></li>
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        @if(Auth::check() && Auth::user()->role == "0")
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-danger btn-sm fw-bold" href="{{ url('/home_admin') }}">
                                    <i class="bi bi-gear-fill"></i> Quản trị
                                </a>
                            </li>
                        @endif

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary btn-sm ms-2 rounded-pill px-3" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <div class="bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 14px;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end border-0 shadow" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person me-2"></i> Hồ sơ cá nhân
                                    </a>
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Đăng xuất') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 flex-grow-1">
            @yield('content')
        </main>

        <footer class="bg-white py-4 mt-auto border-top">
            <div class="container text-center">
                <p class="text-muted mb-0">&copy; {{ date('Y') }} Trang Tin Điện Tử. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>