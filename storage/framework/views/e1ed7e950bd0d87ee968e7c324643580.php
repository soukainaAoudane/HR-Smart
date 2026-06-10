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
            <div class="card-header text-white rounded-top-4" style="background: #1e3a5f;">
                <h4 class="mb-0 fw-bold">🤖 Propositions de remplacement</h4>
            </div>
            <div class="card-body p-4">
                
                <?php if($propositions->count() > 0): ?>
                    <div class="alert alert-success mb-4">
                        <i class="fas fa-check-circle me-2"></i>
                        Congé de <strong><?php echo e($conge->user->name); ?></strong> accepté.
                        Voici les meilleurs remplaçants :
                    </div>
                    
                    <div class="row">
                        <?php $__currentLoopData = $propositions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h5 class="fw-bold mb-0"><?php echo e($proposition['employe']->name); ?></h5>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #1e3a5f;">
                                                Score: <?php echo e($proposition['score']); ?>%
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-2">
                                            <i class="fas fa-briefcase me-1"></i> 
                                            <?php echo e($proposition['employe']->poste ?? 'Employé'); ?>

                                        </p>
                                        
                                        
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span>Compétences</span>
                                                <span><?php echo e($proposition['details']['competences']); ?>%</span>
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-info" style="width: <?php echo e($proposition['details']['competences']); ?>%"></div>
                                            </div>
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span>Disponibilité</span>
                                                <span><?php echo e($proposition['details']['disponibilite']); ?>%</span>
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-success" style="width: <?php echo e($proposition['details']['disponibilite']); ?>%"></div>
                                            </div>
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span>Charge actuelle</span>
                                                <span><?php echo e($proposition['details']['charge']); ?>%</span>
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-warning" style="width: <?php echo e($proposition['details']['charge']); ?>%"></div>
                                            </div>
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span>Performance</span>
                                                <span><?php echo e($proposition['details']['performance']); ?>%</span>
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-danger" style="width: <?php echo e($proposition['details']['performance']); ?>%"></div>
                                            </div>
                                        </div>
                                        
                                        <form action="<?php echo e(route('manager.conge.proposer', $conge->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="remplacant_id" value="<?php echo e($proposition['employe']->id); ?>">
                                            <button type="submit" class="btn w-100 rounded-pill" style="background: #1e3a5f; color: white;">
                                                <i class="fas fa-paper-plane me-2"></i> Proposer ce remplaçant
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-users-slash fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucun remplaçant disponible pour ce congé.</p>
                        <a href="<?php echo e(route('manager.conges.index')); ?>" class="btn btn-secondary rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i> Retour
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
<?php endif; ?><?php /**PATH C:\gestionstagiaires\resources\views/manager/conge/propositions.blade.php ENDPATH**/ ?>