<x-app-layout>
        <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Stok Obat') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Daftar Stok Obat</h1>

                <a href="{{ route('stokobats.create') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition mb-4 inline-block">
                    Tambah Stok Obat
                </a>
                <a href="{{ route('stokobats.export') }}" 
                       class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">
                        Export stok obat
                    </a>
                <a href="{{ route('stokobats.print') }}" 
                       class="px-4 py-2 bg-red-700 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 transition">
                        Print stok obat
                </a>


                @if(session('success'))
                    <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 rounded-lg text-center">
                        <thead>
                            <tr class="bg-red-700 dark:bg-gray-600 text-white">
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nama Obat</th>
                                <th class="px-4 py-2 border">Jumlah</th>
                                <th class="px-4 py-2 border">Tanggal Masuk</th>
                                <th class="px-4 py-2 border">Kadaluarsa</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stokobats as $index => $stokobat)
                                <tr class="{{ $index % 2 === 0 ? 'bg-gray-100 dark:bg-gray-800' : 'bg-white dark:bg-gray-700' }}">
                                    <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 border">{{ $stokobat->obat->nama_obat ?? '-' }}</td>
                                    <td class="px-4 py-2 border">{{ $stokobat->jumlah }}</td>
                                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($stokobat->masuk)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($stokobat->kadaluarsa)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <a href="{{ route('stokobats.edit', $stokobat->id) }}" class="px-2 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600 transition">Edit</a>
                                        <form action="{{ route('stokobats.destroy', $stokobat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus stok ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-4 text-gray-500 dark:text-gray-400">Belum ada data stok obat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
