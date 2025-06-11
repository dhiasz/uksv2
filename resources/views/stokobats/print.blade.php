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

    <table class="min-w-full text-sm font-light text-white text-center">
                    <thead class="bg-green-800 border-b border-gray-700 uppercase">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama Obat</th>
                            <th class="px-6 py-3">Jumlah</th>
                            <th class="px-6 py-3">Dosis</th>
                            <th class="px-6 py-3">Tanggal Masuk</th>
                            <th class="px-6 py-3">Kadaluarsa</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @forelse($stokobats as $index => $stokobat)
                            <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} border-b border-gray-700">
                                <td class="px-6 py-3 text-black">{{ $index + 1 }}</td>
                                <td class="px-6 py-3 text-black">{{ $stokobat->obat->nama_obat ?? '-' }}</td>
                                <td class="px-6 py-3 text-black">{{ $stokobat->jumlah . ' ' .  $stokobat->obat->satuan }}</td>
                                <td class="px-6 py-3 text-black">{{ $stokobat->obat->dosis }}</td>
                                <td class="px-6 py-3 text-black">{{ \Carbon\Carbon::parse($stokobat->masuk)->format('d-m-Y') }}</td>
                                <td class="px-6 py-3 {{ $stokobat->sudah_kadaluarsa || $stokobat->hampir_kadaluarsa ? 'text-red-600 font-semibold' : 'text-black' }}">
                                    {{ \Carbon\Carbon::parse($stokobat->kadaluarsa)->format('d-m-Y') }}
                                    @if($stokobat->sudah_kadaluarsa)
                                        <span class="text-xs italic"> (Kadaluarsa)</span>
                                    @elseif($stokobat->hampir_kadaluarsa)
                                        <span class="text-xs italic"> (Segera Kadaluarsa)</span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-400">Belum ada data stok obat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
    </div>
</body>
</html>
