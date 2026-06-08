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
            :root {
                --primary-blue: #1e3a5f;
                --primary-dark: #0f2b3d;
                --sidebar-bg: #ffffff;
                --sidebar-text: #1e3a5f;
                --sidebar-text-light: #6c757d;
                --sidebar-hover: #e8f0fe;
                --sidebar-active: #1e3a5f;
            }

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

            /* Sidebar fixe à gauche - BLANC */
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 280px;
                height: 100vh;
                background: var(--sidebar-bg);
                box-shadow: 2px 0 12px rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
                z-index: 1000;
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
                background: #e8f0fe;
            }

            .sidebar::-webkit-scrollbar-thumb {
                background: var(--primary-blue);
                border-radius: 5px;
            }

            /* Menu items - TEXTE BLEU */
            .nav-link-sidebar {
                color: var(--sidebar-text);
                padding: 12px 20px;
                margin: 4px 12px;
                border-radius: 12px;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                gap: 12px;
                text-decoration: none;
            }

            .nav-link-sidebar:hover {
                background: var(--sidebar-hover);
                color: var(--sidebar-active);
                transform: translateX(5px);
            }

            .nav-link-sidebar.active {
                background: var(--sidebar-hover);
                color: var(--sidebar-active);
                font-weight: 600;
            }

            .nav-link-sidebar i {
                width: 24px;
                font-size: 1.1rem;
                color: var(--sidebar-text);
            }

            .nav-link-sidebar:hover i {
                color: var(--sidebar-active);
            }

            /* Logo dans sidebar - BLEU */
            .sidebar-logo {
                padding: 25px 20px;
                text-align: center;
                border-bottom: 1px solid #e0e0e0;
                margin-bottom: 20px;
            }

            .sidebar-logo h3 {
                color: var(--primary-blue);
                font-weight: bold;
                margin: 0;
            }

            .sidebar-logo p {
                color: var(--sidebar-text-light);
                font-size: 0.75rem;
                margin: 0;
            }

            /* Bouton déconnexion */
            .btn-logout {
                color: #dc3545 !important;

            }

            .btn-logout:hover {
                background: #fee2e2 !important;
                color: #dc3545 !important;
            }

            .btn-logout i {
                color: #dc3545 !important;
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
                    font-size: 0.9rem;
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

        <!-- SIDEBAR À GAUCHE - BLANC -->
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
                            <span>Tableau de bord</span>
                        </a>
                        <a href="{{ route('employe.conge.create') }}"
                            class="nav-link-sidebar {{ request()->routeIs('employe.conge.create') ? 'active' : '' }}">
                            <span>Demander congé</span>
                        </a>
                        <a href="{{ route('employe.conge.index') }}"
                            class="nav-link-sidebar {{ request()->routeIs('employe.conge.index') ? 'active' : '' }}">
                            <span>Mes congés</span>
                        </a>
                        <a href="{{ route('employe.competences') }}"
                            class="nav-link-sidebar {{ request()->routeIs('employe.competences') ? 'active' : '' }}">
                            <span>Mes compétences</span>
                        </a>
                        <a href="{{ route('employe.profil') }}"
                            class="nav-link-sidebar {{ request()->routeIs('employe.profil') ? 'active' : '' }}">
                            <span>Mon profil</span>
                        </a>
                    @endif

                    @if (Auth::user()->isManager())
                        <a href="{{ route('manager.conges.index') }}" class="nav-link-sidebar">
                            <span>Valider congés</span>
                        </a>
                    @endif
                @endauth

                <hr class="mx-3 my-3" style="border-color: #e0e0e0;">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link-sidebar btn-logout"
                        style="width: 255px; background: none; border: none; cursor: pointer;">
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
                        <h5 class="mb-0" style="color: #1e3a5f;">Bienvenue, {{ Auth::user()->name }} </h5>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle rounded-pill" type="button"
                            data-bs-toggle="dropdown" style="background: #e8f0fe; border: none; color: #1e3a5f;">
                      {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('employe.profil') }}"
                                    style="color: #1e3a5f;"> Mon profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">Déconnexion</button>
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
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                         {{ session('error') }}
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
