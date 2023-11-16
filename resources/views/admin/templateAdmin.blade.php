<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Document</title>
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding: 20px 0 0 0;
        }

        .sidebar a{
            padding: 15px;
            text-decoration: none;
            font-size: 15px;
            color: #fff;
            display: block;
            transition: 0.2s all;
        }

        .sidebar h5 {
            color: #fff;
            text-align: center;
            padding: 10px 0 10px 0;
        }

        .sidebar a:hover{
            background-color: #555;
        }

        .content {
            margin: 0 0 0 260px;
            padding: 20px;
        }

        .icon {
            padding: 0 10px 0 0;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="d-flex align-center justify-content-center">
            <img src="{{ asset('img/logo.png') }}" width="100" alt="">
        </div>
        <h5>Pengaduan Sekolah</h5>
        <a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill icon"></i>Beranda</a>
        <a href="{{ route('laporan') }}"><i class="bi bi-journal icon"></i>Laporan Pengaduan</a>
        <a href="{{ route('riwayat') }}"><i class="bi bi-clock-history icon"></i>Riwayat Pengaduan</a>
        <a href="{{ route('datauser') }}"><i class="bi bi-people-fill icon icon"></i>Data User</a>        
        <a href="{{ route('akun') }}"><i class="bi bi-pencil-square icon"></i>Edit Akun</a>        
        <a href="{{ route('logout') }}"><i class="bi bi-box-arrow-left icon"></i>logout</a>
    </div>
    <div class="content">
        @yield('body')
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('script')
</html>