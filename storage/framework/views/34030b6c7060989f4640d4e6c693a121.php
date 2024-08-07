<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-12 text-center text-lg-right">
            <div class="d-inline-flex align-items-end">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                        <?php if(auth()->guard()->guest()): ?>
                        Masuk / Daftar
                        <?php else: ?>
                        Akun Saya
                        <?php endif; ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php if(auth()->guard()->guest()): ?>
                        <button id="loginBtn" class="dropdown-item" type="button">Masuk</button>
                        <button id="registerBtn" class="dropdown-item" type="button">Daftar</button>

                        <a href="<?php echo e(route('login')); ?>" class="d-none" id="login"></a>
                        <a href="<?php echo e(route('register')); ?>" class="d-none" id="register"></a>
                        <?php else: ?>
                        <button class="dropdown-item" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </button>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Arie</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari produk">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\arie-shop\resources\views/store/components/topbar.blade.php ENDPATH**/ ?>