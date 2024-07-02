@extends('layouts.app')
@section('title', 'Master Kategori Produk')

@section('content')
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <form autocomplete="off" method="POST" action="{{ route('category.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh : Kemeja Pria">
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug Kategori</label>
                    <input type="text" name="slug" class="form-control" placeholder="Contoh : kemeja-pria">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
