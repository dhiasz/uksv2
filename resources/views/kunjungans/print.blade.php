<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>Laporan Data Kunjungan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-top: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Data Kunjungan</h2>
        <p>Unit Kesehatan Sekolah</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Umur</th>
                <th>Keluhan</th>
                <th>Tindakan</th>
                <th>Obat</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kunjungans as $index => $kunjungan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                     <td class="px-4 py-2 border">{{ $kunjungan->nama }}</td>
                    <td class="px-4 py-2 border">{{ $kunjungan->kelas }}</td>
                    <td class="px-4 py-2 border text-center">{{ $kunjungan->umur }}</td>
                    <td class="px-4 py-2 border">{{ $kunjungan->keluhan }}</td>
                    <td class="px-4 py-2 border">{{ $kunjungan->tindakan }}</td>
                    <td class="px-4 py-2 border">
                        {{ $kunjungan->stokobat->obat->nama_obat ?? '-' }}
                    </td>
                    <td class="px-4 py-2 border">
                        {{ $kunjungan->user->username ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
    </div>
</body>
</html>
