

<?php $__env->startSection('title', $product->name); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="my-4"><?php echo e($product->name); ?></h1>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Description:</strong> <?php echo e($product->description); ?></p>
            <p><strong>Price:</strong> <?php echo e($product->price); ?></p>
            <p><strong>Stock:</strong> <?php echo e($product->stock); ?></p>
        </div>
    </div>

    <form action="<?php echo e(route('products.buy', $product->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success">Buy Now</button>
                    </form>

                    <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\komputer\Desktop\php\Projekt\Projekt\resources\views/shop/products/show.blade.php ENDPATH**/ ?>