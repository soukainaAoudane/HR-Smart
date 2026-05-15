<?php $__env->startSection('title', 'Mon profil'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">


        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($error); ?><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">

            
            <div class="col-lg-6">

                
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-user-circle text-primary me-2"></i>
                            Informations personnelles
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo e(route('employe.profil.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nom complet</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input type="text" name="name"
                                        class="form-control border-start-0 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('name', $user->name)); ?>" required>
                                </div>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Adresse email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email" name="email"
                                        class="form-control border-start-0 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('email', $user->email)); ?>" required>
                                </div>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Poste</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-briefcase text-muted"></i>
                                    </span>
                                    <input disabled type="text" name="poste" class="form-control border-start-0"
                                        value="<?php echo e(old('poste', $user->poste)); ?>">
                                </div>
                            </div>





                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary rounded-pill py-2 fw-semibold">
                                    <i class="fas fa-save me-2"></i> Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            
            <div class="col-lg-6">

                
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-chart-pie text-success me-2"></i>
                            Récapitulatif
                        </h5>
                    </div>
                    <div class="card-body p-4">

                        <div class="row g-3">
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <i class="fas fa-calendar-alt fa-2x text-primary mb-2"></i>
                                    <p class="text-muted small mb-0">Solde de congés</p>
                                    <h3 class="mb-0 fw-bold"><?php echo e($user->conges_restants ?? 0); ?></h3>
                                    <small>jours restants</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                    <p class="text-muted small mb-0">En attente</p>
                                    <h3 class="mb-0 fw-bold"><?php echo e($user->congesEnAttente()->count() ?? 0); ?></h3>
                                    <small>demandes</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                    <p class="text-muted small mb-0">Approuvés</p>
                                    <h3 class="mb-0 fw-bold"><?php echo e($user->congesApprouves()->count() ?? 0); ?></h3>
                                    <small>congés validés</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <i class="fas fa-chart-line fa-2x text-info mb-2"></i>
                                    <p class="text-muted small mb-0">Charge</p>
                                    <h3 class="mb-0 fw-bold"><?php echo e($user->charge_actuelle ?? 0); ?>%</h3>
                                    <small>travail</small>
                                </div>
                            </div>
                        </div>

                        <?php if($user->isManager()): ?>
                            <hr class="my-4">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                        <p class="mb-0 fw-semibold">Équipe</p>
                                        <h4 class="mb-0"><?php echo e($user->employes()->count() ?? 0); ?> employés</h4>
                                    </div>
                                    <a href="<?php echo e(route('manager.conges.index')); ?>"
                                        class="btn btn-sm btn-primary rounded-pill">
                                        <i class="fas fa-calendar-check me-1"></i> Valider les congés
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-info-circle text-secondary me-2"></i>
                            Informations complémentaires
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-borderless">
                            <tr>
                                <td class="ps-0 text-muted" style="width: 120px;">Rôle :</td>
                                <td class="fw-semibold">
                                    <span class="badge bg-primary rounded-pill"><?php echo e(ucfirst($user->role)); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-0 text-muted">Manager :</td>
                                <td class="fw-semibold">
                                    <?php if($manager): ?>
                                        <?php echo e($manager->name?? 'Non assigné'); ?>

                                    <?php else: ?>
                                        <span class="text-muted">Aucun manager</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-0 text-muted">Date d'inscription :</td>
                                <td class="fw-semibold"><?php echo e($user->created_at->format('d/m/Y')); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gestionstagiaires\resources\views/employe/profil.blade.php ENDPATH**/ ?>