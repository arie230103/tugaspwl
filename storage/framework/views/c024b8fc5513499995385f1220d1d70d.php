<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ARIESHOP</title>

    <link rel="icon" href="<?php echo e(asset('assets/img/coffee-shop.png')); ?>" type="image/x-icon" />

    <?php echo $__env->make('store.components.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <?php echo $__env->make('store.components.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('store.components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('store.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php echo $__env->make('store.components.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('js'); ?>

    <script>
        $(document).ready(() => {
            $('#loginBtn').on('click', () => {
                window.location.href = $("#login").attr('href');
            });

            $('#registerBtn').on('click', () => {
                window.location.href = $("#register").attr('href');
            });
        });
    </script>
</body>
</html>
<?php /**PATH /home/manusiacoding/Documents/faw-development/project/arie-shop/resources/views/store/layouts/store.blade.php ENDPATH**/ ?>