<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Penduduk</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penduduks as $penduduk)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $penduduk->nama }}</td>
                <td>{{ $penduduk->alamat }}</td>
                <td>{{ $penduduk->jenis_kelamin }}</td>
                <td>{{ $penduduk->tanggal_lahir }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
