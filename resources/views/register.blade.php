<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body style="background-image:url(img/endless-constellation.png);
    background-size: cover;
    height: 110vh;">
   <div class="row my-5">
        <div class="col-md-6 offset-md-3">

            <div class="card" style="margin: 0 7rem 0 7rem">
                <div class="card-body">
                    <div class="text-center pt-1 pb-3">
                        <div class="d-flex justify-content-center pb-3">
                            <img src="{{ asset('img/logo.png') }}" width="100" alt="">
                        </div>
                        <h5>Sign Up</h5>
                    </div>
                    @error('message')
                        <div class="alert alert-danger small py-3">
                            {{ $message }}
                        </div>
                    @enderror
                    @if(session('message'))
                        <div class="alert alert-success small py-3">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register.process') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ old('name') }}" />
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter Username" value="{{ old('username') }}" />
                            <small class="text-danger">{{ $errors->first('username') }}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email') }}" />
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" />
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="small fw-semibold text-muted">
                                Sudah punya akun? <a class="text-decoration-none" href="{{ route('login') }}">Login</a>.
                            </div>
                        </div>
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary btn-md">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
