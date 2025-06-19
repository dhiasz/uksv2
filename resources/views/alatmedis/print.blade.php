<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Alat Medis</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Data Alat Medis</h2>
    <table class="min-w-full text-sm font-light text-white text-center">
                    <thead class="bg-green-800 border-b border-gray-700 uppercase">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">kode</th>
                            <th class="px-6 py-3">Kondisi</th>
                            <th class="px-6 py-3">Ditambah pada</th>
                           
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @forelse($alatmedis as $index => $alat)
                            <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} border-b border-gray-700">
                                <td class="px-6 py-3 text-black">{{ $index + 1 }}</td>
                                <td class="px-6 py-3 text-black">{{ $alat->nama }}</td>
                                <td class="px-6 py-3 text-black">{{ $alat->kode }}</td>
                                <td class="px-6 py-3 text-black">{{ $alat->kondisi }}</td>
                                <td class="px-6 py-3 text-black">
                                {{ $alat->created_at->format('d-m-Y H:i') }}
                                </td>
                               
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-400">Belum ada data alat medis.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
</body>
</html>
