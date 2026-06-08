<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- PARTIE GAUCHE - FORMULAIRE SCROLLABLE (défile) -->
    <div class="scrollable-form">
        <div class="form-content">
            <div class="form-container">


                <form method="POST" action="<?php echo e(route('register')); ?>" x-data="{
                    showPassword: false,
                    showConfirmPassword: false,
                    password: '',
                    confirmPassword: ''
                }">
                    <?php echo csrf_field(); ?>

                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="name" class="form-label small fw-semibold mb-2" style="color: #0d1321;">
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
                            placeholder="Jean Dupont"
                            style="border-color: #748cab;">
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
                        <label for="email" class="form-label small fw-semibold mb-2" style="color: #0d1321;">
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
unset($__errorArgs, $__bag); ?>" placeholder="nom@entreprise.com"
                            style="border-color: #748cab;">
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
                        <label for="role" class="form-label small fw-semibold mb-2" style="color: #0d1321;">
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
unset($__errorArgs, $__bag); ?>"
                            style="border-color: #748cab;">
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
                        <label for="password" class="form-label small fw-semibold mb-2" style="color: #0d1321;">
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
                                placeholder="8 caractères minimum"
                                style="border-color: #748cab;">
                            <button class="btn btn-outline-secondary" type="button"
                                x-on:click="showPassword = !showPassword"
                                style="border-color: #748cab;">
                                <i class="bi" x-bind:class="showPassword ? 'bi-eye-slash' : 'bi-eye'"></i>
                            </button>
                        </div>
                        <div class="form-text small mt-1" style="color: #748cab;">
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
                        <label for="password_confirmation" class="form-label small fw-semibold mb-2" style="color: #0d1321;">
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
                                placeholder="Confirmez votre mot de passe"
                                style="border-color: #748cab;">
                            <button class="btn btn-outline-secondary" type="button"
                                x-on:click="showConfirmPassword = !showConfirmPassword"
                                style="border-color: #748cab;">
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
                        <label class="form-label small fw-semibold mb-2" style="color: #748cab;">
                            <i class="bi bi-building me-1"></i> Entreprise (optionnel)
                        </label>
                        <input type="text" class="form-control" placeholder="Nom de votre entreprise"
                            style="border-color: #748cab;">
                    </div>

                    <!-- Bouton -->
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-custom fw-semibold py-2">
                            <i class="bi bi-person-plus me-2"></i>
                            S'inscrire
                        </button>
                    </div>

                    <!-- Lien connexion -->
                    <div class="text-center mt-4">
                        <a href="<?php echo e(route('login')); ?>" class="text-decoration-none small" style="color: #3e5c76;">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Déjà inscrit ? Se connecter
                        </a>
                    </div>

                </form>

                <!-- Sécurité -->
                <div class="text-center mt-4 pt-2 border-top" style="border-color: #748cab;">
                    <small style="color: #748cab;">
                        <i class="bi bi-shield-check me-1"></i>
                        Vos données sont sécurisées
                    </small>
                </div>

                <!-- Indicateur de scroll -->
                <div class="text-center mt-5 pt-3">
                    <small style="color: #748cab;">
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
            <i class="bi bi-building fs-1 mb-3 d-block" style="color: #748cab;"></i>
            <h2 class="fw-bold mb-2 display-5" style="color: #f0ebd8;">HR-Smart</h2>
            <p class="mb-3" style="color: #748cab;">La solution complète pour votre RH</p>
            <div class="mt-4">
                <div class="d-flex justify-content-center gap-4">
                    <div>
                        <i class="bi bi-people fs-4" style="color: #748cab;"></i>
                        <p class="small mt-1 mb-0" style="color: #748cab;">Gestion des employés</p>
                    </div>
                    <div>
                        <i class="bi bi-calendar fs-4" style="color: #748cab;"></i>
                        <p class="small mt-1 mb-0" style="color: #748cab;">Congés & Absences</p>
                    </div>
                    <div>
                        <i class="bi bi-graph-up fs-4" style="color: #748cab;"></i>
                        <p class="small mt-1 mb-0" style="color: #748cab;">Performances</p>
                    </div>
                </div>
            </div>

            <hr class="my-4" style="border-color: #748cab;">

            <div class="mt-3">
                <small style="color: #748cab;">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    Rejoignez plus de 500 entreprises
                </small>
            </div>

            <div class="mt-4">
                <div class="d-flex justify-content-center gap-3">
                    <i class="bi bi-shield-check fs-5" style="color: #748cab;"></i>
                    <i class="bi bi-cloud fs-5" style="color: #748cab;"></i>
                    <i class="bi bi-headset fs-5" style="color: #748cab;"></i>
                </div>
            </div>
        </div>
    </div>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\gestionstagiaires\resources\views/auth/register.blade.php ENDPATH**/ ?>