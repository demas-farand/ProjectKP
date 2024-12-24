<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Guru</title>
    <link href="{{ asset('css/DataGuru/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="{{ asset('images/logoSD.png') }}" alt="Logo Sekolah">
        </div>
        <div class="breadcrumb">
            <span><a href="{{ route('dashboard') }}">Dashboard</a> > Data Guru</span>
        </div>
    </div>
    <div class="content">
        <h1>Data Guru</h1>
        <div class="search-filter">
            <div class="filter">
                <button>Filter &#9776;</button>
            </div>
            <div class="search">
                <form action="{{ route('absensi.guru.index') }}" method="GET">
                    <label for="search">Search: </label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}">
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>
        <div style="margin-bottom: 20px;">
            <a href="{{ route('absensi.guru.create') }}" class="btn btn-create">Buat Data Guru Baru</a>
        </div>
        <table class="table-guru">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Guru</th>
                    <th>E-mail</th>
                    <th>No-telp</th>
                    <th>Mata Pelajaran</th>
                    <th>Action</th>
                    <th>QR Code</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guru as $index => $g)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $g->nama }}</td>
                        <td>{{ $g->email }}</td>
                        <td>{{ $g->no_telp }}</td>
                        <td>{{ $g->mata_pelajaran }}</td>
                        <td>
                            <a href="{{ route('absensi.guru.edit', $g->id) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('absensi.guru.destroy', $g->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ url('/guru/generate-qrcode/' . $g->id) }}" method="GET" target="_blank">
                                <button type="submit" class="btn btn-qrcode">Generate QR Code</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script>
    function absenTeacher(teacherId) {
        fetch(`/dataguru/${teacherId}/absen`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengabsen.');
            });
    }
</script>

</html>