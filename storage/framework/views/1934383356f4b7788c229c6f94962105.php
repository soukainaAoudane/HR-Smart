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
                <h4 class="mb-0 fw-bold">✏️ Validation des compétences - <?php echo e($employe->name); ?></h4>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead style="background-color: #e8f0fe;">
                            <tr>
                                <th>Compétence</th>
                                <th>Niveau proposé</th>
                                <th>Niveau validé</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $competences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($competence->nom); ?></strong></td>
                                <td><?php echo e($competence->pivot->niveau); ?> / 5</td>
                                <td>
                                    <form action="<?php echo e(route('manager.competences.refuser', [$employe->id, $competence->id])); ?>" 
                                          method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <select name="niveau" class="form-select form-select-sm" style="width: auto; display: inline-block;">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <option value="<?php echo e($i); ?>" <?php echo e($competence->pivot->niveau == $i ? 'selected' : ''); ?>>
                                                    <?php echo e($i); ?>

                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-warning rounded-pill">
                                            <i class="fas fa-edit me-1"></i> Modifier
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <?php if($competence->pivot->validee): ?>
                                        <span class="badge rounded-pill" style="background: #198754;">
                                            <i class="fas fa-check-circle me-1"></i> Validée
                                        </span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill" style="background: #ffc107; color: #000;">
                                            <i class="fas fa-clock me-1"></i> En attente
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!$competence->pivot->validee): ?>
                                        <form action="<?php echo e(route('manager.competences.valider', [$employe->id, $competence->id])); ?>" 
                                              method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm rounded-pill px-3" style="background: #1e3a5f; color: white;">
                                                <i class="fas fa-check me-1"></i> Valider
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-success">✓</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    <a href="<?php echo e(route('manager.competences.index')); ?>" class="btn btn-outline-secondary rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i> Retour
                    </a>
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
<?php endif; ?><?php /**PATH C:\gestionstagiaires\resources\views/manager/competences/show.blade.php ENDPATH**/ ?>