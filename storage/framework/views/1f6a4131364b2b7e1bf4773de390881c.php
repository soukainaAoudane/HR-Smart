
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container py-4">
        <h1 class="text-center  fw-bold mb-4"style="color: #1e3a5f;">
            Mon Profil
        </h1>
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        <div class="row g-4">
            
            <div class="col-lg-6 col-12">
                <div class="card shadow-sm border-0 rounded-4 h-100">

                    <div class="card-header bg-white border-0 text-center pt-4">
                        <h4 class="mt-3 fw-bold">
                            <?php echo e($user->name); ?>

                        </h4>
                        <span class="badge bg-primary">
                            <?php echo e(ucfirst($user->role)); ?>

                        </span>
                    </div>
                    <div class="card-body">
                        <div class="border rounded-4 p-4 bg-light">
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">
                                    Nom
                                </div>
                                <div class="col-8">
                                    <?php echo e($user->name); ?>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">
                                    Email
                                </div>
                                <div class="col-8">
                                    <?php echo e($user->email); ?>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">
                                    Roole
                                </div>
                                <div class="col-8">
                                    <?php echo e(ucfirst($user->role)); ?>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">
                                    Manager
                                </div>
                                <div class="col-8">
                                    <?php echo e($manager?->name ?? 'Aucun manager'); ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 fw-bold">
                                    Poste
                                </div>
                                <div class="col-8">
                                    <?php echo e($user->poste); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-12">
                <div class="card shadow-sm border-0 rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4">
                        <h5 class="fw-bold  mb-0" style="color: #1e3a5f;">
                            Modifier mon profil
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('employe.profil.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    Nom
                                </label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="<?php echo e(old('name', $user->name)); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    Email
                                </label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="<?php echo e(old('email', $user->email)); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-semibold">
                                    Mot de passe actuel
                                </label>
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    Nouveau mot de passe
                                </label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Poste
                                </label>
                                <input type="text" class="form-control" value="<?php echo e($user->poste); ?>" disabled>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                Enregistrer les modifications
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\gestionstagiaires\resources\views/employe/profil.blade.php ENDPATH**/ ?>