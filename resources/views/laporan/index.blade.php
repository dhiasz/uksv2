<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        {{-- Laporan Kunjungan --}}
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Laporan Kunjungan</h1>

            @if(session('success'))
                <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('laporan.kunjungan.filter') }}" method="GET" class="flex flex-wrap items-end gap-4">
                <div class="flex flex-col">
                    <label for="start_month" class="mb-1 font-medium text-gray-700 dark:text-gray-200">Dari Bulan:</label>
                    <input type="month" id="start_month" name="start_month" required value="{{ request('start_month') ?? '' }}" class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>
                <div class="flex flex-col">
                    <label for="end_month" class="mb-1 font-medium text-gray-700 dark:text-gray-200">Sampai Bulan:</label>
                    <input type="month" id="end_month" name="end_month" required value="{{ request('end_month') ?? '' }}" class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>
                <div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tampilkan Data</button>
                </div>
            </form>

            @if(isset($kunjungans))
                <h3 class="text-lg font-semibold mt-8">Hasil Data Kunjungan</h3>
                <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full text-sm font-light text-white text-center">
                        <thead class="bg-green-800 border-b border-gray-700 uppercase">
                            <tr>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">Kelas</th>
                                <th class="px-6 py-3">Umur</th>
                                <th class="px-6 py-3">Keluhan</th>
                                <th class="px-6 py-3">Tindakan</th>
                                <th class="px-6 py-3">Obat</th>
                                <th class="px-6 py-3">User</th>
                            </tr>
                        </thead>
                        <tbody class="text-white">
                            @forelse($kunjungans as $index => $kunjungan)
                                <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} border-b border-gray-700">
                                    <td class="px-6 py-3 text-black">{{ $kunjungan->siswa->nama ?? '-' }}</td>
                                    <td class="px-6 py-3 text-black">{{ $kunjungan->kelas }}</td>
                                    <td class="px-6 py-3 text-black">{{ $kunjungan->umur }}</td>
                                    <td class="px-6 py-3 text-black">{{ $kunjungan->keluhan }}</td>
                                    <td class="px-6 py-3 text-black">{{ $kunjungan->tindakan }}</td>
                                    <td class="px-6 py-3 text-black">{{ $kunjungan->stokobat->obat->nama_obat ?? '-' }}</td>
                                    <td class="px-6 py-3 text-black">{{ $kunjungan->user->username ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-gray-400">Belum ada data kunjungan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <form action="{{ route('laporan.kunjungan.pdf') }}" method="GET" class="mt-6">
                    <input type="hidden" name="start_month" value="{{ request('start_month') ?? '' }}">
                    <input type="hidden" name="end_month" value="{{ request('end_month') ?? '' }}">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Download PDF</button>
                </form>
            @endif
        </div>

        {{-- Laporan Obat --}}
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mt-8">
            <h1 class="text-2xl font-bold mb-6">Laporan Obat</h1>

            <form action="{{ route('laporan.obat.filter') }}" method="GET" class="flex flex-wrap items-end gap-4">
                <div class="flex flex-col">
                    <label for="obatstart_month" class="mb-1 font-medium text-gray-700 dark:text-gray-200">Dari Bulan:</label>
                    <input type="month" id="obatstart_month" name="obatstart_month" required value="{{ request('obatstart_month') ?? '' }}" class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>
                <div class="flex flex-col">
                    <label for="obatend_month" class="mb-1 font-medium text-gray-700 dark:text-gray-200">Sampai Bulan:</label>
                    <input type="month" id="obatend_month" name="obatend_month" required value="{{ request('obatend_month') ?? '' }}" class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                </div>
                <div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tampilkan Data</button>
                </div>
            </form>

            @if(isset($stokobats))
                <h3 class="text-lg font-semibold mt-8">Hasil Data Obat</h3>
                <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full text-sm font-light text-white text-center">
                        <thead class="bg-green-800 border-b border-gray-700 uppercase">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Nama Obat</th>
                                <th class="px-6 py-3">Tersisa</th>
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
                                    <td class="px-6 py-3 text-black">{{ $stokobat->jumlah . ' ' . $stokobat->obat->satuan }}</td>
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
                                    <td colspan="7" class="text-center py-4 text-gray-400">Belum ada data stok obat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <form action="{{ route('laporan.obat.pdf') }}" method="GET" target="_blank" class="mt-6">
                    <input type="hidden" name="obatstart_month" value="{{ request('obatstart_month') ?? '' }}">
                    <input type="hidden" name="obatend_month" value="{{ request('obatend_month') ?? '' }}">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Download PDF</button>
                </form>
            @endif
        </div>


    {{-- Laporan Alat Medis --}}
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mt-8">
        <h1 class="text-2xl font-bold mb-6">Laporan Alat Medis</h1>

        <form action="{{ route('laporan.alatmedis.filter') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex flex-col">
                <label for="alatstart_month" class="mb-1 font-medium text-gray-700 dark:text-gray-200">Dari Bulan:</label>
                <input type="month" id="alatstart_month" name="alatstart_month" required value="{{ request('alatstart_month') ?? '' }}" class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
            </div>
            <div class="flex flex-col">
                <label for="alatend_month" class="mb-1 font-medium text-gray-700 dark:text-gray-200">Sampai Bulan:</label>
                <input type="month" id="alatend_month" name="alatend_month" required value="{{ request('alatend_month') ?? '' }}" class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tampilkan Data</button>
            </div>
        </form>

        @if(isset($alatmedis))
            <h3 class="text-lg font-semibold mt-8">Hasil Data Alat Medis</h3>
            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full text-sm font-light text-white text-center">
                    <thead class="bg-green-800 border-b border-gray-700 uppercase">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Kode</th>
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
            </div>

            <form action="{{ route('laporan.alatmedis.cetak') }}" method="GET" target="_blank" class="mt-6">
                <input type="hidden" name="alatstart_month" value="{{ request('alatstart_month') ?? '' }}">
                <input type="hidden" name="alatend_month" value="{{ request('alatend_month') ?? '' }}">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Download PDF</button>
            </form>
        @endif
    </div>


    </div>

</x-app-layout>
