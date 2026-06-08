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
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header text-white rounded-top-4 d-flex justify-content-between align-items-center" style="background: #1e3a5f; border-bottom: none;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-tasks fs-4 me-3"></i>
                    <h4 class="mb-0 fw-bold">Gestion des tâches</h4>
                </div>
                <a href="<?php echo e(route('manager.tache.create')); ?>" class="btn btn-light btn-sm rounded-pill px-3">
                    <i class="fas fa-plus me-1"></i> Nouvelle tâche
                </a>
            </div>
            <div class="card-body p-4">
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if($taches->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead style="background-color: #e8f0fe;">
                                <tr>
                                    <th>Titre</th>
                                    <th>Assigné à</th>
                                    <th>Deadline</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $taches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tache): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong><?php echo e($tache->titre); ?></strong></td>
                                    <td><?php echo e($tache->assigne->name); ?></td>
                                    <td>
                                        <span class="small <?php echo e($tache->est_en_retard ? 'text-danger fw-bold' : ''); ?>">
                                            <?php echo e(Carbon\Carbon::parse($tache->deadline)->format('d/m/Y')); ?>

                                            <?php if($tache->est_en_retard): ?>
                                                <i class="fas fa-exclamation-triangle ms-1"></i>
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($tache->statut == 'todo'): ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #ffc107; color: #000;">À faire</span>
                                        <?php elseif($tache->statut == 'doing'): ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #0dcaf0;">En cours</span>
                                        <?php else: ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #198754;">Terminée</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('manager.tache.show', $tache->id)); ?>" class="btn btn-sm rounded-pill px-3" style="background: #1e3a5f; color: white;">
                                            <i class="fas fa-eye me-1"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucune tâche</p>
                        <a href="<?php echo e(route('manager.tache.create')); ?>" class="btn rounded-pill px-4" style="background: #1e3a5f; color: white;">
                            <i class="fas fa-plus me-2"></i> Créer une tâche
                        </a>
                    </div>
                <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\gestionstagiaires\resources\views/manager/tache/index.blade.php ENDPATH**/ ?>