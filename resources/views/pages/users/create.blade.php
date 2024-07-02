@extends('layouts.app')
@section('title', 'Master User')

@section('content')
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <form autocomplete="off" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Role</label>
                    <select name="role_id" class="form-control">
                        <option value="" selected disabled>Silahkan pilih role user.</option>
                        @foreach ($role as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama User</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh : Arie Satria">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Contoh : arie@example.com">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Profile</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
