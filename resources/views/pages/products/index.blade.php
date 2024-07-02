@extends('layouts.app')
@section('title', 'Master Produk')

@section('content')
<div class="card shadow h-100 py-2">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end align-items-end">
                <a href="{{ route('product.create') }}" class="btn btn-outline-primary">Tambah Produk</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Diskon (%)</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allProduct as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ ucwords($data->category) }}</td>
                                <td>{{ ucwords($data->name) }}</td>
                                <td>{{ 'Rp ' . number_format($data->price, 0, ',', '.') }}</td>
                                <td>{{ $data->stock }}</td>
                                <td>
                                    @if ($data->is_discount)
                                    {{ $data->discount . '%' }}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>{{ $data->description }}</td>
                                <td align="center" width="200">
                                    @if($data->image_path != null)
                                    <img src="{{ asset($data->image_path) }}" alt="picture" class="img-thumbnail w-100" />
                                    @else
                                    -
                                    @endif
                                </td>
                                <td align="center" width="200">
                                    <a href="{{ route('product.edit', $data->id) }}" class="btn btn-outline-info btn-block mb-2">Edit</a>
                                    <form action="{{ route('product.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-block">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            @if(count($allProduct) == 0)
                            <tr>
                                <td colspan="9" align="center">Tidak ada data yang ditemukan.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection