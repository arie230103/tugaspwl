<?php $__env->startSection('title', 'Master User'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-end align-items-end">
                    <a href="<?php echo e(route('user.create')); ?>" class="btn btn-outline-primary">Tambah User</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Role</th>
                                    <th>Nama User</th>
                                    <th>Email</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><?php echo e($data->role); ?></td>
                                        <td><?php echo e(ucwords($data->name)); ?></td>
                                        <td><?php echo e($data->email); ?></td>
                                        <td align="center" width="200">
                                            <?php if($data->picture_path != null): ?>
                                                <img src="<?php echo e(asset($data->picture_path)); ?>" alt="picture" class="img-thumbnail w-100" />
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td align="center" width="200">
                                            <a href="<?php echo e(route('user.edit', $data->id)); ?>" class="btn btn-outline-info btn-block mb-2 <?php if(Auth::user()->role_id == $data->role_id): ?> d-none <?php endif; ?>">Edit</a>
                                            <form action="<?php echo e(route('user.destroy', $data->id)); ?>" method="POST" class="<?php if(Auth::user()->role_id == $data->role_id): ?> d-none <?php endif; ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-block">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if(count($user) == 0): ?>
                                    <tr>
                                        <td colspan="6" align="center">Tidak ada data yang ditemukan.</td>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/manusiacoding/Documents/faw-development/project/arie-shop/resources/views/pages/users/index.blade.php ENDPATH**/ ?>