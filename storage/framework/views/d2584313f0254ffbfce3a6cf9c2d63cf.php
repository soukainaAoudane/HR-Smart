
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
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-gradient-primary text-white" style="background: #1e3a5f">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Demandes de congé</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if(session('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i> <?php echo e(session('error')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if($demandes->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Employé</th>
                                            <th>Type</th>
                                            <th>Date début</th>
                                            <th>Date fin</th>
                                            <th>Durée</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>{
                                        <tr>
                                            <td class="text-center"><?php echo e($index + 1); ?></td>
                                            <td>
                                                <strong><?php echo e($demande->user->name); ?></strong><br>
                                                <small class="text-muted"><?php echo e($demande->user->poste ?? 'Employé'); ?></small>
                                            </td>
                                            <td>
                                                <?php if($demande->type == 'paye'): ?>
                                                    <span class="badge bg-info">Congé payé</span>
                                                <?php elseif($demande->type == 'rtt'): ?>
                                                    <span class="badge bg-success">RTT</span>
                                                <?php elseif($demande->type == 'sans_solde'): ?>
                                                    <span class="badge bg-warning">Sans solde</span>
                                                <?php elseif($demande->type == 'formation'): ?>
                                                    <span class="badge bg-primary">Formation</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(\Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y')); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y')); ?></td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary"><?php echo e($demande->duree); ?> jourss</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning text-dark">En attente</span>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('manager.conges.show', $demande->id)); ?>"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i> Traiter
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>}
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                <h5 class="text-muted">Aucune demande en attente</h5>
                                <p class="text-muted">Toutes les demandes ont été traitées.</p>
                            </div>
                        <?php endif; ?>
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
<?php /**PATH C:\gestionstagiaires\resources\views/manager/conge/index.blade.php ENDPATH**/ ?>