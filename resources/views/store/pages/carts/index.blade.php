@extends('store.layouts.store')

@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>&nbsp;</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kuantitas</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($carts as $data)
                    <tr id="cart-row">
                        <td class="align-middle" align="center">
                            <input type="checkbox" id="checkCart" class="form-control w-50" style="cursor: pointer;" />
                            <input type="hidden" id="product_id" value="{{ $data->product_id }}" />
                        </td>
                        <td class="align-middle">
                            {{ $data->name }}
                        </td>
                        <td class="align-middle">
                            @php
                            $price = $data->price;
                            $discount = $data->discount;
                            $calculate = $price * ($discount / 100);
                            $priceAfterDiscount = $price - $calculate;
                            @endphp

                            @if ($data->is_discount == 1)
                            {{ 'Rp ' . number_format($priceAfterDiscount, 0, ',', '.') }}
                            <input type="hidden" value="{{ $priceAfterDiscount }}" id="price">
                            @else
                            {{ 'Rp ' . number_format($data->price, 0, ',', '.') }}
                            <input type="hidden" value="{{ $data->price }}" id="price">
                            @endif

                            <input type="hidden" value="{{ $data->is_discount == 1 ? $priceAfterDiscount : $data->price }}" class="price" />
                        </td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" id="removeqty">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center qty" value="0" />
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus" id="addqty">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            <span class="subtotal">Rp 0,00</span>
                            <input type="hidden" class="input-subtotal" value="0" />
                        </td>
                        <td class="align-middle">
                            <form action="{{ route('store.cart.destroy', $data->cart_id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger btn-remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if (count($carts) == 0)
                    <tr>
                        <td colspan="5">Keranjang masih kosong.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="col-lg-4">
            <div class="bg-light p-30 mb-5">
                <div class="pt-2">
                    <div class="d-flex justify-content-between">
                        <h5>Total</h5>
                        <span class="total"></span>
                        <input type="hidden" id="total_price" />
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="transaction-button">Lanjutkan transaksi</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(() => {
        let cart = [];

        function updateTotal() {
            var total = 0;

            $('.input-subtotal').each(function() {
                total += parseFloat($(this).val());
            });

            $('#total_price').val(total);

            $('.total').text(total.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).replace('IDR', 'Rp').replace(',00', '') + ',00');
        }

        function updateSubtotal(row) {
            var price = parseFloat(row.find('.price').val());
            var qty = parseInt(row.find('.qty').val());
            var subtotal = price * qty;

            row.find('.input-subtotal').val(subtotal);
            row.find('.subtotal').text(subtotal.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).replace('IDR', 'Rp').replace(',00', '') + ',00');
        }

        $('.qty').on('change', function() {
            var row = $(this).closest('#cart-row');
            updateSubtotal(row);
            updateTotal();
        });

        $('#cart-row .btn-minus').on('click', function() {
            var qtyInput = $(this).closest('.quantity').find('.qty');
            if (qtyInput.val() < 0) qtyInput.val(0);
            else qtyInput.trigger('change');
        });

        $('#cart-row .btn-plus').on('click', function() {
            var qtyInput = $(this).closest('.quantity').find('.qty');
            qtyInput.trigger('change');
        });

        $('#cart-row').each(function() {
            updateSubtotal($(this));
        });

        updateTotal();

        $(document).on('change', '#checkCart', function() {
            let row = $(this).closest('#cart-row');
            let product_id = row.find('#product_id').val();
            let qty = row.find('.qty').val();
            let price = row.find('#price').val();
            let subtotal = row.find('.input-subtotal').val();

            if ($(this).is(':checked')) {
                let obj = {
                    product_id: product_id,
                    quantity: qty,
                    price: price,
                    subtotal: subtotal
                };

                if (qty == 0) {
                    alert('Harap masukkan kuantiti terlebih dahulu.');
                    $(this).prop('checked', false);
                } else {
                    cart.push(obj);
                    row.find('.btn-minus').prop('disabled', true);
                    row.find('.btn-plus').prop('disabled', true);
                    row.find('.btn-remove').prop('disabled', true);
                    row.find('.qty').prop('disabled', true);
                }
            } else {
                row.find('.btn-minus').prop('disabled', false);
                row.find('.btn-plus').prop('disabled', false);
                row.find('.btn-remove').prop('disabled', false);
                row.find('.qty').prop('disabled', false);

                const filtered = cart.filter(e => e.product_id != product_id);
                cart = filtered;
            }
        });

        $('#transaction-button').on('click', function() {
            $.ajax({
                url: "{{ route('store.transaction.store') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    total_price: $('#total_price').val(),
                    detail: cart
                },
                success: function(data) {
                    console.log(data.transaction.id);
                    window.location.href = `/store/transactions/${data.transaction.id}`;
                }
            });
        });
    });
</script>
@endsection