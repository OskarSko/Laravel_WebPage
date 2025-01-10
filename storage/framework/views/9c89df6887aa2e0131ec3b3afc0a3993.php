<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Shop'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="<?php echo e(route('home')); ?>">Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('products.index')); ?>">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('about')); ?>">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('contact')); ?>">Contact</a></li>
                    </ul>
                    <ul class="navbar-nav">
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <a class="btn btn-outline-light me-2" href="<?php echo e(route('login')); ?>">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-warning" href="<?php echo e(route('register')); ?>">Register</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo e(Auth::user()->name); ?>

                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">Profile</a></li>
                                    <li>
                                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <main class="container my-4">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    <footer class="bg-dark text-white text-center py-3">
        &copy; <?php echo e(date('Y')); ?> Shop
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\komputer\Desktop\php\Projekt\Projekt\resources\views/layouts/app.blade.php ENDPATH**/ ?>