<?php $__env->startSection('content'); ?>
    <welcome-page></welcome-page>


    <?php if(auth()->guard()->check()): ?>
        <services-component></services-component>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eshen\Desktop\Github\dental_care\resources\views/welcome.blade.php ENDPATH**/ ?>