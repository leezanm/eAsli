<?php $__env->startSection('title', 'Customer Login'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-primary-700 via-primary-600 to-secondary-600 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-neutral-0 rounded-2xl shadow-2xl overflow-hidden transform hover:shadow-3xl transition duration-300">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-700 to-primary-800 text-white p-10 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 text-primary-600 opacity-10" style="font-size: 8rem;">
                    <i class="fas fa-user"></i>
                </div>
                <i class="fas fa-shopping-bag text-5xl mb-4 relative z-10 text-accent-400"></i>
                <h1 class="text-4xl font-bold mt-4">Customer Login</h1>
                <p class="text-primary-100 mt-2 font-semibold">Access your purchases and profile</p>
            </div>

            <!-- Form -->
            <div class="p-10">
                <?php if($errors->any()): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-red-600 mr-3 mt-1"></i>
                            <div>
                                <strong class="block text-lg">Login Failed</strong>
                                <ul class="mt-2 text-sm">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="flex items-center"><i class="fas fa-times mr-2"></i><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('customers.authenticate')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                            <i class="fas fa-envelope text-primary-600 mr-2"></i>Email Address
                        </label>
                        <input type="email" name="email" id="email"
                               class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="customer@example.com"
                               value="<?php echo e(old('email')); ?>"
                               autofocus>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-8">
                        <label for="password" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                            <i class="fas fa-lock text-primary-600 mr-2"></i>Password
                        </label>
                        <input type="password" name="password" id="password"
                               class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="••••••••••••">
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login as Customer
                    </button>
                </form>

                <!-- Sign Up for New Customer -->
                <div class="mt-6 pb-6 border-b border-neutral-200">
                    <p class="text-center text-neutral-700 text-sm mb-3 font-medium">New to eAsli?</p>
                    <a href="<?php echo e(route('customers.create')); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-bold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition transform hover:scale-105 duration-300 uppercase tracking-wide">
                        <i class="fas fa-user-plus"></i>Create New Account
                    </a>
                </div>

                <!-- Back to Home -->
                <div class="mt-6 text-center">
                    <a href="<?php echo e(route('home')); ?>" class="text-primary-700 hover:text-primary-800 font-semibold flex items-center justify-center gap-2">
                        <i class="fas fa-arrow-left"></i> Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/customers/login.blade.php ENDPATH**/ ?>