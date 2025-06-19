<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Daftar Total Stok Obat</h1>

        <div class="overflow-x-auto rounded-lg">
            <table class="min-w-full text-sm font-light text-white text-center">
                <thead class="bg-green-800 border-b border-gray-700 uppercase">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama Obat</th>
                        <th class="px-6 py-3">Golongan Obat</th>
                        <th class="px-6 py-3">kategori</th>
                        <th class="px-6 py-3">bentuk Sediaan</th>
                        <th class="px-6 py-3">Satuan</th>
                        <th class="px-6 py-3">dosis</th>
                        <th class="px-6 py-3">Total Stok</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    @forelse($obats as $index => $obat)
                        <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} border-b border-gray-700">
                            <td class="px-6 py-3 text-black">{{ $index + 1 }}</td>
                            <td class="px-6 py-3 text-black">{{ $obat->nama_obat }}</td>
                            <td class="px-6 py-3 text-black">{{ $obat->golongan_obat }}</td>
                            <td class="px-6 py-3 text-black">{{ $obat->kategori }}</td>
                            <td class="px-6 py-3 text-black">{{ $obat->sediaan }}</td>
                            <td class="px-6 py-3 text-black">{{ $obat->satuan }}</td>
                            <td class="px-6 py-3 text-black">{{ $obat->dosis }}</td>
                            <td class="px-4 py-2 text-gray-700 dark:text-gray-300">
                                {{ $obat->totalStok->jumlah ?? 0 }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-400">Belum ada data obat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

