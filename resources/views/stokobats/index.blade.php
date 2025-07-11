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
        <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengadaan Obat') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Pengadaan Obat</h1>

                <a href="{{ route('stokobats.create') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition mb-4 inline-block">
                    Pengadaan Obat
                </a>

                @if(session('success'))
                    <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

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
                            <th class="px-6 py-3">Aksi</th>
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

                                <td class="px-6 py-3 text-black">
                                    <form action="{{ route('stokobats.destroy', $stokobat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus stok ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="edit-icon-sampah" title="Hapus"></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-400">Belum ada data stok obat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>
