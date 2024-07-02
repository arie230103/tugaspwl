<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('dashboard')); ?>">
        <div class="sidebar-brand-text mx-3">Arieshop.com</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('user.index')); ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Master User</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('category.index')); ?>">
            <i class="fas fa-fw fa-list"></i>
            <span>Master Kategori Produk</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('product.index')); ?>">
            <i class="fas fa-fw fa-cube"></i>
            <span>Master Produk</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<?php /**PATH /home/manusiacoding/Documents/faw-development/project/arie-shop/resources/views/components/sidebar.blade.php ENDPATH**/ ?>