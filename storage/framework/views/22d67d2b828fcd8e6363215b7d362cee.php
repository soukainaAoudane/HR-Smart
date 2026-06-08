
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
                            <h4 class="mb-0 fw-bold">Détail de ma demande de congé</h4>
                        </div>
                    </div>
                    <div class="card-body p-4">

                        
                        <div class="alert mb-4 rounded-3 text-center fw-bold fs-5 
                            <?php if($conge->statut == 'pending'): ?> alert-warning text-dark
                            <?php elseif($conge->statut == 'approved'): ?> alert-success
                            <?php else: ?> alert-danger <?php endif; ?>">
                            <i class="fas 
                                <?php if($conge->statut == 'pending'): ?> fa-clock
                                <?php elseif($conge->statut == 'approved'): ?> fa-check-circle
                                <?php else: ?> fa-times-circle <?php endif; ?> me-2"></i>
                            <?php if($conge->statut == 'pending'): ?>
                                En attente de validation
                            <?php elseif($conge->statut == 'approved'): ?>
                                Demande approuvée
                            <?php else: ?>
                                Demande refusée
                            <?php endif; ?>
                        </div>

                        <div class="row g-3">
                            
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">Type de congé</small>
                                    <span class="fw-bold fs-5">
                                        <?php if($conge->type == 'paye'): ?>
                                            <i class="fas fa-umbrella-beach me-2" style="color: #1e3a5f;"></i> Congé payé
                                        <?php elseif($conge->type == 'rtt'): ?>
                                            <i class="fas fa-bolt me-2" style="color: #198754;"></i> RTT
                                        <?php elseif($conge->type == 'sans_solde'): ?>
                                            <i class="fas fa-coins me-2" style="color: #fd7e14;"></i> Congé sans solde
                                        <?php elseif($conge->type == 'formation'): ?>
                                            <i class="fas fa-graduation-cap me-2" style="color: #0dcaf0;"></i> Congé formation
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">Durée</small>
                                    <span class="fw-bold fs-5">
                                        <i class="fas fa-hourglass-half me-2" style="color: #1e3a5f;"></i>
                                        <?php echo e($conge->duree); ?> jour(s)
                                    </span>
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 border">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-calendar-day me-1"></i> Date début
                                    </small>
                                    <span class="fw-bold"><?php echo e(\Carbon\Carbon::parse($conge->date_debut)->format('l d F Y')); ?></span>
                                    <br>
                                    <small class="text-muted"><?php echo e(\Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y')); ?></small>
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 border">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-calendar-check me-1"></i> Date fin
                                    </small>
                                    <span class="fw-bold"><?php echo e(\Carbon\Carbon::parse($conge->date_fin)->format('l d F Y')); ?></span>
                                    <br>
                                    <small class="text-muted"><?php echo e(\Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y')); ?></small>
                                </div>
                            </div>

                            
                            <?php if($conge->motif): ?>
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #f8f9fa;">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-edit me-1"></i> Motif
                                    </small>
                                    <p class="mb-0"><?php echo e($conge->motif); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>

                            
                            <?php if($conge->commentaire_manager): ?>
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #fff3cd; border-left: 4px solid #ffc107;">
                                    <small class="text-warning text-uppercase d-block mb-1">
                                        <i class="fas fa-comment-dots me-1"></i> Commentaire du manager
                                    </small>
                                    <p class="mb-0"><?php echo e($conge->commentaire_manager); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                            <a href="<?php echo e(route('employe.conge.index')); ?>" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i> Retour
                            </a>
                            <?php if($conge->statut == 'pending'): ?>
                                <form action="<?php echo e(route('employe.conge.annuler', $conge->id)); ?>" method="POST"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette demande ?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                                        <i class="fas fa-trash-alt me-2"></i> Annuler la demande
                                    </button>
                                </form>
                            <?php endif; ?>
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
<?php endif; ?>

<style>
    .rounded-3 {
        border-radius: 0.75rem !important;
    }
    
    .border {
        border-color: #e9ecef !important;
    }
</style><?php /**PATH C:\gestionstagiaires\resources\views/employe/conge/show.blade.php ENDPATH**/ ?>