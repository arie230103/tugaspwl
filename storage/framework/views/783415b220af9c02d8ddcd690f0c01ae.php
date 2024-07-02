<?php $__env->startSection('content'); ?>
<div class="container-fluid pt-5 pb-3">
    <h3 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Produk Terbaru</span></h3>
    <div class="row px-xl-5">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="<?php echo e(asset($data->image_path)); ?>" alt="">
                    <div class="product-action">
                        <?php if(auth()->guard()->check()): ?>
                        <form method="post" action="<?php echo e(route('store.cart.addCart', $data->id)); ?>" id="cart-form">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-dark btn-square" type="submit"><i class="fa fa-shopping-cart"></i></button>
                        </form>
                        <?php endif; ?>
                        <button class="btn btn-outline-dark btn-square"><i class="fa fa-search" onclick="event.preventDefault(); document.getElementById('detail-button').click();"></i></button>
                        <a href="<?php echo e(route('store.product.show', $data->id)); ?>" id="detail-button">&nbsp;</a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href=""><?php echo e($data->name); ?></a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <?php
                        $price = $data->price;
                        $discount = $data->discount;
                        $calculate = $price * ($discount / 100);
                        $priceAfterDiscount = $price - $calculate;
                        ?>

                        <h5>
                            <?php if($data->is_discount == 1): ?>
                            <?php echo e('Rp ' . number_format($priceAfterDiscount, 0, ',', '.')); ?>

                            <?php else: ?>
                            <?php echo e('Rp ' . number_format($data->price, 0, ',', '.')); ?>

                            <?php endif; ?>
                        </h5>
                        <?php if($data->is_discount == 1): ?>
                        <h6 class="text-muted ml-2">
                            <del><?php echo e(number_format($data->price, 0, ',', '.')); ?></del>
                        </h6>
                        <?php endif; ?>
                    </div>
                    <!-- <div class="d-flex align-items-center justify-content-center mb-1">
                        <?php
                        $product_id = $data->id;
                        $averageRating = \App\Models\Review::where('product_id', $product_id)->avg('rating');
                        ?>

                        <?php if($averageRating == 0): ?>
                        <i style="color: #ffd333;" class="far fa-star"></i>
                        <i style="color: #ffd333;" class="far fa-star"></i>
                        <i style="color: #ffd333;" class="far fa-star"></i>
                        <i style="color: #ffd333;" class="far fa-star"></i>
                        <i style="color: #ffd333;" class="far fa-star"></i>
                        <?php else: ?>
                        <?php echo renderStars($averageRating); ?>

                        <?php endif; ?>

                        <small class="ml-2">
                            <?php
                            $review = App\Models\Review::where('product_id', $data->id)->get();
                            ?>

                            <?php if(count($review) > 0): ?>
                            <?php echo e('(' . count($review) . ' Ulasan)'); ?>

                            <?php else: ?>
                            <?php echo e('(0 Ulasan)'); ?>

                            <?php endif; ?>
                        </small>
                    </div> -->
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if(count($products) == 0): ?>
        <div class="col-lg-12 d-flex justify-content-center align-items-center">
            <h4>Belum ada produk.</h4>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('store.layouts.store', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\arie-shop\resources\views/store/pages/index.blade.php ENDPATH**/ ?>