@extends('layouts.app')
@section('title', 'Master User')

@section('content')
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-end align-items-end">
                    <a href="{{ route('user.create') }}" class="btn btn-outline-primary">Tambah User</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Role</th>
                                    <th>Nama User</th>
                                    <th>Email</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->role }}</td>
                                        <td>{{ ucwords($data->name) }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td align="center" width="200">
                                            @if($data->picture_path != null)
                                                <img src="{{ asset($data->picture_path) }}" alt="picture" class="img-thumbnail w-100" />
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td align="center" width="200">
                                            <a href="{{ route('user.edit', $data->id) }}" class="btn btn-outline-info btn-block mb-2 @if(Auth::user()->role_id == $data->role_id) d-none @endif">Edit</a>
                                            <form action="{{ route('user.destroy', $data->id) }}" method="POST" class="@if(Auth::user()->role_id == $data->role_id) d-none @endif">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-block">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                @if(count($user) == 0)
                                    <tr>
                                        <td colspan="6" align="center">Tidak ada data yang ditemukan.</td>
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
