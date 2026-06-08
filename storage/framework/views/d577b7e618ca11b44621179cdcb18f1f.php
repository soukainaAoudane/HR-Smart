
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
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="text-white p-4 rounded-4 shadow-sm" style="background: #1e3a5f">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-1">Bonjour, <?php echo e(Auth::user()->name); ?></h2>
                            <p class="mb-0 opacity-75"><?php echo e(now()->translatedFormat('l d F Y')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-3 text-dark">Vue d'ensemble</h4>
            </div>

            <div class="col-md-4 col-6 mb-3">
                <div class="card rounded-4 text-center shadow-sm stat-card border-0" style="background: white;">
                    <div class="card-body py-3">
                        <div class="rounded-circle d-inline-block p-3 mb-2" style="background: rgba(30, 58, 95, 0.1);">
                            <i class="fas fa-users fs-4" style="color: #1e3a5f;"></i>
                        </div>
                        <p class="mb-0 small fw-bold text-dark">Mon équipe</p>
                        <p class="mb-0 fw-bold" style="color: #1e3a5f;"><?php echo e($employes->count() ?? 0); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-6 mb-3">
                <div class="card rounded-4 text-center shadow-sm stat-card border-0" style="background: white">
                    <div class="card-body py-3">
                        <div class="rounded-circle d-inline-block p-3 mb-2" style="background: rgba(255, 193, 7, 0.1);">
                            <i class="fas fa-clock fs-4 text-warning"></i>
                        </div>
                        <p class="mb-0 small fw-bold text-dark">Demandes en attente</p>
                        <p class="mb-0 fw-bold text-warning"><?php echo e($demandesEnAttente ?? 0); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-6 mb-3">
                <div class="card rounded-4 text-center shadow-sm stat-card border-0" style="background: white">
                    <div class="card-body py-3">
                        <div class="rounded-circle d-inline-block p-3 mb-2" style="background: rgba(25, 135, 84, 0.1);">
                            <i class="fas fa-chart-line fs-4 text-success"></i>
                        </div>
                        <p class="mb-0 small fw-bold text-dark">Charge moyenne</p>
                        <p class="mb-0 fw-bold text-success"><?php echo e(round($chargeMoyenne ?? 0)); ?>%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mon équipe -->
        <div class="card mb-4 mt-4 rounded-4 shadow-sm border-0" style="background: white">
            <div class="card-header bg-white rounded-top-4 border-0 pt-4">
                <h5 class="mb-0 fw-bold" style="color: #1e3a5f;"><i class="fas fa-users me-2"></i> Mon équipe</h5>
            </div>
            <div class="card-body">
                <?php if(isset($employes) && $employes->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Employé</th>
                                    <th>Poste</th>
                                    <th>Charge</th>
                                    <th>Congés restants</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $employes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><strong><?php echo e($employe->name); ?></strong></td>
                                        <td><?php echo e($employe->poste ?? 'Employé'); ?></td>
                                        <td style="width: 150px;">
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1" style="height: 8px;">
                                                    <?php
                                                        $chargeClass = 'bg-success';
                                                        if ($employe->charge_actuelle > 120) {
                                                            $chargeClass = 'bg-danger';
                                                        } elseif ($employe->charge_actuelle > 90) {
                                                            $chargeClass = 'bg-warning';
                                                        }
                                                    ?>
                                                    <div class="progress-bar <?php echo e($chargeClass); ?>"
                                                        style="width: <?php echo e(min($employe->charge_actuelle, 100)); ?>%">
                                                    </div>
                                                </div>
                                                <span class="ms-2 small"><?php echo e(round($employe->charge_actuelle)); ?>%</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge" style="background: #1e3a5f;"><?php echo e($employe->conges_restants); ?> jours</span>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('manager.conges.index')); ?>" class="btn btn-sm btn-outline-primary" style="border-color: #1e3a5f; color: #1e3a5f;">
                                                <i class="fas fa-eye"></i> Voir demandes
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Aucun employé dans votre équipe</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Demandes en attente -->
        <div id="demandes" class="card mb-4 mt-4 rounded-4 shadow-sm border-0" style="background:white">
            <div class="card-header bg-white rounded-top-4 border-0 pt-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold" style="color: #1e3a5f;"><i class="fas fa-clock me-2 text-warning"></i> Demandes en attente</h5>
            </div>
            <div class="card-body">
                <?php if(isset($demandes) && $demandes->count() > 0): ?>
                    <?php $__currentLoopData = $demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge bg-warning text-dark">⏳ En attente</span>
                                        <h6 class="mb-0 fw-bold text-dark"><?php echo e($demande->user->name); ?></h6>
                                    </div>
                                    <div class="mb-2">
                                        <span class="badge" style="background: #e8f0fe; color: #1e3a5f;">
                                            <i class="fas fa-tag me-1"></i>
                                            <?php if($demande->type == 'paye'): ?>
                                                Congé payé
                                            <?php elseif($demande->type == 'rtt'): ?>
                                                RTT
                                            <?php elseif($demande->type == 'sans_solde'): ?>
                                                Sans solde
                                            <?php else: ?>
                                                Formation
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3">
                                        <p class="text-muted small mb-0">
                                            <i class="fas fa-calendar-day me-1"></i>
                                            <?php echo e(\Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y')); ?> →
                                            <?php echo e(\Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y')); ?>

                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <a href="<?php echo e(route('manager.conges.show', $demande->id)); ?>"
                                        class="btn btn-sm" style="background: #1e3a5f; color: white;">
                                        <i class="fas fa-eye"></i> Traiter
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <p class="text-muted mb-0">Aucune demande en attente</p>
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
<?php endif; ?><?php /**PATH C:\gestionstagiaires\resources\views/manager/dashboard.blade.php ENDPATH**/ ?>