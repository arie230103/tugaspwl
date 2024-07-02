@extends('store.layouts.store')

@section('content')
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <img class="w-100 h-100" src="{{ asset($product->image_path) }}" alt="Image">
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{ $product->name }}</h3>
                <!-- <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        @php
                        $product_id = $product->id;
                        $averageRating = \App\Models\Review::where('product_id', $product_id)->avg('rating');
                        @endphp

                        @if($averageRating == 0)
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        @else
                        {!! renderStars($averageRating) !!}
                        @endif
                    </div>
                    <small class="pt-1 ml-2">
                        @php
                        $review = App\Models\Review::where('product_id', $product->id)->get();
                        @endphp

                        @if (count($review) > 0)
                        {{ '(' . count($review) . ' Ulasan)' }}
                        @else
                        {{ '(0 Ulasan)' }}
                        @endif
                    </small>
                </div> -->
                <h3 class="font-weight-semi-bold mb-4">
                    {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}
                </h3>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary border-0 text-center" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <form method="post" action="{{ route('store.cart.addCart', $product->id) }}" id="cart-form">
                        @csrf
                        <!-- <button class="btn btn-outline-dark btn-square" type="submit"><i class="fa fa-shopping-cart"></i> Tambah ke Keranjang</button> -->
                        <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1" type="submit"></i> Tambah ke Keranjang</button>
                    </form>
                    <!-- <button class="btn btn-primary px-3 ml-3"><i class="fa fa-money-bill mr-1"></i> Beli Sekarang</button> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Deskripsi</a>
                    <!-- <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">
                        @if (count($review) > 0)
                        {{ '(' . count($review) . ' Ulasan)' }}
                        @else
                        {{ '(0 Ulasan)' }}
                        @endif
                    </a> -->
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p>
                            {{ $product->description }}
                        </p>
                    </div>
                    <!-- <div class="tab-pane fade" id="tab-pane-2">
                            <div class="row">
                                @if (count($review) > 0)
                                    <div class="col-md-6">
                                        <h4 class="mb-4">
                                            {{ count($review) . ' ulasan untuk "' . $product->name .'"' }}
                                        </h4>
                                        @foreach ($reviews as $data)
                                            <div class="media mb-4">
                                                <img src="{{ $data->picture_path != null ? asset($data->picture_path) : asset('assets/img/undraw_profile.svg') }} " alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                                <div class="media-body">
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $formattedDate = Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y H:i:s');
                                                    @endphp

                                                    <h6>{{ $data->name }}<small> - <i>{{ $formattedDate }}</i></small></h6>
                                                    <div class="text-primary mb-2">
                                                        @if($data->rating == 0)
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        @else
                                                            {!! renderStars($data->rating) !!}
                                                        @endif
                                                    </div>
                                                    <p>
                                                        {{ $data->comment }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                                        <h4 class="mb-4">Belum ada ulasan untuk produk ini.</h4>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <h4 class="mb-4">Tinggalkan ulasan</h4>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Penilaian Anda :</p>
                                        <div class="text-primary rating" style="cursor: pointer;">
                                            <i class="far fa-star" data-value="1"></i>
                                            <i class="far fa-star" data-value="2"></i>
                                            <i class="far fa-star" data-value="3"></i>
                                            <i class="far fa-star" data-value="4"></i>
                                            <i class="far fa-star" data-value="5"></i>
                                        </div>
                                        <div id="rating-value" class="ml-2">0</div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="message">Ulasan Anda</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Kirim" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(() => {
        let selectedRating = 0;

        function renderStars(rating) {
            $('.fa-star').each(function() {
                let starValue = $(this).data('value');
                if (starValue <= rating) {
                    $(this).removeClass('far fa-star-half-alt').addClass('fa');
                } else if (starValue - 0.5 === rating) {
                    $(this).removeClass('far').addClass('fa fa-star-half-alt');
                } else {
                    $(this).removeClass('fa fa-star-half-alt').addClass('far');
                }
            });
        }

        $('.fa-star').hover(
            function() {
                let rating = $(this).data('value');
                renderStars(rating);
            },
            function() {
                renderStars(selectedRating);
            }
        );

        $('.fa-star').click(function() {
            if ($(this).hasClass('fa-star-half-alt')) {
                selectedRating = $(this).data('value') - 0.5;
            } else {
                selectedRating = $(this).data('value');
            }

            $('#rating-value').text(selectedRating);
            renderStars(selectedRating);
        });

        $('.fa-star').mousemove(function(e) {
            let relativeX = e.pageX - $(this).offset().left;
            let rating = $(this).data('value');
            if (relativeX < $(this).width() / 2) {
                rating -= 0.5;
            }
            renderStars(rating);
        });
    });
</script>
@endsection