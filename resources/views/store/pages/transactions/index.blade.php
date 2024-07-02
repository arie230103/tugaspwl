@extends('store.layouts.store')

@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <div class="bg-light p-30 mb-5">
                <div class="pt-2">
                    <div class="d-flexr">
                        <h3>Upload Bukti Pembayaran</h3>
                        <p class="mt-4">Nama Pemilik Rekening : Arie Satria</p>
                        <p class="mt-0">Nomor Rekening : 1234567890</p>

                        <form action="{{ route('store.transaction.upload', $id) }}" method="post" enctype="multipart/form-data" id="upload-form">
                            @csrf

                            <input type="file" name="image" class="form-control" accept="image/*" style="cursor: pointer;" onchange="event.preventDefault(); document.getElementById('upload-form').submit();" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection