<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Absensi</title>
    <link href="{{ asset('css/Absensi/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="{{ asset('images/logoSD.png') }}" alt="Logo Sekolah">
        </div>
        <div class="breadcrumb">
            <span><a href="{{ route('dashboard') }}">Dashboard</a> > Data Absensi</span>
        </div>
    </div>
    <div class="content">
        <h1>Data Absensi</h1>
        <div class="search-filter">
            <div class="filter">
                <button>Filter &#9776;</button>
            </div>
            <div class="search">
                <label for="search">Search: </label>
                <input type="text" id="search" name="search">
            </div>
        </div>
        <table class="table-absensi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Guru</th>
                    <th>Mata Pelajaran</th>
                    <th>Lokasi</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absensi as $index => $absen)
                    @if($absen)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $absen->guru->name }}</td>
                            <td>{{ $absen->mata_pelajaran }}</td>
                            <td>{{ $absen->lokasi }}</td>
                            <td>{{ $absen->jam_masuk }}</td>
                            <td>{{ $absen->jam_keluar ?? '-' }}</td>
                            <td>{{ $absen->keterangan }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="7">Data tidak tersedia</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>