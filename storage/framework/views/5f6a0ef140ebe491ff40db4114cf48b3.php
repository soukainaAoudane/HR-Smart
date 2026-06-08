<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'HR-Smart')); ?> - <?php echo $__env->yieldContent('title'); ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

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
            overflow-y: auto;
        }

        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .top-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 12px 24px;
            position: sticky;
            top: 0;
            z-index: 999;
        }

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

        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-logo">
            <h3><i class="fas fa-chart-line me-1"></i> HR-Smart</h3>
            <p>Gestion RH</p>
        </div>

        <nav>
            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->isEmploye()): ?>
                    <a href="<?php echo e(route('employe.dashboard')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('employe.dashboard') ? 'active' : ''); ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Tableau de bord</span>
                    </a>
                    <a href="<?php echo e(route('employe.conge.create')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('employe.conge.create') ? 'active' : ''); ?>">
                        <i class="fas fa-calendar-plus"></i>
                        <span>Demander congé</span>
                    </a>
                    <a href="<?php echo e(route('employe.conge.index')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('employe.conge.index') ? 'active' : ''); ?>">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Mes congés</span>
                    </a>
                    <a href="<?php echo e(route('employe.deplacement.index')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('employe.deplacement.index') ? 'active' : ''); ?>">
                        <i class="fas fa-plane"></i>
                        <span>Mes déplacements</span>
                    </a>
                    <a href="<?php echo e(route('employe.deplacement.create')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('employe.deplacement.create') ? 'active' : ''); ?>">
                        <i class="fas fa-plus-circle"></i>
                        <span>Demander déplacement</span>
                    </a>
                    <a href="<?php echo e(route('employe.tache.index')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('employe.tache.index') ? 'active' : ''); ?>">
                        <i class="fas fa-tasks"></i>
                        <span>Mes tâches</span>
                    </a>
                    <a href="<?php echo e(route('employe.competences')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('employe.competences') ? 'active' : ''); ?>">
                        <i class="fas fa-star"></i>
                        <span>Mes compétences</span>
                    </a>
                    <a href="<?php echo e(route('employe.profil')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('employe.profil') ? 'active' : ''); ?>">
                        <i class="fas fa-user-circle"></i>
                        <span>Mon profil</span>
                    </a>
                <?php endif; ?>

                <?php if(Auth::user()->isManager()): ?>
                    <a href="<?php echo e(route('manager.dashboard')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('manager.dashboard') ? 'active' : ''); ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Tableau de bord</span>
                    </a>
                    <a href="<?php echo e(route('manager.conges.index')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('manager.conges.index') ? 'active' : ''); ?>">
                        <i class="fas fa-calendar-check"></i>
                        <span>Valider congés</span>
                    </a>
                    <a href="<?php echo e(route('manager.deplacement.index')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('manager.deplacement.index') ? 'active' : ''); ?>">
                        <i class="fas fa-plane"></i>
                        <span>Valider déplacements</span>
                    </a>
                    <a href="<?php echo e(route('manager.tache.index')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('manager.tache.index') ? 'active' : ''); ?>">
                        <i class="fas fa-tasks"></i>
                        <span>Gestion tâches</span>
                    </a>
                    <a href=""
                        class="nav-link-sidebar <?php echo e(request()->routeIs('manager.projet.index') ? 'active' : ''); ?>">
                        <i class="fas fa-project-diagram"></i>
                        <span>Gestion projets</span>
                    </a>
                <?php endif; ?>

          <?php if(Auth::user()->isAdmin()): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Tableau de bord</span>
                    </a>
                    <a href="<?php echo e(route('admin.employes.index')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('admin.employes.index') ? 'active' : ''); ?>">
                        <i class="fas fa-users"></i>
                        <span>Gestion employés</span>
                    </a>
                    <a href="<?php echo e(route('admin.competences.index')); ?>"
                        class="nav-link-sidebar <?php echo e(request()->routeIs('admin.competences.index') ? 'active' : ''); ?>">
                        <i class="fas fa-star"></i>
                        <span>Gestion compétences</span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>

            <hr class="mx-3 my-3" style="border-color: #e0e0e0;">

            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="nav-link-sidebar btn-logout"
                    style="width: calc(100% - 24px); margin: 0 12px; background: none; border: none; cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
        </nav>
    </div>

    <div class="main-content">

        <div class="top-navbar">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0" style="color: #1e3a5f;">Bienvenue, <?php echo e(Auth::user()->name); ?> </h5>
                </div>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle rounded-pill" type="button" data-bs-toggle="dropdown"
                        style="background: #e8f0fe; border: none; color: #1e3a5f;">
                        <i class="fas fa-user-circle me-1"></i> <?php echo e(Auth::user()->name); ?>

                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo e(route('employe.profil')); ?>" style="color: #1e3a5f;">
                                <i class="fas fa-user me-2"></i> Mon profil</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button class="dropdown-item text-danger" type="submit">
                                    <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="p-4">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php echo e($slot); ?>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\gestionstagiaires\resources\views/layouts/app.blade.php ENDPATH**/ ?>