<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Absensi</title>
    <link href="{{ asset('css/Absensi/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

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
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Status Absensi</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendance as $index => $absen)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $absen->teacher->name }}</td>
                        <td>{{ $absen->date }}</td>
                        <td>{{ $absen->check_in_time }}</td>
                        <td>{{ $absen->check_out_time ?? '-' }}</td>
                        <td>{{ $absen->status }}</td>
                        <td>{{ $absen->remarks }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script>
    document.getElementById('search').addEventListener('input', function () {
        const searchValue = this.value;

        fetch(`/absensi?search=${searchValue}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const tbody = document.querySelector('.table-absensi tbody');
                tbody.innerHTML = '';

                data.absensi.forEach((absen, index) => {
                    const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${absen.teacher.name}</td>
                    <td>${absen.date}</td>
                    <td>${absen.check_in_time}</td>
                    <td>${absen.check_out_time || '-'}</td>
                    <td>${absen.status}</td>
                    <td>${absen.remarks}</td>
                </tr>`;
                    tbody.innerHTML += row;
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                alert('Terjadi kesalahan saat mengambil data.');
            });
</script>

</html>