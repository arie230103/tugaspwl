@extends('layouts.app')

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
                                <th>Id Transaksi</th>
                                <th>Nama User</th>
                                <th>Total Harga</th>
                                <th>Status Transaksi</th>
                                <th>Bukti Transfer</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction as $data)
                            <tr>
                                <td align="center">{{ $data->id }}</td>
                                <td align="center">{{ $data->name }}</td>
                                <td align="center">{{ $data->total_price }}</td>
                                <td align="center">
                                    @if ($data->status == 0)
                                    <p class="text-danger font-weight-bold">Transaksi Gagal</p>
                                    @elseif ($data->status == 1)
                                    <p class="text-warning font-weight-bold">Menungggu Validasi</p>
                                    @else
                                    <p class="text-success font-weight-bold">Transaksi Berhasil</p>
                                    @endif
                                </td>
                                <td align="center" width="250">
                                    <img src="{{ asset($data->transfer_path) }}" alt="img" class="img-thumbnail" />
                                </td>
                                <td align="center" width="350">
                                    <form action="{{ route('transactions.verification', ['id' => $data->id, 'status' => 0]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-outline-danger btn-block mb-3" @if ($data->status == 0 || $data->status == 2) disabled @endif>Tolak</button>
                                    </form>
                                    <form action=" {{ route('transactions.verification', ['id' => $data->id, 'status' => 2]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-outline-success btn-block" @if ($data->status == 0 || $data->status == 2) disabled @endif
                                            >Terima</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            @if(count($transaction) == 0)
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