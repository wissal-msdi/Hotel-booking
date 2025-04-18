<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap CSS (si ce n'est pas déjà fait) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        </head>
<body>
    <nav class="navbar navbar-expand-lg {{ auth()->check() && auth()->user()->is_admin ? 'navbar-dark bg-primary' : 'navbar-light bg-light' }}">
  
    <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-building text-white me-2 fs-4"></i> <!-- Hotel Icon -->
                <span class="fw-bold">Hotel Booking</span>
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Right Side -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto d-flex align-items-center gap-3">
                @auth
    <!-- Liens communs -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('rooms.index') }}">
            <i class="bi bi-door-open"></i> Chambres
        </a>
    </li>
    <li class="nav-item">
            <a class="nav-link" href="{{ route('reservations.index') }}">
                <i class="bi bi-house-door"></i> Reservations
            </a>
        </li>

    <!-- Tableau de bord selon rôle -->
    @if(auth()->user()->is_admin)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('rooms.index') }}">
                <i class="bi bi-speedometer2"></i> Tableau Admin
            </a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('reservations.index') }}">
                <i class="bi bi-house-door"></i> Tableau Utilisateur
            </a>
        </li>
    @endif

    
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
        </a>
    </li>
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-light btn-sm" type="submit">
                <i class="bi bi-box-arrow-right"></i> Déconnexion
            </button>
        </form>
    </li>
@endauth
    
                <!-- @auth
                        @if(auth()->user()->is_admin)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rooms.index') }}">
                                    <i class="bi bi-speedometer2"></i> Tableau Admin
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <i class="bi bi-house-door"></i> Tableau Utilisateur
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-outline-light btn-sm" type="submit">
                                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                        </li>
                    @endauth -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>