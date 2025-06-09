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
            {{ __('Data Kesehatan') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Data Kesehatan</h1>

             <div class="flex justify-between items-center mb-4">
                <a href="{{ route('kesehatan.create') }}"
                   class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                    Tambah Data Kesehatan
                </a>

                <form method="GET" action="{{ route('siswas.index') }}" class="flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama"
                        class="px-4 py-2 rounded-md border bg-gray-100 text-black focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Cari
                    </button>
                </form>

            </div>

            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full text-sm font-light text-white text-center">
                    <thead class="bg-green-800 border-b border-gray-700 uppercase">
                        <tr>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Umur</th>
                            <th class="px-6 py-3">Tinggi (cm)</th>
                            <th class="px-6 py-3">Berat (kg)</th>
                            <th class="px-6 py-3">Tensi</th>
                            <th class="px-6 py-3">Golongan Darah</th>
                            <th class="px-6 py-3">User</th>
                            <th class="px-6 py-3">Dibuat</th>
                            <th class="px-6 py-3">Diedit</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @forelse($kesehatans as $kesehatan)
                            <tr class="{{ $loop->even ? 'bg-white' : 'bg-gray-50' }} border-b border-gray-700">
                                <td class="px-6 py-3 text-black">{{ $kesehatan->siswa->nama }}</td>
                                <td class="px-6 py-3 text-black">{{ $kesehatan->umur }}</td>
                                <td class="px-6 py-3 text-black">{{ $kesehatan->tb }}</td>
                                <td class="px-6 py-3 text-black">{{ $kesehatan->bb }}</td>
                                <td class="px-6 py-3 text-black">{{ $kesehatan->tensi ?? '-' }}</td>
                                <td class="px-6 py-3 text-black">{{ $kesehatan->goldar ?? '-' }}</td>
                                <td class="px-6 py-3 text-black">{{ $kesehatan->user->username ?? '-' }}</td>
                                <td class="px-6 py-3 text-black">{{ $kesehatan->created_at->format('d-m-Y H:i') }}</td>
                                <td class="px-6 py-3 text-black">{{ $kesehatan->updated_at->format('d-m-Y H:i') }}</td>
                                <td class="px-6 py-3 text-black">
                                    <a href="{{ route('kesehatan.edit', $kesehatan->id) }}" class="edit-icon" title="Edit"></a>
                                    <form action="{{ route('kesehatan.destroy', $kesehatan->id) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="edit-icon-sampah" title="Hapus"></button>
                                    </form>
                                    <a href="{{ route('kesehatan_historis.index', $kesehatan->id) }}"
                                       class="inline-block px-2 py-1 text-xs font-medium bg-green-600 text-white rounded hover:bg-green-700 mt-1">
                                        Lihat Historis
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-gray-400">Belum ada data kesehatan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $kesehatans->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
