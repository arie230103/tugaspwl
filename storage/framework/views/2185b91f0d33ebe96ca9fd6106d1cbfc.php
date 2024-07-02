<?php $__env->startSection('title', 'Master Kategori Produk'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-end align-items-end">
                    <a href="<?php echo e(route('category.create')); ?>" class="btn btn-outline-primary">Tambah Kategori</a>
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
                                    <th>Slug Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $allCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><?php echo e($data->name); ?></td>
                                        <td><?php echo e($data->slug); ?></td>
                                        <td align="center" width="200">
                                            <a href="<?php echo e(route('category.edit', $data->id)); ?>" class="btn btn-outline-info btn-block mb-2">Edit</a>
                                            <form action="<?php echo e(route('category.destroy', $data->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-block">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if(count($allCategory) == 0): ?>
                                    <tr>
                                        <td colspan="4" align="center">Tidak ada data yang ditemukan.</td>
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

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/manusiacoding/Documents/faw-development/project/arie-shop/resources/views/pages/categories/index.blade.php ENDPATH**/ ?>