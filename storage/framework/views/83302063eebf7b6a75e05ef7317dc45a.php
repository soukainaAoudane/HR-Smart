<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Inscription - HR-Smart</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            overflow: hidden;
            height: 100vh;
        }

        /* Partie gauche - FORMULAIRE SCROLLABLE (défile) */
        .scrollable-form {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            background: white;
        }

        /* Partie droite - HÉROS FIXE (ne défile pas) */
        .fixed-hero {
            position: fixed;
            top: 0;
            right: 0;
            width: 50%;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Custom scrollbar pour formulaire */
        .scrollable-form::-webkit-scrollbar {
            width: 6px;
        }

        .scrollable-form::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .scrollable-form::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 3px;
        }

        .scrollable-form::-webkit-scrollbar-thumb:hover {
            background: #764ba2;
        }

        /* Contenu formulaire */
        .form-content {
            padding: 60px 40px;
            min-height: 100%;
        }

        .form-container {
            max-width: 450px;
            margin: 0 auto;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        /* Animation pour la partie fixe */
        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            padding: 20px;
        }

        /* Effet de brillance arrière-plan */
        .fixed-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.03) 1%, transparent 1%);
            background-size: 30px 30px;
            animation: shimmer 30s linear infinite;
        }

        @keyframes shimmer {
            from {
                transform: translateX(0) translateY(0);
            }

            to {
                transform: translateX(50px) translateY(50px);
            }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .fixed-hero {
                display: none;
            }

            .scrollable-form {
                width: 100%;
            }
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>

    <!-- PARTIE GAUCHE - FORMULAIRE SCROLLABLE (défile) -->
    <div class="scrollable-form">
        <div class="form-content">
            <div class="form-container">

                <!-- Logo Laravel -->
                <div class="text-center mb-4">
                    <svg viewBox="0 0 100 100" width="50" height="50" style="display: inline-block;">
                        <path d="M68.1 24.9L50.1 14.3 32 24.9 32 46.3 50.1 56.9 68.1 46.3 68.1 24.9z" fill="#FF2D20" />
                        <path d="M50.1 56.9L32 46.3 32 67.7 50.1 78.3 68.1 67.7 68.1 46.3 50.1 56.9z" fill="#FF2D20"
                            opacity="0.8" />
                        <path d="M50.1 78.3L32 67.7 32 89.2 50.1 99.7 68.1 89.2 68.1 67.7 50.1 78.3z" fill="#FF2D20"
                            opacity="0.6" />
                        <path d="M86.2 35.5L68.1 24.9 68.1 46.3 86.2 56.9 86.2 35.5z" fill="#FF2D20" opacity="0.5" />
                        <path d="M86.2 56.9L68.1 46.3 68.1 67.7 86.2 78.3 86.2 56.9z" fill="#FF2D20" opacity="0.3" />
                    </svg>
                    <h3 class="fw-bold mt-3 mb-1">Créer un compte</h3>
                    <p class="text-muted small">Rejoignez HR-Smart</p>
                </div>

                <form method="POST" action="<?php echo e(route('register')); ?>" x-data="{
                    showPassword: false,
                    showConfirmPassword: false,
                    password: '',
                    confirmPassword: ''
                }">
                    <?php echo csrf_field(); ?>

                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="name" class="form-label small fw-semibold mb-2">
                            <i class="bi bi-person me-1"></i> Nom complet
                        </label>
                        <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required
                            autofocus class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Jean Dupont">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block small"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold mb-2">
                            <i class="bi bi-envelope me-1"></i> Adresse email
                        </label>
                        <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required
                            class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="nom@entreprise.com">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block small"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Rôle -->
                    <div class="mb-3">
                        <label for="role" class="form-label small fw-semibold mb-2">
                            <i class="bi bi-briefcase me-1"></i> Rôle
                        </label>
                        <select id="role" name="role" required
                            class="form-select <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="employe" <?php echo e(old('role') == 'employe' ? 'selected' : ''); ?>>Employé</option>
                            <option value="manager" <?php echo e(old('role') == 'manager' ? 'selected' : ''); ?>>Manager</option>
                            <option value="admin" <?php echo e(old('role') == 'admin' ? 'selected' : ''); ?>>Administrateur
                            </option>
                        </select>
                        <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block small"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-3">
                        <label for="password" class="form-label small fw-semibold mb-2">
                            <i class="bi bi-lock me-1"></i> Mot de passe
                        </label>
                        <div class="input-group">
                            <input type="password" x-bind:type="showPassword ? 'text' : 'password'" id="password"
                                name="password" required x-model="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="8 caractères minimum">
                            <button class="btn btn-outline-secondary" type="button"
                                x-on:click="showPassword = !showPassword">
                                <i class="bi" x-bind:class="showPassword ? 'bi-eye-slash' : 'bi-eye'"></i>
                            </button>
                        </div>
                        <div class="form-text small mt-1">
                            <i class="bi bi-info-circle me-1"></i> Minimum 8 caractères
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block small"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Confirmation -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label small fw-semibold mb-2">
                            <i class="bi bi-check-circle me-1"></i> Confirmer le mot de passe
                        </label>
                        <div class="input-group">
                            <input type="password" x-bind:type="showConfirmPassword ? 'text' : 'password'"
                                id="password_confirmation" name="password_confirmation" required
                                x-model="confirmPassword"
                                class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Confirmez votre mot de passe">
                            <button class="btn btn-outline-secondary" type="button"
                                x-on:click="showConfirmPassword = !showConfirmPassword">
                                <i class="bi" x-bind:class="showConfirmPassword ? 'bi-eye-slash' : 'bi-eye'"></i>
                            </button>
                        </div>
                        <!-- Message de confirmation en direct -->
                        <div class="small mt-1" x-show="confirmPassword.length > 0" x-cloak>
                            <template x-if="password === confirmPassword && password.length > 0">
                                <span class="text-success">
                                    <i class="bi bi-check-circle-fill me-1"></i> Les mots de passe correspondent
                                </span>
                            </template>
                            <template x-if="password !== confirmPassword && confirmPassword.length > 0">
                                <span class="text-danger">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Les mots de passe ne
                                    correspondent pas
                                </span>
                            </template>
                        </div>
                        <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block small"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Champ optionnel pour tester le scroll -->
                    <div class="mb-4">
                        <label class="form-label small fw-semibold mb-2 text-muted">
                            <i class="bi bi-building me-1"></i> Entreprise (optionnel)
                        </label>
                        <input type="text" class="form-control" placeholder="Nom de votre entreprise">
                    </div>

                    <!-- Bouton -->
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-gradient text-white fw-semibold py-2">
                            <i class="bi bi-person-plus me-2"></i>
                            S'inscrire
                        </button>
                    </div>

                    <!-- Lien connexion -->
                    <div class="text-center mt-4">
                        <a href="<?php echo e(route('login')); ?>" class="text-decoration-none small">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Déjà inscrit ? Se connecter
                        </a>
                    </div>

                </form>

                <!-- Sécurité -->
                <div class="text-center mt-4 pt-2 border-top">
                    <small class="text-muted">
                        <i class="bi bi-shield-check me-1"></i>
                        Vos données sont sécurisées
                    </small>
                </div>

                <!-- Indicateur de scroll -->
                <div class="text-center mt-5 pt-3">
                    <small class="text-muted">
                        <i class="bi bi-arrow-down me-1"></i>
                        Scrollez pour continuer
                    </small>
                </div>

            </div>
        </div>
    </div>

    <!-- PARTIE DROITE - HÉROS FIXE (ne défile pas) -->
    <div class="fixed-hero">
        <div class="hero-content">
            <i class="bi bi-building fs-1 mb-3 d-block"></i>
            <h2 class="fw-bold mb-2 display-5">HR-Smart</h2>
            <p class="mb-3">La solution complète pour votre RH</p>
            <div class="mt-4">
                <div class="d-flex justify-content-center gap-4">
                    <div>
                        <i class="bi bi-people fs-4"></i>
                        <p class="small mt-1 mb-0">Gestion des employés</p>
                    </div>
                    <div>
                        <i class="bi bi-calendar fs-4"></i>
                        <p class="small mt-1 mb-0">Congés & Absences</p>
                    </div>
                    <div>
                        <i class="bi bi-graph-up fs-4"></i>
                        <p class="small mt-1 mb-0">Performances</p>
                    </div>
                </div>
            </div>

            <hr class="bg-white-50 my-4">

            <div class="mt-3">
                <small class="opacity-75">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    Rejoignez plus de 500 entreprises
                </small>
            </div>

            <div class="mt-4">
                <div class="d-flex justify-content-center gap-3">
                    <i class="bi bi-shield-check fs-5"></i>
                    <i class="bi bi-cloud fs-5"></i>
                    <i class="bi bi-headset fs-5"></i>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php /**PATH C:\gestionstagiaires\resources\views/auth/register.blade.php ENDPATH**/ ?>