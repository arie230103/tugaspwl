@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-lg-12 d-flex justify-content-center align-items-center">
                    <img id="profile" src="{{ asset(Auth::user()->picture_path) }}" style="cursor: pointer;" alt="Profile Picture" class="img-thumbnail w-25 rounded" />
                    <form id="formPicture" action="{{ route('update.profile.picture') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="file" id="image" name="image" class="d-none" accept="image/*" />
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('update.profile') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" class="form-control" />
                        </div>
                        <hr class="mt-4 mb-3" />
                        <div class="mb-3">
                            <label for="password" class="form-label">Ganti Password</label>
                            <input type="text" id="password" name="password" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                            <input type="text" id="confirm_password" name="confirm_password" class="form-control" />
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(() => {
            $("#profile").on('click', () => {
                $("#image").trigger('click');
            });

            $("#image").on('change', (e) => {
                let file = e.target.files[0];

                if (file) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#profile').attr('src', e.target.result);
                        $('#profile').show();
                    };

                    reader.readAsDataURL(file);

                    $('#formPicture').submit();
                }
            });
        });
    </script>
@endsection
