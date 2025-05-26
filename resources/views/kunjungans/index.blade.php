<x-app-layout>
    <style>
    .edit-icon {
        background-image: url('edit.png');
        width: 19px;
        height: 19px;
        background-size: cover;
        display: inline-block;
        transition: background-image 0.3s ease;
    }

    .edit-icon:hover {
        background-image: url('edit (1).png');
    }

    .edit-icon-sampah {
        background-image: url('bin.png');
        width: 19px;
        height: 19px;
        background-size: cover;
        display: inline-block;
        transition: background-image 0.3s ease;
    }

    .edit-icon-sampah:hover {
        background-image: url('bin (1).png');
    }
</style>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Kunjungan') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Daftar Kunjungan</h1>

           <div class="flex flex-wrap gap-2 mb-4">
            <a href="{{ route('kunjungans.create') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                Tambah Kunjungan
            </a>

            <a href="{{ route('kunjungans.print') }}" class="px-4 py-2 bg-red-700 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 transition">
                Laporan
            </a>

            @if(request()->query('semua') !== 'true')
                <a href="{{ route('kunjungans.index', ['semua' => 'true']) }}" class="px-4 py-2 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-800 transition">
                    Tampilkan Semua Kunjungan
                </a>
            @else
                <a href="{{ route('kunjungans.index') }}" class="px-4 py-2 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-800 transition">
                    Tampilkan Kunjungan Hari Ini
                </a>
            @endif
        </div>
             <div class="overflow-x-auto">
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
                        <th class="px-6 py-3">Tgl Kunjungan</th>
                        <th class="px-6 py-3">Tgl Diedit</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    @forelse($kunjungans as $index => $kunjungan)
                        <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} border-b border-gray-700">
                            <td class="px-6 py-3 text-black">{{ $kunjungan->nama }}</td>
                            <td class="px-6 py-3 text-black">{{ $kunjungan->kelas }}</td>
                            <td class="px-6 py-3 text-black">{{ $kunjungan->umur }}</td>
                            <td class="px-6 py-3 text-black">{{ $kunjungan->keluhan }}</td>
                            <td class="px-6 py-3 text-black">{{ $kunjungan->tindakan }}</td>
                            <td class="px-6 py-3 text-black">
                                {{ $kunjungan->stokobat->obat->nama_obat ?? '-' }}
                            </td>
                            <td class="px-6 py-3 text-black">
                                {{ $kunjungan->user->username ?? '-' }}
                            </td>
                            <td class="px-6 py-3 text-black">
                                {{ $kunjungan->created_at->format('d-m-Y H:i') }}
                            </td>
                            <td class="px-6 py-3 text-black">
                                {{ $kunjungan->updated_at->format('d-m-Y H:i') }}
                            </td>
                            <td class="px-6 py-3 text-black">
                                <a href="{{ route('kunjungans.edit', $kunjungan->id) }}" class="edit-icon" title="Edit"></a>
                                <form action="{{ route('kunjungans.destroy', $kunjungan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kunjungan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="edit-icon-sampah" title="Hapus"></button>
                                </form>
                                <a href="{{ route('rujukans.create', $kunjungan->id) }}" target="_blank"
                                class="inline-block px-2 py-1 text-xs font-medium bg-green-600 text-white rounded hover:bg-green-700 mt-1">
                                    Buat Rujukan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-gray-400">Belum ada data kunjungan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
            <div class="mt-4">
            {{ $kunjungans->links() }}
            </div>

            </div>



            <div class="mt-8">
            <canvas id="grafikKunjungan" class="w-full h-64"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('grafikKunjungan').getContext('2d');
                const grafikKunjungan = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($statistik->keys()) !!}, // contoh: ["Mei 2025", "Juni 2025"]
                        datasets: [{
                            label: 'Jumlah Kunjungan per Bulan',
                            data: {!! json_encode($statistik->values()) !!},
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });
            </script>






            </div>
        </div>
    </div>
</x-app-layout>
