
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
                            <h4 class="mb-0 fw-bold">Détail du déplacement</h4>
                        </div>
                    </div>
                    <div class="card-body p-4">

                        
                        <div class="alert mb-4 rounded-3 text-center fw-bold fs-5
                            <?php if($deplacement->statut == 'pending'): ?> alert-warning text-dark
                            <?php elseif($deplacement->statut == 'approved'): ?> alert-success
                            <?php else: ?> alert-danger <?php endif; ?>">
                            <i class="fas
                                <?php if($deplacement->statut == 'pending'): ?> fa-clock
                                <?php elseif($deplacement->statut == 'approved'): ?> fa-check-circle
                                <?php else: ?> fa-times-circle <?php endif; ?> me-2"></i>
                            <?php if($deplacement->statut == 'pending'): ?>
                                En attente de validation
                            <?php elseif($deplacement->statut == 'approved'): ?>
                                Déplacement accepté
                            <?php else: ?>
                                Déplacement refusé
                            <?php endif; ?>
                        </div>

                        <div class="row g-3">
                            
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-calendar-alt me-1"></i> Peeriode
                                    </small>
                                    <span class="fw-bold fs-5">
                                        <?php echo e(\Carbon\Carbon::parse($deplacement->date_debut)->format('d/m/Y')); ?>

                                    </span>
                                    <i class="fas fa-arrow-right mx-2 text-muted"></i>
                                    <span class="fw-bold fs-5">
                                        <?php echo e(\Carbon\Carbon::parse($deplacement->date_fin)->format('d/m/Y')); ?>

                                    </span>
                                    <br>
                                    <small class="text-muted">
                                        Durée : <?php echo e(\Carbon\Carbon::parse($deplacement->date_debut)->diffInDays(\Carbon\Carbon::parse($deplacement->date_fin)) + 1); ?> jours
                                    </small>
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-map-marker-alt me-1"></i> Lieu
                                    </small>
                                    <span class="fw-bold fs-5">
                                        <i class="fas fa-location-dot me-2" style="color: #1e3a5f;"></i>
                                        <?php echo e($deplacement->lieu); ?>

                                    </span>
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 border">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-building me-1"></i> rganisation
                                    </small>
                                    <span class="fw-bold">
                                        <?php echo e($deplacement->client ?? 'Non spécifié'); ?>

                                    </span>
                                </div>
                            </div>

                            
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #f8f9fa;">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-edit me-1"></i> Motif
                                    </small>
                                    <p class="mb-0"><?php echo e($deplacement->motif ?? 'Non spécifié'); ?></p>
                                </div>
                            </div>

                            
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-coins me-1"></i> Frais estiméss
                                    </small>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <div class="text-center p-2 bg-white rounded-3">
                                                <i class="fas fa-car text-primary"></i>
                                                <div class="fw-bold"><?php echo e(number_format($deplacement->frais_transport, 2)); ?> DH</div>
                                                <small class="text-muted">Transport</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center p-2 bg-white rounded-3">
                                                <i class="fas fa-hotel text-primary"></i>
                                                <div class="fw-bold"><?php echo e(number_format($deplacement->frais_hebergement, 2)); ?> DH</div>
                                                <small class="text-muted">Hébergement</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center p-2 bg-white rounded-3">
                                                <i class="fas fa-utensils text-primary"></i>
                                                <div class="fw-bold"><?php echo e(number_format($deplacement->frais_repas, 2)); ?> DH</div>
                                                <small class="text-muted">Repas</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-2 pt-2 border-top">
                                        <strong class="fs-5" style="color: #198754;">
                                            Total : <?php echo e(number_format($deplacement->frais_total, 2)); ?> DH
                                        </strong>
                                    </div>
                                </div>
                            </div>

                            
                            <?php if($deplacement->commentaire_manager): ?>
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #fff3cd; border-left: 4px solid #ffc107;">
                                    <small class="text-warning text-uppercase d-block mb-1">
                                        <i class="fas fa-comment-dots me-1"></i> Commentaire du manager
                                    </small>
                                    <p class="mb-0"><?php echo e($deplacement->commentaire_manager); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>

                            
                            <?php if($deplacement->justificatif): ?>
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-paperclip me-1"></i> Justificatif
                                    </small>
                                    <a href="<?php echo e(asset('storage/' . $deplacement->justificatif)); ?>" target="_blank"
                                        class="btn rounded-pill px-3" style="background: #1e3a5f; color: white; border: none;">
                                        <i class="fas fa-file-pdf me-2"></i> Voir le fichier
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                            <a href="<?php echo e(route('employe.deplacement.index')); ?>" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i> Retour
                            </a>
                            <?php if($deplacement->statut == 'pending'): ?>
                                <form action="<?php echo e(route('employe.deplacement.destroy', $deplacement->id)); ?>"
                                    method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette demande ?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                                        <i class="fas fa-trash-alt me-2"></i> Annuler
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

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .border {
        border-color: #e9ecef !important;
    }

    .btn {
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }
</style>
<?php /**PATH C:\gestionstagiaires\resources\views/employe/deplacement/show.blade.php ENDPATH**/ ?>