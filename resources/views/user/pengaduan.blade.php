@extends('user.template')

@section('body')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card bg-dark text-light">
                <div class="card-body">
                    <div class="text-center pt-1 pb-3">
                        <h4>Form Pengaduan</h4>
                    </div>
                    @error('message')
                        <div class="alert alert-danger small py-3 mb-4">
                            {{ $message }}
                        </div>
                    @enderror
                    @if (session('message'))
                        <div class="alert alert-success small py-3 mb-4">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control" style="background-color: #bebebe" name="nama" value="{{ $user->name }}" readonly/>
                            <small class="text-danger">{{ $errors->first('nama') }}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kelas</label>
                            <input type="text" class="form-control" name="kelas" value="{{ old('kelas') }}" />
                            <small class="text-danger">{{ $errors->first('kelas') }}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Gambar</label>
                            <input type="file" class="form-control" name="image" />
                            <small class="text-danger">{{ $errors->first('gambar') }}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Keluhan</label>
                            <textarea name="keluhan" class="form-control" cols="30" rows="4">{{ old('keluhan') }}</textarea>
                            <small class="text-danger">{{ $errors->first('keluhan') }}</small>
                        </div>
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary btn-md">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
