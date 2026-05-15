<?php $__env->startSection('title', 'Gestion des managers'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-users text-primary me-2"></i>
                Gestion des managers
            </h1>
            <a href="<?php echo e(route('admin.managers.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Nouveau manager
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Employés</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($manager->name); ?></td>
                                    <td><?php echo e($manager->email); ?></td>
                                    <td>
                                        <span class="badge bg-info">
                                            <?php echo e($manager->employes()->count()); ?> employé(s)
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.managers.edit', $manager->id)); ?>"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>
                                        <form action="<?php echo e(route('admin.managers.destroy', $manager->id)); ?>" method="POST"
                                            class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Êtes-vous sûr ?')">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php echo e($managers->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\gestionstagiaires\resources\views/admin/managers/index.blade.php ENDPATH**/ ?>