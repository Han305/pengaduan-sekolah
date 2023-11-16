@extends('user.template')

@section('body')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card bg-dark text-light">
                <div class="card-body">
                    <div class="text-center pt-1 pb-3">
                        <h4>Edit Akun</h4>
                    </div>
                    @error('message')
                        <div class="alert alert-danger small py-3 mb-4">
                            {{ $message }}
                        </div>
                    @enderror
                    @if (session('message'))
                        <div class="alert alert-success small py-3  mb-4">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('pengaduan.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $user->name) }}" />
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text" class="form-control" name="username"
                                value="{{ old('username', $user->username) }}" />
                            <small class="text-danger">{{ $errors->first('username') }}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" name="email"
                                value="{{ old('email', $user->email) }}" />
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control" name="password" value="{{ old('password') }}" />
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pengaduan') }}" class="btn btn-success">Kembali</a>
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
