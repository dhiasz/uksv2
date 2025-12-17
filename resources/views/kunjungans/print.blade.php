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
    <h2>Laporan Rekap Kunjungan UKS</h2>
    <p style="text-align:center;">
        Periode {{ \Carbon\Carbon::parse($start)->translatedFormat('F Y') }}
        s/d
        {{ \Carbon\Carbon::parse($end)->translatedFormat('F Y') }}
    </p>


    <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Umur</th>
            <th>Jumlah Kunjungan ke UKS</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kunjungans as $index => $kunjungan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $kunjungan->nama }}</td>
                <td>{{ $kunjungan->kelas }}</td>
                <td style="text-align:center;">{{ $kunjungan->umur }}</td>
                <td style="text-align:center; font-weight:bold;">
                    {{ $kunjungan->total_kunjungan }} kali
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
