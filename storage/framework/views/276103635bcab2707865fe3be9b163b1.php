<?php $__env->startSection('title', 'Master Produk'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <form autocomplete="off" method="POST" action="<?php echo e(route('product.update', $product->id)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label class="form-label">Kategori Produk</label>
                    <select name="category_id" class="form-control">
                        <option value="" selected disabled>Silahkan pilih kategori produk</option>
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($data->id); ?>" <?php if($product->category_id == $data->id): ?> selected <?php endif; ?>><?php echo e($data->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh : Kemeja Pria Polos" value="<?php echo e($product->name); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Produk</label>
                    <input type="number" name="price" class="form-control" placeholder="Contoh : 10000" value="<?php echo e($product->price); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok Produk</label>
                    <input type="text" name="stock" class="form-control" placeholder="Contoh : 99" value="<?php echo e($product->stock); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Diskon?</label>
                    <input type="hidden" id="is_discount_value" value="<?php echo e($product->is_discount); ?>" />
                    <select name="is_discount" class="form-control mb-2" id="is_discount">
                        <option value="" selected disabled>Silahkan pilih</option>
                        <option value="true" <?php if($product->is_discount): ?> selected <?php endif; ?>>Ya</option>
                        <option value="false" <?php if(!$product->is_discount): ?> selected <?php endif; ?>>Tidak</option>
                    </select>

                    <input type="number" name="discount" id="discount" class="d-none form-control" placeholder="Contoh : 10.00" value="<?php echo e($product->discount); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea name="description" class="form-control" cols="30" rows="5"><?php echo e($product->description); ?></textarea>
                </div>
                <div class="mb-3">
                    <img src="<?php echo e(asset($product->image_path)); ?>" alt="Product tidak memiliki foto." class="img-thumbnail w-25" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Produk</label>
                    <input type="file" name="image" accept="image/*" id="discount" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            const isDiscountValue = $('#is_discount_value').val();

            $('#is_discount').on('change', function () {
                let value = $(this).find(':selected').val();

                if (value === 'true') {
                    $('#discount').removeClass('d-none');
                }
                else {
                    $('#discount').addClass('d-none');
                    $('#discount').val('');
                }
            });

            if (isDiscountValue === 1) $('#discount').removeClass('d-none');
            else $('#discount').addClass('d-none');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\arie-shop\resources\views/pages/products/edit.blade.php ENDPATH**/ ?>