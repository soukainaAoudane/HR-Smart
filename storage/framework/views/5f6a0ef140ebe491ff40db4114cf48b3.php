<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>HR-Smart - <?php echo $__env->yieldContent('title'); ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php echo $__env->yieldPushContent('styles'); ?>

    <style>
        /* Palette de couleurs professionnelle */
        .bg-nav {
            background: linear-gradient(135deg, #0f2b3d 0%, #1e3a5f 100%);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #1e3a5f, #2c5a8c);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #2c5a8c, #1e3a5f);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30, 58, 95, 0.3);
        }

        .nav-link-custom {
            color: rgba(255, 255, 255, 0.9) !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-link-custom:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white !important;
        }

        .dropdown-menu-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 8px;
        }

        .dropdown-item-custom {
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .dropdown-item-custom:hover {
            background-color: #e8f0fe;
            transform: translateX(4px);
        }

        .alert-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
    </style>
</head>

<body>

    
    <nav class="navbar navbar-expand-lg navbar-dark bg-nav shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="<?php echo e(route('dashboard')); ?>">
                <i class="fas fa-chart-line me-2"></i> HR-Smart
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->isEmploye()): ?>
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom mx-1" href="<?php echo e(route('employe.conge.create')); ?>">
                                    <i class="fas fa-calendar-alt me-1"></i> Demander congé
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom mx-1" href="<?php echo e(route('employe.conge.index')); ?>">
                                    <i class="fas fa-list me-1"></i> Mes congés
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom mx-1" href="<?php echo e(route('employe.competences')); ?>">
                                    <i class="fas fa-star me-1"></i> Compétences
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(Auth::user()->isManager()): ?>
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom mx-1" href="<?php echo e(route('manager.conges.index')); ?>">
                                    <i class="fas fa-calendar-check me-1"></i> Valider congés
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>

                
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle rounded-pill px-3 py-1" type="button"
                        data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i> <?php echo e(Auth::user()->name ?? 'Compte'); ?>

                    </button>

                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->isEmploye()): ?>
                                <a class="dropdown-item dropdown-item-custom" href="<?php echo e(route('employe.dashboard')); ?>">
                                    <i class="fas fa-tachometer-alt me-2 text-primary"></i> Tableau de bord
                                </a>
                                <a class="dropdown-item dropdown-item-custom" href="<?php echo e(route('employe.competences')); ?>">
                                    <i class="fas fa-star me-2 text-warning"></i> Mes compétences
                                </a>
                                <a class="dropdown-item dropdown-item-custom" href="<?php echo e(route('employe.conge.index')); ?>">
                                    <i class="fas fa-calendar-alt me-2 text-success"></i> Mes congés
                                </a>
                                <a class="dropdown-item dropdown-item-custom" href="<?php echo e(route('employe.conge.create')); ?>">
                                    <i class="fas fa-plus me-2 text-info"></i> Nouvelle demande
                                </a>
                                <div class="dropdown-divider"></div>
                            <?php endif; ?>

                            <?php if(Auth::user()->isManager()): ?>
                                <a class="dropdown-item dropdown-item-custom" href="<?php echo e(route('manager.dashboard')); ?>">
                                    <i class="fas fa-tachometer-alt me-2 text-primary"></i> Dashboard
                                </a>
                                <div class="dropdown-divider"></div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="dropdown-item dropdown-item-custom text-danger" type="submit">
                                <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    
    <main class="py-4">
        <div class="container">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\gestionstagiaires\resources\views/layouts/app.blade.php ENDPATH**/ ?>