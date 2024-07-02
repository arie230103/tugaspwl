@extends('store.layouts.store')

@section('content')
<div class="container-fluid pt-5 pb-3">
    <h3 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Produk Terbaru</span></h3>
    <div class="row px-xl-5">
        @foreach ($products as $data)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{ asset($data->image_path) }}" alt="">
                    <div class="product-action">
                        @auth
                        <form method="post" action="{{ route('store.cart.addCart', $data->id) }}" id="cart-form">
                            @csrf
                            <button class="btn btn-outline-dark btn-square" type="submit"><i class="fa fa-shopping-cart"></i></button>
                        </form>
                        @endauth
                        <button class="btn btn-outline-dark btn-square"><i class="fa fa-search" onclick="event.preventDefault(); document.getElementById('detail-button').click();"></i></button>
                        <a href="{{ route('store.product.show', $data->id) }}" id="detail-button">&nbsp;</a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">{{ $data->name }}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        @php
                        $price = $data->price;
                        $discount = $data->discount;
                        $calculate = $price * ($discount / 100);
                        $priceAfterDiscount = $price - $calculate;
                        @endphp

                        <h5>
                            @if ($data->is_discount == 1)
                            {{ 'Rp ' . number_format($priceAfterDiscount, 0, ',', '.') }}
                            @else
                            {{ 'Rp ' . number_format($data->price, 0, ',', '.') }}
                            @endif
                        </h5>
                        @if ($data->is_discount == 1)
                        <h6 class="text-muted ml-2">
                            <del>{{ number_format($data->price, 0, ',', '.') }}</del>
                        </h6>
                        @endif
                    </div>
                    <!-- <div class="d-flex align-items-center justify-content-center mb-1">
                        @php
                        $product_id = $data->id;
                        $averageRating = \App\Models\Review::where('product_id', $product_id)->avg('rating');
                        @endphp

                        @if($averageRating == 0)
                        <i style="color: #ffd333;" class="far fa-star"></i>
                        <i style="color: #ffd333;" class="far fa-star"></i>
                        <i style="color: #ffd333;" class="far fa-star"></i>
                        <i style="color: #ffd333;" class="far fa-star"></i>
                        <i style="color: #ffd333;" class="far fa-star"></i>
                        @else
                        {!! renderStars($averageRating) !!}
                        @endif

                        <small class="ml-2">
                            @php
                            $review = App\Models\Review::where('product_id', $data->id)->get();
                            @endphp

                            @if (count($review) > 0)
                            {{ '(' . count($review) . ' Ulasan)' }}
                            @else
                            {{ '(0 Ulasan)' }}
                            @endif
                        </small>
                    </div> -->
                </div>
            </div>
        </div>
        @endforeach

        @if (count($products) == 0)
        <div class="col-lg-12 d-flex justify-content-center align-items-center">
            <h4>Belum ada produk.</h4>
        </div>
        @endif
    </div>
</div>
@endsection