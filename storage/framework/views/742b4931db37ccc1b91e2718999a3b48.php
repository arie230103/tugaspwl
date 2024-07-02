<?php $__env->startSection('title', 'Master Produk'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <form autocomplete="off" method="POST" action="<?php echo e(route('product.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label">Kategori Produk</label>
                    <select name="category_id" class="form-control">
                        <option value="" selected disabled>Silahkan pilih kategori produk</option>
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($data->id); ?>"><?php echo e($data->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh : Kemeja Pria Polos">
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Produk</label>
                    <input type="number" name="price" class="form-control" placeholder="Contoh : 10000">
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok Produk</label>
                    <input type="text" name="stock" class="form-control" placeholder="Contoh : 99">
                </div>
                <div class="mb-3">
                    <label class="form-label">Diskon?</label>
                    <select name="is_discount" class="form-control mb-2" id="is_discount">
                        <option value="" selected disabled>Silahkan pilih</option>
                        <option value="true">Ya</option>
                        <option value="false">Tidak</option>
                    </select>

                    <input type="number" name="discount" id="discount" class="d-none form-control" placeholder="Contoh : 10.00">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea name="description" class="form-control" cols="30" rows="5"></textarea>
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
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\arie-shop\resources\views/pages/products/create.blade.php ENDPATH**/ ?>