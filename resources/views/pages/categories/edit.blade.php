@extends('layouts.app')
@section('title', 'Master Kategori Produk')

@section('content')
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <form autocomplete="off" method="POST" action="{{ route('category.update', $category->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh : Kemeja Pria" value="{{ $category->name }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug Kategori</label>
                    <input type="text" name="slug" class="form-control" placeholder="Contoh : kemeja-pria" value="{{ $category->slug }}">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
