<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Absensi Guru')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #FFF9EB;
        }

        .sidebar {
            background-color: #D6FBC5;
            min-height: 100vh;
            width: 200px;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar img {
            width: 100px;
            margin-bottom: 20px;
            margin-right: 20px;
        }

        .nav-link {
            color: #000000;
            font-weight: bold;
            font-size: 1.1rem;
            padding: 10px 15px;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .bg-light-green {
            background-color: #D6FBC5;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logoSD.png') }}" alt="Logo" class="img-fluid" style="width: 150px;">
                </div>
                <ul class="nav flex-column text-start">
                    <li class="nav-item">
                        <a class="nav-link active" href="/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/absensi">Data Absensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/guru">Data Guru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pengaturan">Pengaturan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/beranda">Logout</a>
                    </li>
                </ul>

                <head>
                    <!-- Bootstrap CSS -->
                    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
                    <!-- Custom CSS -->
                    <link href="{{ asset('style.css') }}" rel="stylesheet">
                </head>
            </div>

            <!-- Main Content -->
            <div class="content">
                @yield('content')
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>