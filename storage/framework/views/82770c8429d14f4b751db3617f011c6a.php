<?php $__env->startSection('title', isset($product) ? 'Edit Product' : 'Create Product'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-neutral-100 to-neutral-50 py-10">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-neutral-0 rounded-2xl shadow-2xl overflow-hidden border border-neutral-100">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-700 to-primary-800 text-white p-8 md:p-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-primary-600/70 text-white text-xl">
                            <i class="fas fa-box"></i>
                        </span>
                        <h1 class="text-3xl font-bold"><?php echo e(isset($product) ? 'Edit Product' : 'Create Product'); ?></h1>
                    </div>
                    <p class="text-primary-100 text-sm md:text-base">
                        <?php echo e(isset($product) ? 'Update product details, pricing, and stock.' : 'Add a new product to your catalog so customers can discover it.'); ?>

                    </p>
                </div>
                <div class="flex gap-2 flex-wrap justify-end">
                    <a href="<?php echo e(route('products.index')); ?>" class="inline-flex items-center px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-sm font-semibold">
                        <i class="fas fa-list mr-2"></i>
                        Back to Products
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

                <form method="POST" action="<?php echo e(isset($product) ? route('products.update', $product) : route('products.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php if(isset($product)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

                    <?php if(!isset($product) && auth('artisan')->check()): ?>
                        <input type="hidden" name="artisan_id" value="<?php echo e(auth('artisan')->id()); ?>">
                    <?php endif; ?>

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-tag text-primary-600 mr-2"></i>Product Name *
                        </label>
                        <input type="text" id="name" name="name"
                               class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('name', $product->name ?? '')); ?>" required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-align-left text-primary-600 mr-2"></i>Description
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description', $product->description ?? '')); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <p class="mt-1 text-xs text-neutral-500">Describe the product, materials, size, or special features.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="category" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-folder-open text-primary-600 mr-2"></i>Category *
                            </label>
                            <select id="category" name="category"
                                    class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required>
                                <?php ($currentCategory = old('category', $product->category ?? '')); ?>
                                <option value="" <?php echo e($currentCategory === '' ? 'selected' : ''); ?>>Select a category</option>
                                <option value="electronics" <?php echo e($currentCategory === 'electronics' ? 'selected' : ''); ?>>Electronics</option>
                                <option value="clothing" <?php echo e($currentCategory === 'clothing' ? 'selected' : ''); ?>>Clothing</option>
                                <option value="food" <?php echo e($currentCategory === 'food' ? 'selected' : ''); ?>>Food & Beverages</option>
                                <option value="crafts" <?php echo e($currentCategory === 'crafts' ? 'selected' : ''); ?>>Handmade Crafts</option>
                                <option value="furniture" <?php echo e($currentCategory === 'furniture' ? 'selected' : ''); ?>>Furniture</option>
                            </select>
                            <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-money-bill-wave text-primary-600 mr-2"></i>Price (RM) *
                            </label>
                            <input type="number" step="0.01" id="price" name="price"
                                   class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('price', $product->price ?? '')); ?>" required>
                            <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="stock" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-boxes-stacked text-primary-600 mr-2"></i>Stock Quantity *
                        </label>
                        <input type="number" id="stock" name="stock"
                               class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('stock', $product->stock ?? '')); ?>" required>
                        <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <?php if(isset($product)): ?>
                        <div class="mb-6">
                            <label for="status" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-toggle-on text-primary-600 mr-2"></i>Product Status *
                            </label>
                            <?php ($currentStatus = old('status', $product->status ?? 'available')); ?>
                            <select id="status" name="status"
                                    class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required>
                                <option value="available" <?php echo e($currentStatus === 'available' ? 'selected' : ''); ?>>Available</option>
                                <option value="unavailable" <?php echo e($currentStatus === 'unavailable' ? 'selected' : ''); ?>>Unavailable</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    <?php endif; ?>

                    <div class="mb-8">
                        <label for="image_path" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-image text-primary-600 mr-2"></i>Product Image
                        </label>

                        <!-- Image Preview -->
                        <?php if(isset($product) && $product->image_path): ?>
                            <div class="mb-4 p-4 bg-neutral-100 rounded-lg border border-neutral-300">
                                <p class="text-xs font-semibold text-neutral-700 mb-2">Current Image:</p>
                                <img src="<?php echo e(Storage::url($product->image_path)); ?>" alt="<?php echo e($product->name); ?>" class="h-40 w-40 object-cover rounded-lg">
                            </div>
                        <?php endif; ?>

                        <!-- File Input -->
                        <div class="relative">
                            <input type="file" id="image_path" name="image_path" accept="image/*"
                                   class="w-full px-4 py-3 border-2 border-dashed border-neutral-300 rounded-lg bg-neutral-50 hover:border-primary-400 hover:bg-primary-50/40 transition cursor-pointer <?php $__errorArgs = ['image_path'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   onchange="previewImage(this)">
                            <p class="mt-2 text-xs text-neutral-500">
                                <i class="fas fa-cloud-upload-alt mr-1"></i>
                                Drag and drop or click to upload. Max 2MB (JPEG, PNG, GIF)
                            </p>
                        </div>

                        <!-- Image Preview on Upload -->
                        <div id="preview-container" class="mt-4" style="display:none;">
                            <p class="text-xs font-semibold text-neutral-700 mb-2">Preview:</p>
                            <img id="preview-image" src="" alt="Preview" class="h-40 w-40 object-cover rounded-lg border-2 border-primary-300">
                        </div>

                        <?php $__errorArgs = ['image_path'];
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

                    <script>
                        function previewImage(input) {
                            const preview = document.getElementById('preview-container');
                            const previewImage = document.getElementById('preview-image');

                            if (input.files && input.files[0]) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    previewImage.src = e.target.result;
                                    preview.style.display = 'block';
                                };
                                reader.readAsDataURL(input.files[0]);
                            } else {
                                preview.style.display = 'none';
                            }
                        }
                    </script>

                    <div class="flex flex-col md:flex-row gap-4 mb-2">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-save mr-2"></i><?php echo e(isset($product) ? 'Save Changes' : 'Create Product'); ?>

                        </button>
                        <a href="<?php echo e(route('products.index')); ?>" class="flex-1 bg-neutral-300 hover:bg-neutral-400 text-neutral-800 font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/products/form.blade.php ENDPATH**/ ?>