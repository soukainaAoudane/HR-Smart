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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: #1e3a5f;">
                        <h4 class="mb-0 fw-bold">Nouveau projet</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo e(route('manager.projet.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nom du projet</label>
                                <input type="text" name="nom" class="form-control rounded-3" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control rounded-3" rows="3"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Date début</label>
                                        <input type="date" name="date_debut" class="form-control rounded-3" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Date fin </label>
                                        <input type="date" name="date_fin" class="form-control rounded-3">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Budget prévisionnel (DH)</label>
                                <input type="number" name="budget_previsionnel" class="form-control rounded-3" step="0.01" value="0">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Équipe projet</label>
                                <select name="employes[]" class="form-select rounded-3" multiple size="5">
                                    <?php $__currentLoopData = $employes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($employe->id); ?>">
                                            <?php echo e($employe->name); ?> (<?php echo e($employe->poste ?? 'Employé'); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <small class="text-muted">Ctrl+clic pour sélectionner plusieurs employés</small>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="<?php echo e(route('manager.projet.index')); ?>" class="btn btn-outline-secondary rounded-pill">
                                    <i class="fas fa-arrow-left me-2"></i> Annuler
                                </a>
                                <button type="submit" class="btn rounded-pill px-4" style="background: #1e3a5f; color: white;">
                                    <i class="fas fa-save me-2"></i> Créer le projet
                                </button>
                            </div>
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
<?php /**PATH C:\gestionstagiaires\resources\views/manager/projet/create.blade.php ENDPATH**/ ?>