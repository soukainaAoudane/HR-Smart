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
            <div class="card-header text-white rounded-top-4" style="background: #1e3a5f; border-bottom: none;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-tasks fs-4 me-3"></i>
                    <h4 class="mb-0 fw-bold">Mes tâches</h4>
                </div>
            </div>
            <div class="card-body p-4">
                <?php if($taches->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead style="background-color: #e8f0fe;">
                                <tr>
                                    <th>Titre</th>
                                    <th>Deadline</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $taches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tache): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><strong><?php echo e($tache->titre); ?></strong><br>
                                            <small
                                                class="text-muted"><?php echo e($tache->description ?? 'Pas de description'); ?></small>
                                        </td>
                                        <td>
                                            <span
                                                class="small <?php echo e($tache->est_en_retard ? 'text-danger fw-bold' : ''); ?>">
                                                <?php echo e(Carbon\Carbon::parse($tache->deadline)->format('d/m/Y')); ?>

                                                <?php if($tache->est_en_retard): ?>
                                                    <i class="fas fa-exclamation-triangle ms-1"></i>
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if($tache->statut == 'todo'): ?>
                                                <span class="badge rounded-pill px-3 py-2"
                                                    style="background: #ffc107; color: #000;">À faire</span>
                                            <?php elseif($tache->statut == 'doing'): ?>
                                                <span class="badge rounded-pill px-3 py-2"
                                                    style="background: #0dcaf0;">En cours</span>
                                            <?php else: ?>
                                                <span class="badge rounded-pill px-3 py-2"
                                                    style="background: #198754;">Terminée</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($tache->statut != 'done'): ?>
                                                <form action="<?php echo e(route('employe.tache.update', $tache->id)); ?>"
                                                    method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <select name="statut" class="form-select form-select-sm"
                                                        onchange="this.form.submit()"
                                                        style="width: auto; display: inline-block;">
                                                        <option value="todo"
                                                            <?php echo e($tache->statut == 'todo' ? 'selected' : ''); ?>>À faire
                                                        </option>
                                                        <option value="doing"
                                                            <?php echo e($tache->statut == 'doing' ? 'selected' : ''); ?>>En
                                                            cours</option>
                                                        <option value="done"
                                                            <?php echo e($tache->statut == 'done' ? 'selected' : ''); ?>>Terminée
                                                        </option>
                                                    </select>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-success">Terminée le
                                                    <?php echo e(Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y')); ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <p class="text-muted">Aucune tâche assignée</p>
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
<?php /**PATH C:\gestionstagiaires\resources\views/employe/tache/index.blade.php ENDPATH**/ ?>