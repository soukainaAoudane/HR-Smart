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
                    <div class="card-header text-white rounded-top-4" style="background: #1e3a5f; border-bottom: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle fs-4 me-3"></i>
                            <h4 class="mb-0 fw-bold">Détail de la tâche</h4>
                        </div>
                    </div>
                    <div class="card-body p-4">

                        <div class="alert mb-4 rounded-3 text-center fw-bold fs-5 
                            <?php if($tache->statut == 'todo'): ?> alert-warning text-dark
                            <?php elseif($tache->statut == 'doing'): ?> alert-info
                            <?php else: ?> alert-success <?php endif; ?>">
                            <?php if($tache->statut == 'todo'): ?>
                                📌 Statut : À faire
                            <?php elseif($tache->statut == 'doing'): ?>
                                🔄 Statut : En cours
                            <?php else: ?>
                                ✅ Statut : Terminée
                            <?php endif; ?>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">Titre</small>
                                    <span class="fw-bold fs-5"><?php echo e($tache->titre); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">Assigné à</small>
                                    <span class="fw-bold fs-5"><?php echo e($tache->assigne->name); ?></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #f8f9fa;">
                                    <small class="text-muted text-uppercase d-block mb-1">Description</small>
                                    <p class="mb-0"><?php echo e($tache->description ?? 'Aucune description'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-3 border">
                                    <small class="text-muted text-uppercase d-block mb-1">Projet</small>
                                    <span><?php echo e($tache->projet->nom ?? 'Aucun projet'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-3 border">
                                    <small class="text-muted text-uppercase d-block mb-1">Durée estimée</small>
                                    <span><?php echo e($tache->duree_estimee); ?> jours</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-3 border">
                                    <small class="text-muted text-uppercase d-block mb-1">Deadline</small>
                                    <span class="<?php echo e($tache->est_en_retard ? 'text-danger fw-bold' : ''); ?>">
                                        <?php echo e(Carbon\Carbon::parse($tache->deadline)->format('d/m/Y')); ?>

                                        <?php if($tache->est_en_retard): ?>
                                            <i class="fas fa-exclamation-triangle ms-1"></i> (En retard)
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                            <a href="<?php echo e(route('manager.tache.index')); ?>" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i> Retour
                            </a>
                            <div>
                                <a href="<?php echo e(route('manager.tache.edit', $tache->id)); ?>" class="btn rounded-pill px-4" style="background: #ffc107; color: #000;">
                                    <i class="fas fa-edit me-2"></i> Modifier
                                </a>
                                <form action="<?php echo e(route('manager.tache.destroy', $tache->id)); ?>" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Supprimer cette tâche ?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                                        <i class="fas fa-trash-alt me-2"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
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
<?php endif; ?><?php /**PATH C:\gestionstagiaires\resources\views/manager/tache/show.blade.php ENDPATH**/ ?>