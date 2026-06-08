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
                        <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i> Détail du déplacement</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong>Employé :</strong> <?php echo e($deplacement->user->name); ?><br>
                            <strong>Email :</strong> <?php echo e($deplacement->user->email); ?>

                        </div>

                        <table class="table table-bordered">
                            <tr>
                                <th>Dates</th>
                                <td><?php echo e(\Carbon\Carbon::parse($deplacement->date_debut)->format('d/m/Y')); ?> → <?php echo e(\Carbon\Carbon::parse($deplacement->date_fin)->format('d/m/Y')); ?></td>
                            </tr>
                            <tr>
                                <th>Lieu</th>
                                <td><?php echo e($deplacement->lieu); ?></td>
                            </tr>
                            <tr>
                                <th>Client</th>
                                <td><?php echo e($deplacement->client ?? 'Non spécifié'); ?></td>
                            </tr>
                            <tr>
                                <th>Motif</th>
                                <td><?php echo e($deplacement->motif ?? 'Non spécifié'); ?></td>
                            </tr>
                            <tr>
                                <th>Frais estimés</th>
                                <td>
                                    Transport: <?php echo e(number_format($deplacement->frais_transport, 2)); ?> DH<br>
                                    Hébergement: <?php echo e(number_format($deplacement->frais_hebergement, 2)); ?> DH<br>
                                    Repas: <?php echo e(number_format($deplacement->frais_repas, 2)); ?> DH<br>
                                    <strong>Total: <?php echo e(number_format($deplacement->frais_total, 2)); ?> DH</strong>
                                 </td>
                            </tr>
                        前</table>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?php echo e(route('manager.deplacement.index')); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <div>
                                <form method="POST" action="<?php echo e(route('manager.deplacement.accepter', $deplacement->id)); ?>" style="display: inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Accepter ce déplacement ?')">
                                        <i class="fas fa-check-circle"></i> Accepter
                                    </button>
                                </form>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalRefus">
                                    <i class="fas fa-times-circle"></i> Refuser
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Refus -->
    <div class="modal fade" id="modalRefus" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('manager.deplacement.refuser', $deplacement->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Refuser le déplacement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Motif du refus <span class="text-danger">*</span></label>
                            <textarea name="motif_refus" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Confirmer</button>
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
<?php /**PATH C:\gestionstagiaires\resources\views/manager/deplacement/show.blade.php ENDPATH**/ ?>