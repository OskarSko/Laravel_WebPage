

<?php $__env->startSection('title', 'Shopping Cart'); ?>

<?php $__env->startSection('content'); ?>
<h1>Your Shopping Cart</h1>

<!-- Sprawdzanie, czy koszyk nie jest pusty -->
<?php if($cartItems->isEmpty()): ?>
    <p>Your cart is empty!</p>
    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">Continue Shopping</a>
<?php else: ?>
    <!-- Tabela produktów w koszyku -->
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->product->name); ?></td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td>$<?php echo e($item->product->price); ?></td>
                    <td>$<?php echo e($item->product->price * $item->quantity); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- Suma całkowita koszyka -->
    <p><strong>Total Price:</strong> $<?php echo e($cartItems->sum(fn($item) => $item->product->price * $item->quantity)); ?></p>

    <!-- Przycisk Checkout -->
    <form action="<?php echo e(route('cart.checkout')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-success">Checkout</button>
    </form>

    <!-- Link powrotu do sklepu -->
    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary mt-3">Continue Shopping</a>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\komputer\Desktop\php\Projekt\Projekt\resources\views/cart/index.blade.php ENDPATH**/ ?>