<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/Dashboard/style.css') }}">
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="{{ asset('images/logoSD.png') }}" alt="Logo Sekolah" class="logo">
            <ul class="nav-links">
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="/absensi">Data Absensi</a></li>
                <li><a href="/guru">Data Guru</a></li>
                <li><a href="{{ route('settings.index') }}">Pengaturan</a></li>
                <li><a href="/login">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="welcome-box">
                <h1>Selamat Datang</h1>
                <p>Di Website Absensi Guru</p>
            </div>
        </div>
</body>

</html>
