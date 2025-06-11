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
            {{ __('Data Siswa') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-900 shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-black">Siswa</h1>

            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('siswas.create') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                    Tambah Siswa
                </a>

            </div>

            @if(session('success'))
                <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full text-sm font-light text-white text-center">
                    <thead class="bg-green-800 border-b border-gray-700 uppercase">
                        <tr>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">NIS</th>
                            <th class="px-6 py-3">User</th>
                            <th class="px-6 py-3">Tanggal Lahir</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-white ">
                        @forelse($siswas as $index => $siswa)
                            <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} border-b border-gray-700">
                                <td class="px-6 py-3 text-black">{{ $siswa->nama }}</td>
                                <td class="px-6 py-3 text-black">{{ $siswa->nis }}</td>
                                <td class="px-6 py-3 text-black">{{ $siswa->user->username ?? '-' }}</td>
                                <td class="px-6 py-3 text-black">{{ $siswa->tgl}}</td>
                                <td class="px-6 py-3 text-black">
                                    <a href="{{ route('siswas.edit', $siswa->id) }}" class="edit-icon"></a>
                                    <form action="{{ route('siswas.destroy', $siswa->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="edit-icon-sampah"></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-4 text-gray-400">Belum ada data siswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination jika diperlukan --}}
            <div class="mt-4">
                {{ $siswas->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
