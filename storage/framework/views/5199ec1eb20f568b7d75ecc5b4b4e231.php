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
            <div class="card-header text-white rounded-top-4" style="background: #1e3a5f;">
                <h4 class="mb-0 fw-bold">Détail du projet - <?php echo e($projet->nom); ?></h4>
            </div>
            <div class="card-body p-4">

                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background: #e8f0fe;">
                            <small class="text-muted">Description</small>
                            <p class="mb-0"><?php echo e($projet->description ?: 'Aucune description'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 rounded-3" style="background: #e8f0fe;">
                            <small class="text-muted">Période</small>
                            <p class="mb-0"><?php echo e(\Carbon\Carbon::parse($projet->date_debut)->format('d/m/Y')); ?>

                                <?php if($projet->date_fin): ?> → <?php echo e(\Carbon\Carbon::parse($projet->date_fin)->format('d/m/Y')); ?> <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 rounded-3" style="background: #e8f0fe;">
                            <small class="text-muted">Budget</small>
                            <p class="mb-0"><?php echo e(number_format($projet->budget_previsionnel, 2)); ?> DH</p>
                            <?php if($projet->budget_reel > 0): ?>
                                <small class="text-muted">Réel: <?php echo e(number_format($projet->budget_reel, 2)); ?> DH</small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <strong>Avancement du projet</strong>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Progression</span>
                            <span class="fw-bold"><?php echo e($projet->avancement); ?>%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" style="width: <?php echo e($projet->avancement); ?>%"></div>
                        </div>
                    </div>
                </div>

                
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <strong>Équipe projet</strong>
                    </div>
                    <div class="card-body">
                        <?php if($projet->employes->count() > 0): ?>
                            <div class="d-flex flex-wrap gap-2">
                                <?php $__currentLoopData = $projet->employes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge rounded-pill px-3 py-2" style="background: #1e3a5f;">
                                        <?php echo e($employe->name); ?>

                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">Aucun membre dans l'équipe</p>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="card mb-4">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <strong>Tâches du projet</strong>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjoutTache">
                            <i class="fas fa-plus"></i> Ajouter une tâche
                        </button>
                    </div>
                    <div class="card-body">
                        <?php if($taches->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Assigné à</th>
                                            <th>Deadline</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $taches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tache): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($tache->titre); ?></td>
                                            <td><?php echo e($tache->assigne->name); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($tache->deadline)->format('d/m/Y')); ?></td>
                                            <td>
                                                <?php if($tache->statut == 'todo'): ?> <span class="badge bg-warning">À faire</span>
                                                <?php elseif($tache->statut == 'doing'): ?> <span class="badge bg-info">En cours</span>
                                                <?php else: ?> <span class="badge bg-success">Terminée</span> <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">Aucune tâche pour ce projet</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('manager.projet.index')); ?>" class="btn btn-outline-secondary rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i> Retour
                    </a>
                    <a href="<?php echo e(route('manager.projet.edit', $projet->id)); ?>" class="btn rounded-pill px-4" style="background: #1e3a5f; color: white;">
                        <i class="fas fa-edit me-2"></i> Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalAjoutTache" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo e(route('manager.projet.addTache', $projet->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header" style="background: #1e3a5f; color: white;">
                        <h5 class="modal-title">Ajouter une tâche</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Assigner à</label>
                            <select name="assignee_a" class="form-select" required>
                                <option value="">Sélectionner</option>
                                <?php $__currentLoopData = $projet->employes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($employe->id); ?>"><?php echo e($employe->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Durée (jours)</label>
                                    <input type="number" name="duree_estimee" class="form-control" min="1" value="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Deadline</label>
                                    <input type="date" name="deadline" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn" style="background: #1e3a5f; color: white;">Ajouter</button>
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
<?php /**PATH C:\gestionstagiaires\resources\views/manager/projet/show.blade.php ENDPATH**/ ?>