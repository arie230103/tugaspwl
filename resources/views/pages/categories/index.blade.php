@extends('layouts.app')
@section('title', 'Master Kategori Produk')

@section('content')
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-end align-items-end">
                    <a href="{{ route('category.create') }}" class="btn btn-outline-primary">Tambah Kategori</a>
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
                                    <th>Slug Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allCategory as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->slug }}</td>
                                        <td align="center" width="200">
                                            <a href="{{ route('category.edit', $data->id) }}" class="btn btn-outline-info btn-block mb-2">Edit</a>
                                            <form action="{{ route('category.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-block">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                @if(count($allCategory) == 0)
                                    <tr>
                                        <td colspan="4" align="center">Tidak ada data yang ditemukan.</td>
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

@section('js')
@endsection
