<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>X-Bakery</title>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('/favicon.ico')); ?>" />
    <link href="<?php echo e(asset('css/bootstrap.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/animate.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/fontawesome.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/toastify.min.css')); ?>" rel="stylesheet" />
    <script src="<?php echo e(asset('js/toastify-js.js')); ?>"></script>
    <script src="<?php echo e(asset('js/axios.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/config.js')); ?>"></script>
</head>

<body>


<div id="loader" class="LoadingOverlay d-none">
<div class="Line-Progress">
    <div class="indeterminate"></div>
</div>
</div>


<div>
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script>

</script>

<script src="<?php echo e(asset('js/bootstrap.bundle.js')); ?>"></script>

</body>
</html>
<?php /**PATH D:\Laravel\Laravel Laptop\0 modules\0 Mega Project (m14 - m18)\POS\resources\views/layout/app.blade.php ENDPATH**/ ?>