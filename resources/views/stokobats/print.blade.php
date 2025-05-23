<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Stok Obat</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Laporan Data Stok Obat</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Tanggal Masuk</th>
                <th>Kadaluarsa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stokobats as $index => $stokobat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $stokobat->obat->nama_obat ?? '-' }}</td>
                    <td>{{ $stokobat->jumlah }}</td>
                    <td>{{ \Carbon\Carbon::parse($stokobat->masuk)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($stokobat->kadaluarsa)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
