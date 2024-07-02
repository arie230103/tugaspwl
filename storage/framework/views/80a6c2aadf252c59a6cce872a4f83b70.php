<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Kategori</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <?php
                $categories = App\Models\CategoryProduct::all();
                ?>
                <div class="navbar-nav w-100">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('store.product.getBySlug', $data->slug)); ?>" class="nav-item nav-link"><?php echo e($data->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="<?php echo e(route('store.index')); ?>" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Arie</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="<?php echo e(route('store.index')); ?>" class="nav-item nav-link">Beranda</a>
                        <a href="<?php echo e(route('store.product.index')); ?>" class="nav-item nav-link">Semua Produk</a>
                    </div>
                    <?php if(auth()->guard()->check()): ?>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="<?php echo e(route('store.cart.index')); ?>" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <?php
                            $data =App\Models\Cart::selectRaw('COUNT(product_id) as total')->where('user_id', '=', Illuminate\Support\Facades\Auth::user()->id)->first();
                            ?>
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?php echo e($data->total); ?></span>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\arie-shop\resources\views/store/components/navbar.blade.php ENDPATH**/ ?>