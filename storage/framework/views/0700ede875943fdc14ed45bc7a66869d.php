<?php $__env->startSection('title', 'Mes congés'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-calendar-alt text-primary me-2"></i>
                Mes demandes de congés
            </h1>
            <a href="<?php echo e(route('employe.conge.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Nouvelle demande
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if($conges->isEmpty()): ?>
            <div class="card text-center">
                <div class="card-body py-5">
                    <i class="fas fa-calendar-day fa-4x text-muted mb-3"></i>
                    <h4>Aucune demande de congé</h4>
                    <p class="text-muted">Vous n'avez pas encore fait de demande de congé.</p>
                    <a href="<?php echo e(route('employe.conge.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> Faire une demande
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if(auth()->user()->isManager()): ?>
                                            <th>Employé</th>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <th>Période</th>
                                    <th>Type</th>
                                    <th>Motif</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $conges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(auth()->user()->isManager()): ?>
                                                <td><?php echo e($conge->user->name); ?></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <td>
                                            <?php echo e($conge->date_debut->format('d/m/Y')); ?> -
                                            <?php echo e($conge->date_fin->format('d/m/Y')); ?>

                                            <br>
                                            <small
                                                class="text-muted"><?php echo e($conge->date_debut->diffInDays($conge->date_fin) + 1); ?>

                                                jours</small>
                                        </td>
                                        <td>
                                            <?php switch($conge->type):
                                                case ('cp'): ?>
                                                    <span class="badge bg-info">Congés payés</span>
                                                <?php break; ?>

                                                <?php case ('rtt'): ?>
                                                    <span class="badge bg-success">RTT</span>
                                                <?php break; ?>

                                                <?php case ('sans_solde'): ?>
                                                    <span class="badge bg-warning">Sans solde</span>
                                                <?php break; ?>

                                                <?php case ('maladie'): ?>
                                                    <span class="badge bg-danger">Maladie</span>
                                                <?php break; ?>

                                                <?php default: ?>
                                                    <span class="badge bg-secondary"><?php echo e($conge->type); ?></span>
                                            <?php endswitch; ?>
                                        </td>
                                        <td><?php echo e($conge->motif); ?></td>
                                        <td>
                                            <?php switch($conge->statut):
                                                case ('en_attente'): ?>
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-clock me-1"></i> En attente
                                                    </span>
                                                <?php break; ?>

                                                <?php case ('pending'): ?>
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-clock me-1"></i> En attente
                                                    </span>
                                                <?php break; ?>

                                                <?php case ('valide'): ?>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i> Validé
                                                    </span>
                                                <?php break; ?>

                                                <?php case ('approved'): ?>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i> Approuvé
                                                    </span>
                                                <?php break; ?>

                                                <?php case ('refuse'): ?>
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times me-1"></i> Refusé
                                                    </span>
                                                <?php break; ?>

                                                <?php case ('rejected'): ?>
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times me-1"></i> Refusé
                                                    </span>
                                                <?php break; ?>

                                                <?php default: ?>
                                                    <span class="badge bg-secondary"><?php echo e($conge->statut); ?></span>
                                            <?php endswitch; ?>
                                        </td>
                                        <td>
                                            <?php if(auth()->guard()->check()): ?>
                                                <?php if(auth()->user()->isManager() && $conge->statut == 'pending'): ?>
                                                    <form action="<?php echo e(route('manager.conges.accepter', $conge->id)); ?>"
                                                        method="POST" class="d-inline me-2">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="fas fa-check"></i> Accepter
                                                        </button>
                                                    </form>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#refuseModal<?php echo e($conge->id); ?>">
                                                        <i class="fas fa-times"></i> Refuser
                                                    </button>

                                                    <!-- Modal de refus -->
                                                    <div class="modal fade" id="refuseModal<?php echo e($conge->id); ?>" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Refuser la demande de congé</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <form
                                                                    action="<?php echo e(route('manager.conges.refuser', $conge->id)); ?>"
                                                                    method="POST">
                                                                    <?php echo csrf_field(); ?>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="motif" class="form-label">Motif du
                                                                                refus</label>
                                                                            <textarea class="form-control" id="motif" name="motif" rows="3" required></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Annuler</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Refuser</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php elseif(auth()->user()->isEmploye() && $conge->statut == 'pending'): ?>
                                                    <form action="<?php echo e(route('employe.conge.annuler', $conge->id)); ?>"
                                                        method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Annuler cette demande ?')">
                                                            <i class="fas fa-trash"></i> Annuler
                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gestionstagiaires\resources\views/employe/conge/index.blade.php ENDPATH**/ ?>