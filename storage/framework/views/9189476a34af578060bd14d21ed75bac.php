

<?php $__env->startSection('title', 'Contact Us'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Contact Us</h1>
    <p>If you have any questions, feel free to reach out!</p>
    <form>
        <div class="mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter your name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Your Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Your Message</label>
            <textarea class="form-control" id="message" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\komputer\Desktop\php\Projekt\Projekt\resources\views/contact.blade.php ENDPATH**/ ?>