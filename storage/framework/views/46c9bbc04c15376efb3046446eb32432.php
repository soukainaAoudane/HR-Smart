
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
    <?php
        $groupes=$competences->groupBy('categorie');
    ?>
    <form action="<?php echo e(route('employe.competences.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php $__currentLoopData = $groupes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie=>$comps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
           
            <div class="card mb-3 rounded-4">
                <div class="card-body"><h1 class="p-1 rounded-4 bg-info"><?php echo e($categorie); ?></h1>
                    <?php $__currentLoopData = $comps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php
                $niveauActuel=$mesNiveaux[$competence->id]??0;
            ?>
                    <label  class="fw-bold"><?php echo e($competence->nom); ?></label>
                    <select name="competences[<?php echo e($competence->id); ?>]" class="form-select mt-2">
                        <option value="0">Selection votre niveau</option>
                        <option value="1" <?php echo e($niveauActuel == 1?'selected':''); ?>> Notion</option>
                        <option value="2" <?php echo e($niveauActuel == 2?'selected':''); ?>> debitant</option>
                        <option value="3" <?php echo e($niveauActuel == 3?'selected':''); ?>> intermediare</option>
                        <option value="4" <?php echo e($niveauActuel == 4?'selected':''); ?>> avance</option>
                        <option value="5" <?php echo e($niveauActuel == 5?'selected':''); ?>> expert</option>
                    </select>
                
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <input class="bg-primary" type="submit" name="" id=""/>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\gestionstagiaires\resources\views/employe/competences.blade.php ENDPATH**/ ?>