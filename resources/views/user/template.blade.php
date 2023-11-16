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
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* background-color: #010124;     */
        }

        .navbare {
            display: flex;
            justify-content: space-between;
            color: #fff;
            background-color: #000;
            padding: 6px 100px 0 80px;
        }

        .d-flexx {
            display: flex;
            padding: 0 0 0 50px;
        }

        .nav-linkss {
            list-style-type: none;
            display: flex;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            padding: 15px 0 0 10px;
        }

        .nav-items {
            padding: 0 10px 0 10px;
            cursor: pointer;
        }

        .dropdown-menus {
            display: none;
            position: absolute;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            list-style: none;
            padding: 0;
            z-index: 1;
        }

        .dropdown-items a {
            font-size: 15px;
            font-weight: lighter;
            color: #000;
            text-decoration: none;
        }

        .dropdown-items {
            padding: 10px 30px 10px 10px;
            cursor: pointer;
            font-size: 15px;
            font-weight: lighter;
            color: #000;
            transition: 0.2s;
        }

        .nav-items:hover .dropdown-menus {
            display: block;
        }

        .dropdown-items:hover {
            background-color: #d6d4d4;
        }

        .h4 {
            padding: 18px 0 0 0;
        }

        .icon1 {
            font-size: 25px;
        }

        .icon2 {
            padding: 0 5px 0 0;
        }
    </style>
</head>

<body>
    <nav class="navbare">
        <h4 class="h4">PENGADUAN SEKOLAH</h4>
        <div class="d-flexx">
            <ul class="nav-linkss">
                <li class="nav-items dropdowns">
                    <i class="bi bi-person-circle icon1"></i>
                    <ul class="dropdown-menus">
                        <li class="dropdown-items">
                            <a href="{{ route('pengaduan.akun') }}">                        
                                <i class="bi bi-pencil-square icon2"></i>Edit Profil
                            </a>
                        </li>
                        <li class="dropdown-items">
                            <a href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-left icon2"></i>logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="pt-5"
        style="background-image:url(img/scattered-forcefields.png);
    background-size: cover;
    height: 115vh;">
        @yield('body')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
