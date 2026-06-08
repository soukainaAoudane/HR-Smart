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
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Détail de la demande</h4>
                    </div>
                    <div class="card-body">

                        
                        <div class="alert alert-info">
                            <strong>Employé :</strong> <?php echo e($demande->user->name); ?><br>
                            <strong>Email :</strong> <?php echo e($demande->user->email); ?><br>
                            <strong>Congés restants :</strong>
                            <span class="badge bg-primary"><?php echo e($demande->user->conges_restants); ?> jours</span>
                        </div>

                        
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 150px;">Type</th>
                                <td>
                                    <?php if($demande->type == 'paye'): ?>
                                        Congé payé
                                    <?php elseif($demande->type == 'rtt'): ?>
                                        RTT
                                    <?php elseif($demande->type == 'sans_solde'): ?>
                                        Congé sans solde
                                    <?php elseif($demande->type == 'formation'): ?>
                                        Congé formation
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Date début</th>
                                <td><?php echo e(\Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y')); ?></td>
                            </tr>
                            <tr>
                                <th>Date fin</th>
                                <td><?php echo e(\Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y')); ?></td>
                            </tr>
                            <tr>
                                <th>Durée</th>
                                <td><?php echo e($demande->duree); ?> jours</td>
                            </tr>
                            <?php if($demande->motif): ?>
                                <tr>
                                    <th>Motif</th>
                                    <td><?php echo e($demande->motif); ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr class="table-warning">
                                <th>Impact équipe</th>
                                <td>
                                    <strong><?php echo e($congesSimultanes); ?>/<?php echo e($totalEquipe); ?></strong> employés absents
                                    (<?php echo e(number_format($impactPourcentage, 0)); ?>%)
                                    <?php if($impactPourcentage > 30): ?>
                                        <span class="badge bg-danger ms-2">Attention</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>

                        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?php echo e(route('manager.conges.index')); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <div>
                                
                                <form method="POST" action="<?php echo e(route('manager.conges.accepter', $demande->id)); ?>"
                                    style="display: inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Accepter cette demande ?')">
                                        <i class="fas fa-check-circle"></i> Accepter
                                    </button>
                                </form>

                                
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalRefus">
                                    <i class="fas fa-times-circle"></i> Refuser
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalRefus" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('manager.conges.refuser', $demande->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Refuser le congé</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Motif du refus <span class="text-danger">*</span></label>
                            <textarea name="motif_refus" class="form-control" rows="3" required placeholder="Expliquez la raison du refus..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Confirmer le refus</button>
                    </div>
                </form>
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
<?php /**PATH C:\gestionstagiaires\resources\views/manager/conge/show.blade.php ENDPATH**/ ?>