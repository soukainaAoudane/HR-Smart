
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
                    <i class="fas fa-plane fs-4 me-3"></i>
                    <h4 class="mb-0 fw-bold">Mes déplacements</h4>
                </div>
                <a href="<?php echo e(route('employe.deplacement.create')); ?>" class="btn btn-light btn-sm rounded-pill px-3">
                    <i class="fas fa-plus me-1"></i> Nouveau déplacement
                </a>
            </div>
            <div class="card-body p-4">
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if($deplacements->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead style="background-color: #e8f0fe; color: #1e3a5f;">
                                <tr>
                                    <th class="py-3">Dates</th>
                                    <th class="py-3">Lieu</th>
                                    <th class="py-3">Client</th>
                                    <th class="py-3">Frais</th>
                                    <th class="py-3">Statut</th>
                                    <th class="py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $deplacements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deplacement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr style="border-left: 4px solid
                                        <?php if($deplacement->statut == 'pending'): ?> #ffc107
                                        <?php elseif($deplacement->statut == 'approved'): ?> #198754
                                        <?php else: ?> #dc3545 <?php endif; ?>">
                                        <td>
                                            <span class="fw-semibold"><?php echo e(\Carbon\Carbon::parse($deplacement->date_debut)->format('d/m/Y')); ?></span>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-arrow-right me-1"></i> 
                                                <?php echo e(\Carbon\Carbon::parse($deplacement->date_fin)->format('d/m/Y')); ?>

                                            </small>
                                        </td>
                                        <td>
                                            <i class="fas fa-map-marker-alt me-1" style="color: #1e3a5f;"></i>
                                            <?php echo e($deplacement->lieu); ?>

                                        </td>
                                        <td>
                                            <?php if($deplacement->client): ?>
                                                <i class="fas fa-building me-1 text-muted"></i>
                                                <?php echo e($deplacement->client); ?>

                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="fw-semibold" style="color: #198754;">
                                                <?php echo e(number_format($deplacement->frais_total, 2)); ?> DH
                                            </span>
                                        </td>
                                        <td>
                                            <?php if($deplacement->statut == 'pending'): ?>
                                                <span class="badge rounded-pill px-3 py-2" style="background: #ffc107; color: #000;">
                                                    <i class="fas fa-clock me-1"></i> En attente
                                                </span>
                                            <?php elseif($deplacement->statut == 'approved'): ?>
                                                <span class="badge rounded-pill px-3 py-2" style="background: #198754;">
                                                    <i class="fas fa-check-circle me-1"></i> Accepté
                                                </span>
                                            <?php else: ?>
                                                <span class="badge rounded-pill px-3 py-2" style="background: #dc3545;">
                                                    <i class="fas fa-times-circle me-1"></i> Refusé
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo e(route('employe.deplacement.show', $deplacement->id)); ?>" 
                                               class="btn btn-sm rounded-pill px-3" 
                                               style="background: #1e3a5f; color: white; border: none;">
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
                        <div class="mb-3">
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-4" style="width: 100px; height: 100px;">
                                <i class="fas fa-plane fa-3x" style="color: #1e3a5f;"></i>
                            </div>
                        </div>
                        <h5 class="text-muted">Aucun déplacement demandé</h5>
                        <p class="text-muted">Vous n'avez pas encore fait de demande de déplacement.</p>
                        <a href="<?php echo e(route('employe.deplacement.create')); ?>" class="btn rounded-pill px-4 mt-2" 
                           style="background: #1e3a5f; color: white; border: none;">
                            <i class="fas fa-plus me-2"></i> Demander un déplacement
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

<style>
    .table {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .table thead th {
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }
    
    .table tbody tr {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }
    
    .badge {
        font-weight: 500;
        font-size: 0.75rem;
    }
    
    .btn {
        transition: all 0.2s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        filter: brightness(1.05);
    }
    
    @media (max-width: 768px) {
        .table td, .table th {
            font-size: 0.8rem;
            padding: 10px 8px;
        }
        
        .badge {
            font-size: 0.65rem;
            padding: 4px 8px;
        }
        
        .btn-sm {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
        }
    }
</style><?php /**PATH C:\gestionstagiaires\resources\views/employe/deplacement/index.blade.php ENDPATH**/ ?>