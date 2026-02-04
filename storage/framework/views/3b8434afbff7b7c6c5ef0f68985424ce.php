<?php $__env->startSection('title', 'Edit Sale'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-neutral-100 to-neutral-50 py-10">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-neutral-100">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-700 to-primary-800 text-white p-8 md:p-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-primary-600/70 text-white text-xl">
                            <i class="fas fa-edit"></i>
                        </span>
                        <h1 class="text-3xl font-bold">Edit Sale</h1>
                    </div>
                    <p class="text-primary-100 text-sm md:text-base">
                        Update sale details for transaction #<?php echo e($sale->id); ?>

                    </p>
                </div>
                <div class="flex gap-2 flex-wrap justify-end">
                    <a href="<?php echo e(route('sales.show', $sale)); ?>" class="inline-flex items-center px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-sm font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Sale
                    </a>
                </div>
            </div>

            <!-- Form -->
            <div class="p-8">
                <?php if($errors->any()): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded mb-6">
                        <strong>There were some problems with your input.</strong>
                        <ul class="mt-2 text-sm list-disc list-inside">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('sales.update', $sale)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <!-- Read-only Sale Information -->
                    <div class="bg-neutral-50 rounded-lg p-6 mb-6 border border-neutral-200">
                        <h3 class="text-lg font-semibold text-neutral-900 mb-4">Sale Information (Read-Only)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-neutral-700 mb-2">Transaction ID</label>
                                <p class="text-neutral-900 font-semibold"><?php echo e($sale->id); ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-neutral-700 mb-2">Sale Date</label>
                                <p class="text-neutral-900 font-semibold"><?php echo e($sale->sale_date->format('d M Y, H:i')); ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-neutral-700 mb-2">Artisan</label>
                                <p class="text-neutral-900 font-semibold"><?php echo e($sale->artisan->name); ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-neutral-700 mb-2">Customer</label>
                                <p class="text-neutral-900 font-semibold"><?php echo e($sale->customer->name); ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-neutral-700 mb-2">Product</label>
                                <p class="text-neutral-900 font-semibold"><?php echo e($sale->product->name); ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-neutral-700 mb-2">Quantity</label>
                                <p class="text-neutral-900 font-semibold"><?php echo e($sale->quantity); ?> unit<?php echo e($sale->quantity > 1 ? 's' : ''); ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-neutral-700 mb-2">Unit Price</label>
                                <p class="text-neutral-900 font-semibold">RM <?php echo e(number_format($sale->unit_price, 2)); ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-neutral-700 mb-2">Total Amount</label>
                                <p class="text-neutral-900 font-bold text-lg">RM <?php echo e(number_format($sale->total_price, 2)); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Editable Fields -->
                    <div class="space-y-6 mb-6">
                        <div>
                            <label for="payment_status" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-wallet text-primary-600 mr-2"></i>Payment Status *
                            </label>
                            <select id="payment_status" name="payment_status" required
                                    class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none text-neutral-900 text-sm <?php $__errorArgs = ['payment_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="pending" <?php echo e(old('payment_status', $sale->payment_status) === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="paid" <?php echo e(old('payment_status', $sale->payment_status) === 'paid' ? 'selected' : ''); ?>>Paid</option>
                                <option value="failed" <?php echo e(old('payment_status', $sale->payment_status) === 'failed' ? 'selected' : ''); ?>>Failed</option>
                            </select>
                            <?php $__errorArgs = ['payment_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-600 text-sm mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?>

                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-sticky-note text-primary-600 mr-2"></i>Notes (optional)
                            </label>
                            <textarea id="notes" name="notes" rows="4"
                                      class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none text-neutral-900 text-sm <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('notes', $sale->notes)); ?></textarea>
                            <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-600 text-sm mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?>

                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col md:flex-row gap-4 mb-2">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                        <a href="<?php echo e(route('sales.show', $sale)); ?>" class="flex-1 bg-neutral-300 hover:bg-neutral-400 text-neutral-800 font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/sales/edit.blade.php ENDPATH**/ ?>