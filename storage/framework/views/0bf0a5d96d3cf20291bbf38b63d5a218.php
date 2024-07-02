<?php $__env->startSection('title', 'Master Produk'); ?>

<?php $__env->startSection('content'); ?>
<div class="card shadow h-100 py-2">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end align-items-end">
                <a href="<?php echo e(route('product.create')); ?>" class="btn btn-outline-primary">Tambah Produk</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Diskon (%)</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $allProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key + 1); ?></td>
                                <td><?php echo e(ucwords($data->category)); ?></td>
                                <td><?php echo e(ucwords($data->name)); ?></td>
                                <td><?php echo e('Rp ' . number_format($data->price, 0, ',', '.')); ?></td>
                                <td><?php echo e($data->stock); ?></td>
                                <td>
                                    <?php if($data->is_discount): ?>
                                    <?php echo e($data->discount . '%'); ?>

                                    <?php else: ?>
                                    -
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($data->description); ?></td>
                                <td align="center" width="200">
                                    <?php if($data->image_path != null): ?>
                                    <img src="<?php echo e(asset($data->image_path)); ?>" alt="picture" class="img-thumbnail w-100" />
                                    <?php else: ?>
                                    -
                                    <?php endif; ?>
                                </td>
                                <td align="center" width="200">
                                    <a href="<?php echo e(route('product.edit', $data->id)); ?>" class="btn btn-outline-info btn-block mb-2">Edit</a>
                                    <form action="<?php echo e(route('product.destroy', $data->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-outline-danger btn-block">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if(count($allProduct) == 0): ?>
                            <tr>
                                <td colspan="9" align="center">Tidak ada data yang ditemukan.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\arie-shop\resources\views/pages/products/index.blade.php ENDPATH**/ ?>