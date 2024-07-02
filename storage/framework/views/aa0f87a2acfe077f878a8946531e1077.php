<?php $__env->startSection('title', 'Master User'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <form autocomplete="off" method="POST" action="<?php echo e(route('user.update', $user->id)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label class="form-label">Nama Role</label>
                    <select name="role_id" class="form-control">
                        <option value="" selected disabled>Silahkan pilih role user.</option>
                        <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($data->id); ?>" <?php if($user->role_id == $data->id): ?> selected <?php endif; ?>><?php echo e($data->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama User</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh : Arie Satria" value="<?php echo e($user->name); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Contoh : arie@example.com" value="<?php echo e($user->email); ?>">
                </div>
                <div class="mb-3">
                    <img src="<?php echo e(asset($user->picture_path)); ?>" alt="User tidak memiliki foto." class="img-thumbnail w-25" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Profile</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\arie-shop\resources\views/pages/users/edit.blade.php ENDPATH**/ ?>