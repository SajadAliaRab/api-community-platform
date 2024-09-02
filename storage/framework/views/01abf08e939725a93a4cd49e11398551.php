
    <?php if (isset($component)) { $__componentOriginal9b945b32438afb742355861768089b04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9b945b32438afb742355861768089b04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.card','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <div class="space-y-4">
            <div>
                <strong>Username:</strong> <?php echo e($user->userName); ?>

            </div>
            <div>
                <strong>Full Name:</strong> <?php echo e($user->fName); ?> <?php echo e($user->lName); ?>

            </div>
            <div>
                <strong>Email:</strong> <?php echo e($user->email); ?>

            </div>
            <div>
                <strong>Type:</strong> <?php echo e(ucfirst($user->type)); ?>

            </div>
            <!--[if BLOCK]><![endif]--><?php if($user->user_detail): ?>
                <div>
                    <strong>Tagline:</strong> <?php echo e($user->user_detail->tagline); ?>

                </div>
                <div>
                    <strong>Title:</strong> <?php echo e($user->user_detail->title); ?>

                </div>
                <div>
                    <strong>Website:</strong> <?php echo e($user->user_detail->website); ?>

                </div>
                <div>
                    <strong>Mobile:</strong> <?php echo e($user->user_detail->mobile); ?>

                </div>
                <div>
                    <strong>Points:</strong> <?php echo e($user->user_detail->point); ?>

                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9b945b32438afb742355861768089b04)): ?>
<?php $attributes = $__attributesOriginal9b945b32438afb742355861768089b04; ?>
<?php unset($__attributesOriginal9b945b32438afb742355861768089b04); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9b945b32438afb742355861768089b04)): ?>
<?php $component = $__componentOriginal9b945b32438afb742355861768089b04; ?>
<?php unset($__componentOriginal9b945b32438afb742355861768089b04); ?>
<?php endif; ?>
<?php /**PATH /home/sajad/Laravel/API-Community-Platform/resources/views/filament/pages/user-detail-page.blade.php ENDPATH**/ ?>