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
            {{ __('Data Alat Medis') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Daftar Alat Medis</h1>

            <a href="{{ route('alatmedis.create') }}"
               class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition mb-4 inline-block">
                Tambah Alat Medis
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
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Kondisi</th>
                            <th class="px-6 py-3">Ditambah pada</th>
                            <th class="px-6 py-3">Diedit pada</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @forelse($alatmedis as $index => $alat)
                            <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} border-b border-gray-700">
                                <td class="px-6 py-3 text-black">{{ $index + 1 }}</td>
                                <td class="px-6 py-3 text-black">{{ $alat->nama }}</td>
                                <td class="px-6 py-3 text-black">{{ $alat->kondisi }}</td>
                                <td class="px-6 py-3 text-black">
                                {{ $alat->created_at->format('d-m-Y H:i') }}
                                </td>
                                <td class="px-6 py-3 text-black">
                                    {{ $alat->updated_at->format('d-m-Y H:i') }}
                                </td>
                                <td class="px-6 py-3 text-black">
                                    <a href="{{ route('alatmedis.edit', $alat->id) }}" class="edit-icon" title="Edit"></a>
                                    <form action="{{ route('alatmedis.destroy', $alat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus alat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="edit-icon-sampah" title="Hapus"></button>
                                    </form>
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

        </div>
    </div>
</x-app-layout>
