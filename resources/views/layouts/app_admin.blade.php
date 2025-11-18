<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tin Tức 24h') }}</title>

    <!-- Fonts & Icons -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    <!-- Thêm Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom CSS nhẹ để menu đẹp hơn */
        .navbar-brand { font-weight: 700; letter-spacing: -0.5px; }
        .nav-link { font-weight: 600; color: #555; }
        .nav-link:hover { color: #0d6efd; }
        .dropdown-item:active { background-color: #0d6efd; }
        body { display: flex; flex-direction: column; min-height: 100vh; }
        main { flex: 1; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <div id="app">
        <!-- Navbar: Thêm border-top tạo điểm nhấn -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top border-top border-4 border-primary">
            <div class="container">
                <!-- LOGO -->
                 <a class="navbar-brand fw-bold text-uppercase text-primary" href="{{ url('/') }}">
                    <i class="bi bi-newspaper me-2"></i>{{ config('', 'NEWS') }}
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">Xã hội</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Thế giới</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Kinh doanh</a></li>
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        
                        @if(Auth::check() && Auth::user()->role == "0")
                            <li class="nav-item dropdown me-2">
                                <a class="nav-link dropdown-toggle btn btn-outline-light text-danger border-danger border-opacity-25 rounded px-3" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-shield-lock-fill me-1"></i> Quản trị viên
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="adminDropdown">
                                    <li><a class="dropdown-item" href="{{ url('/home_admin') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ url('/category') }}"><i class="bi bi-list-task me-2"></i>Quản lý Danh mục</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/news') }}?status=pending"><i class="bi bi-hourglass-split me-2"></i>Tin chờ duyệt</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/news') }}?status=approved"><i class="bi bi-check-circle me-2"></i>Tin đã duyệt</a></li>
                                </ul>
                            </li>
                        @endif

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i> {{ __('Đăng nhập') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary btn-sm ms-2 rounded-pill px-3 fw-bold" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown ms-2">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px; font-size: 14px;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="fw-bold">{{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow border-0 pt-0" aria-labelledby="navbarDropdown">
                                    <div class="px-3 py-2 bg-light border-bottom mb-2">
                                        <small class="text-muted">Xin chào,</small><br>
                                        <strong>{{ Auth::user()->name }}</strong>
                                    </div>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person-gear me-2"></i> Hồ sơ cá nhân
                                    </a>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-power me-2"></i> {{ __('Đăng xuất') }}
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
        <main class="py-4">
            @yield('content')
        </main>
</div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>