<?php $__env->startSection('title', 'Artisans'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gradient-to-br from-neutral-100 to-neutral-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-primary-800 flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-700">
                        <i class="fas fa-users"></i>
                    </span>
                    Artisans
                </h1>
                <p class="mt-2 text-neutral-600">
                    Manage all registered artisans in the eAsli marketplace.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="inline-flex items-center px-4 py-2 rounded-lg border border-neutral-300 text-neutral-700 hover:bg-neutral-100 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Admin Dashboard
                </a>
                <a href="<?php echo e(route('artisans.create')); ?>" class="inline-flex items-center px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold shadow">
                    <i class="fas fa-user-plus mr-2"></i>
                    Add New Artisan
                </a>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="mb-6 p-4 rounded-lg border-l-4 border-emerald-500 bg-emerald-50 text-emerald-800 flex items-start">
                <i class="fas fa-check-circle mt-1 mr-3"></i>
                <p class="font-medium"><?php echo e(session('success')); ?></p>
            </div>
        <?php endif; ?>

        <!-- Summary card -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-xl shadow-sm border border-neutral-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold tracking-wide text-neutral-500 uppercase">Total Artisans</p>
                    <p class="mt-2 text-2xl font-bold text-primary-800"><?php echo e($artisans->count()); ?></p>
                </div>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-50 text-primary-600">
                    <i class="fas fa-user-tie"></i>
                </span>
            </div>
        </div>

        <?php if($artisans->isEmpty()): ?>
            <div class="bg-white rounded-2xl shadow-sm border border-dashed border-neutral-300 p-10 text-center">
                <div class="mx-auto mb-4 flex items-center justify-center w-14 h-14 rounded-full bg-neutral-100 text-neutral-500">
                    <i class="fas fa-user-slash text-xl"></i>
                </div>
                <h2 class="text-lg font-semibold text-neutral-800 mb-2">No artisans found</h2>
                <p class="text-sm text-neutral-600 mb-4">Get started by adding your first artisan profile.</p>
                <a href="<?php echo e(route('artisans.create')); ?>" class="inline-flex items-center px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold">
                    <i class="fas fa-user-plus mr-2"></i>
                    Add Artisan
                </a>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-200 text-sm">
                        <thead class="bg-neutral-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Name</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Email</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Phone</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Status</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-neutral-600 uppercase tracking-wide">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100">
                            <?php $__currentLoopData = $artisans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artisan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-neutral-50/70">
                                    <td class="px-4 py-3 align-top">
                                        <div class="font-semibold text-neutral-900"><?php echo e($artisan->name); ?></div>
                                        <?php if($artisan->address): ?>
                                            <div class="text-xs text-neutral-500 mt-0.5 truncate max-w-xs"><?php echo e($artisan->address); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 align-top text-neutral-800"><?php echo e($artisan->email); ?></td>
                                    <td class="px-4 py-3 align-top text-neutral-800"><?php echo e($artisan->phone); ?></td>
                                    <td class="px-4 py-3 align-top">
                                        <?php
                                            $status = $artisan->status ?? 'inactive';
                                            $statusLabel = $status === 'active' ? 'Active' : 'Pending approval';
                                        ?>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                            <?php echo e($status === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-amber-50 text-amber-700 border border-amber-100'); ?>">
                                            <span class="w-1.5 h-1.5 rounded-full mr-1.5 <?php echo e($status === 'active' ? 'bg-emerald-500' : 'bg-amber-400'); ?>"></span>
                                            <?php echo e($statusLabel); ?>

                                        </span>
                                    </td>
                                    <td class="px-4 py-3 align-top text-right whitespace-nowrap">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="<?php echo e(route('artisans.show', $artisan)); ?>" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-neutral-200 text-xs font-semibold text-neutral-700 hover:bg-neutral-50">
                                                <i class="fas fa-eye mr-1.5"></i> View
                                            </a>
                                            <a href="<?php echo e(route('artisans.edit', $artisan)); ?>" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-primary-200 text-xs font-semibold text-primary-700 bg-primary-50 hover:bg-primary-100">
                                                <i class="fas fa-edit mr-1.5"></i> Edit
                                            </a>
                                            <form action="<?php echo e(route('artisans.destroy', $artisan)); ?>" method="POST" class="inline-flex" onsubmit="return confirm('Are you sure you want to delete this artisan?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-red-200 text-xs font-semibold text-red-700 bg-red-50 hover:bg-red-100">
                                                    <i class="fas fa-trash mr-1.5"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/artisans/index.blade.php ENDPATH**/ ?>