<?php $__env->startSection('title', 'Master Kategori Produk'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <form autocomplete="off" method="POST" action="<?php echo e(route('category.update', $category->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh : Kemeja Pria" value="<?php echo e($category->name); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug Kategori</label>
                    <input type="text" name="slug" class="form-control" placeholder="Contoh : kemeja-pria" value="<?php echo e($category->slug); ?>">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\arie-shop\resources\views/pages/categories/edit.blade.php ENDPATH**/ ?>