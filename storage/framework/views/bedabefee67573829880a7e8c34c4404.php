

<?php $__env->startSection('title', 'Thank You'); ?>

<?php $__env->startSection('content'); ?>
<div class="text-center mt-5">
    <h1 class="display-4">Thank You for Your Purchase!</h1>
    <p class="lead">Your order has been successfully placed.</p>

    <h3>Order Details:</h3>
    <ul class="list-group mt-4">
        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item">
                <?php echo e($item->product->name); ?> - $<?php echo e($item->price); ?> x <?php echo e($item->quantity); ?>

            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <p class="mt-4"><strong>Total Price:</strong> $<?php echo e($order->total_price); ?></p>

    <a href="<?php echo e(route('home')); ?>" class="btn btn-primary btn-lg mt-4">Back to Home</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\komputer\Desktop\php\Projekt\Projekt\resources\views/thankyou.blade.php ENDPATH**/ ?>