@extends('admin.templateAdmin')

@section('body')
    <h4>Edit User</h4>        
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
        <form action="{{ route('datauser.update', [ 'id' => $user->id ]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label class="form-label fw-semibold">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" />
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Username</label>
                <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" />
                <small class="text-danger">{{ $errors->first('username') }}</small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" />
                <small class="text-danger">{{ $errors->first('email') }}</small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control" name="password" value="{{ old('password') }}" />
                <small class="text-danger">{{ $errors->first('password') }}</small>
            </div>
            <div class="d-grid mt-3">
                <button class="btn btn-primary btn-md">
                    Submit
                </button>
            </div>
        </form>
    @endsection
