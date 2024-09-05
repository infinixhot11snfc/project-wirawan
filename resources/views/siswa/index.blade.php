<!DOCTYPE html>
<html>

<head>
    <title>Data Siswa</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 20px;
            background: linear-gradient(135deg, #f8d7da, #c3e6cb);
        }

        h1 {
            color: #444;
        }

        /* Form Styles */
        form {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        form input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            flex-grow: 1;
            margin-right: 10px;
        }

        form button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        form button:hover {
            background-color: #218838;
        }

        /* Button Styles */
        button {
            padding: 8px 12px;
            margin-right: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #0069d9;
        }

        button.ubah {
            background-color: #ffc107;
            color: white;
        }

        button.ubah:hover {
            background-color: #e0a800;
        }

        button.hapus {
            background-color: red;
            color: white;
        }

        button.hapus:hover {
            background-color: darkred;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            background: linear-gradient(135deg, #f8d7da, #c3e6cb);
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: coral;
            color: #555;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            form input[type="text"] {
                width: 100%;
                margin-bottom: 10px;
            }

            table,
            th,
            td {
                font-size: 14px;
            }
        }

        .btn-plus {
            background: white;
            color: black;
            font-size: 20px;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-plus:hover {
            background: #ccc;
        }

        .btn-reload {
            background: white;
            color: black;
            font-size: 20px;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-reload:hover {
            background: #ccc;
        }

        .btn {
            background: white;
            color: black;
            font-size: 20px;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn:hover {
            background: #ccc;
        }
    </style>
</head>

<body>
    <h1>Data Siswa</h1>
    <form action="/aplikasisekolah/search" method="GET">
        <input type="text" name="query" placeholder="Cari nama siswa..." class="form-control">
        <button type="submit" class="btn">⌕</button>
    </form>
    <a href="{{ url('/siswa/tambah') }}" class="btn-plus">➕</a>
    <a href="{{ url('/aplikasisekolah/search') }}" class="btn-reload">🔄️</a>

    <br><br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Info</th>
        </tr>
        @if ($data_siswa->isEmpty())
            <tr>
                <td colspan="6" style="text-align: center;">Data Tidak ada</td>
            </tr>
        @else
            @foreach ($data_siswa as $siswa)
                <tr>
                    <td>{{ $siswa->id }}</td>
                    <td>{{ $siswa->name }}</td>
                    <td>{{ $siswa->email }}</td>
                    <td>{{ $siswa->address }}</td>
                    <td>{{ $siswa->birth_date }}</td>
                    <td>
                        <a href="{{ url('/siswa/detail', $siswa->id) }}"><button>Detail</button></a>
                        <a href="{{ url('/siswa/ubah', $siswa->id) }}"><button class="ubah">Ubah</button></a>
                        <form action="{{ url('/siswa/hapus', $siswa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hapus"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
</body>

</html>
