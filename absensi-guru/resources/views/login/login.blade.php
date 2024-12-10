<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Absensi Guru</title>
    <link rel="stylesheet" href="{{ asset('css/Login/style.css') }}">
</head>

<body>
    <div class="login-container">
        <!-- Logo Sekolah -->
        <img src="{{ asset('images/logoSD.png') }}" alt="Logo Sekolah">

        <!-- Judul Form -->
        <h2>Sistem Absensi Guru</h2>

        <!-- Form Login -->
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <!-- Input untuk Username -->
            <div class="input-icon">
                <img src="{{ asset('images/username.png') }}" alt="Icon User">
                <input type="text" name="username" placeholder="Username" required>
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input untuk Password -->
            <div class="input-icon">
                <img src="{{ asset('images/password4.png') }}" alt="Icon Password">
                <input type="password" name="password" placeholder="Password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pesan Error Umum -->
            @if($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Tombol Masuk -->
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>

</html>