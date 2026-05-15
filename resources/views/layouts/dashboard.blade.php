<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HR-Smart - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', system-ui, sans-serif;
            overflow-x: hidden;
        }

        /* Sidebar fixe à gauche */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(135deg, #1e3a5f 0%, #0f2b3d 100%);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        /* Contenu principal (décalé à droite) */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Navbar en haut dans le main-content */
        .top-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 12px 24px;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        /* Scrollbar personnalisée */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 5px;
        }

        /* Menu items */
        .nav-link-sidebar {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-link-sidebar:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-link-sidebar.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .nav-link-sidebar i {
            width: 24px;
            font-size: 1.1rem;
        }

        /* Logo dans sidebar */
        .sidebar-logo {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-logo h3 {
            color: white;
            font-weight: bold;
            margin: 0;
        }

        .sidebar-logo p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.75rem;
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .sidebar .nav-link-sidebar span {
                display: none;
            }

            .sidebar .sidebar-logo h3 {
                font-size: 1rem;
            }

            .sidebar .sidebar-logo p {
                display: none;
            }

            .main-content {
                margin-left: 70px;
            }
        }

        /* Cards styles */
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- SIDEBAR À GAUCHE -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <h3><i class="fas fa-chart-line me-1"></i> HR-Smart</h3>
            <p>Gestion RH</p>
        </div>

        <nav>
            @auth
                @if (Auth::user()->isEmploye())
                    <a href="{{ route('employe.dashboard') }}"
                        class="nav-link-sidebar {{ request()->routeIs('employe.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Tableau de bord</span>
                    </a>
                    <a href="{{ route('employe.conge.create') }}" class="nav-link-sidebar">
                        <i class="fas fa-calendar-plus"></i>
                        <span>Demander congé</span>
                    </a>
                    <a href="{{ route('employe.conge.index') }}"
                        class="nav-link-sidebar {{ request()->routeIs('employe.conge.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Mes congés</span>
                    </a>
                    <a href="{{ route('employe.competences') }}"
                        class="nav-link-sidebar {{ request()->routeIs('employe.competences') ? 'active' : '' }}">
                        <i class="fas fa-star"></i>
                        <span>Mes compétences</span>
                    </a>
                    <a href="{{ route('employe.profil') }}"
                        class="nav-link-sidebar {{ request()->routeIs('employe.profil') ? 'active' : '' }}">
                        <i class="fas fa-user-circle"></i>
                        <span>Mon profil</span>
                    </a>
                @endif
            @endauth

            <hr class="mx-3 my-3" style="border-color: rgba(255,255,255,0.1);">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link-sidebar"
                    style="width: 100%; background: none; border: none; cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
        </nav>
    </div>

    <!-- CONTENU PRINCIPAL -->
    <div class="main-content">

        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Bienvenue, {{ Auth::user()->name }} 👋</h5>
                </div>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle rounded-pill" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('employe.profil') }}"><i
                                    class="fas fa-user me-2"></i> Mon profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt me-2"></i>
                                    Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Contenu dynamique -->
        <div class="p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
