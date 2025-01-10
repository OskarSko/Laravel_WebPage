

<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <!-- Lista kategorii -->
        <div class="col-md-3">
            <h5>Categories</h5>
            <ul class="list-group">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                        <a href="<?php echo e(route('products.index', ['category' => $category->id])); ?>">
                            <?php echo e($category->name); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>

        <!-- Lista produktów -->
        <div class="col-md-9">
            <h1 class="my-4">Products</h1>

            <div class="row">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="card-title"><?php echo e($product->name); ?></h5>
                                    <p class="card-text"><?php echo e($product->description); ?></p>
                                    <p><strong>Price:</strong> $<?php echo e($product->price); ?></p>
                                    <p><strong>Stock:</strong> <?php echo e($product->stock); ?></p>
                                </div>
                                <div>
                                    <!-- Przycisk szczegółów -->
                                    <a href="<?php echo e(route('products.show', ['id' => $product->id])); ?>" class="btn btn-info mb-2">Details</a>

                                    <!-- Formularz zakupu -->
                                    <form action="<?php echo e(route('products.buy', ['product' => $product->id])); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-primary mb-2">Buy</button>
                                    </form>

                                    <!-- Formularz dodania do koszyka -->
                                    <form action="<?php echo e(route('cart.add', ['product' => $product->id])); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-secondary">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\komputer\Desktop\php\Projekt\Projekt\resources\views/shop/products/index.blade.php ENDPATH**/ ?>