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
            <div class="card-header text-white rounded-top-4 d-flex justify-content-between align-items-center" style="background: #1e3a5f;">
                <h4 class="mb-0 fw-bold">Mes projets</h4>
                <a href="<?php echo e(route('manager.projet.create')); ?>" class="btn btn-light btn-sm rounded-pill">
                    <i class="fas fa-plus me-1"></i> Nouveau projet
                </a>
            </div>
            <div class="card-body p-4">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <?php if($projets->count() > 0): ?>
                    <div class="row">
                        <?php $__currentLoopData = $projets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h5 class="fw-bold mb-0" style="color: #1e3a5f;"><?php echo e($projet->nom); ?></h5>
                                            <span class="badge rounded-pill px-3 py-2" style="background:
                                                <?php if($projet->statut == 'en_attente'): ?> #ffc107; color:#000
                                                <?php elseif($projet->statut == 'en_cours'): ?> #0dcaf0
                                                <?php elseif($projet->statut == 'termine'): ?> #198754
                                                <?php else: ?> #dc3545 <?php endif; ?>">
                                                <?php if($projet->statut == 'en_attente'): ?> En attente
                                                <?php elseif($projet->statut == 'en_cours'): ?>En cours
                                                <?php elseif($projet->statut == 'termine'): ?>Terminé
                                                <?php else: ?> Annulé <?php endif; ?>
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-3"><?php echo e(Str::limit($projet->description, 100)); ?></p>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span>Avancement</span>
                                                <span><?php echo e($projet->avancement); ?>%</span>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-success" style="width: <?php echo e($projet->avancement); ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between small text-muted mb-3">
                                            <span><i class="fas fa-calendar me-1"></i> <?php echo e(\Carbon\Carbon::parse($projet->date_debut)->format('d/m/Y')); ?></span>
                                            <span><i class="fas fa-users me-1"></i> <?php echo e($projet->employes->count()); ?> membres</span>
                                            <span><i class="fas fa-coins me-1"></i> <?php echo e(number_format($projet->budget_previsionnel, 0)); ?> DH</span>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="<?php echo e(route('manager.projet.show', $projet->id)); ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                            <a href="<?php echo e(route('manager.projet.edit', $projet->id)); ?>" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucun projet</p>
                        <a href="<?php echo e(route('manager.projet.create')); ?>" class="btn btn-primary rounded-pill">
                            <i class="fas fa-plus me-2"></i> Créer un projet
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
<?php endif; ?>
<?php /**PATH C:\gestionstagiaires\resources\views/manager/projet/index.blade.php ENDPATH**/ ?>