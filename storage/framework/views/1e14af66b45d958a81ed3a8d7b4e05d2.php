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
                                <th>Id Transaksi</th>
                                <th>Nama User</th>
                                <th>Total Harga</th>
                                <th>Status Transaksi</th>
                                <th>Bukti Transfer</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td align="center"><?php echo e($data->id); ?></td>
                                <td align="center"><?php echo e($data->name); ?></td>
                                <td align="center"><?php echo e($data->total_price); ?></td>
                                <td align="center">
                                    <?php if($data->status == 0): ?>
                                    <p class="text-danger font-weight-bold">Transaksi Gagal</p>
                                    <?php elseif($data->status == 1): ?>
                                    <p class="text-warning font-weight-bold">Menungggu Validasi</p>
                                    <?php else: ?>
                                    <p class="text-success font-weight-bold">Transaksi Berhasil</p>
                                    <?php endif; ?>
                                </td>
                                <td align="center" width="250">
                                    <img src="<?php echo e(asset($data->transfer_path)); ?>" alt="img" class="img-thumbnail" />
                                </td>
                                <td align="center" width="350">
                                    <form action="<?php echo e(route('transactions.verification', ['id' => $data->id, 'status' => 0])); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('put'); ?>
                                        <button type="submit" class="btn btn-outline-danger btn-block mb-3" <?php if($data->status == 0 || $data->status == 2): ?> disabled <?php endif; ?>>Tolak</button>
                                    </form>
                                    <form action=" <?php echo e(route('transactions.verification', ['id' => $data->id, 'status' => 2])); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('put'); ?>
                                        <button type="submit" class="btn btn-outline-success btn-block" <?php if($data->status == 0 || $data->status == 2): ?> disabled <?php endif; ?>
                                            >Terima</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if(count($transaction) == 0): ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\arie-shop\resources\views/pages/transaction/index.blade.php ENDPATH**/ ?>