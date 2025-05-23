<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Siswa') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-900 shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-white">Daftar Siswa</h1>

            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('siswas.create') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                    Tambah Siswa
                </a>

                <input type="text" placeholder="Search for items" class="px-4 py-2 rounded-md border bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full text-left text-sm font-light text-white">
                    <thead class="bg-gray-800 border-b border-gray-700 uppercase">
                        <tr>
                            <th class="px-6 py-3"><input type="checkbox" class="form-checkbox text-blue-500"></th>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Kelas</th>
                            <th class="px-6 py-3">Umur</th>
                            <th class="px-6 py-3">Tinggi</th>
                            <th class="px-6 py-3">Berat</th>
                            <th class="px-6 py-3">Tensi</th>
                            <th class="px-6 py-3">Gol. Darah</th>
                            <th class="px-6 py-3">User</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-200">
                        @forelse($siswas as $index => $siswa)
                            <tr class="{{ $index % 2 === 0 ? 'bg-gray-900' : 'bg-gray-800' }} border-b border-gray-700">
                                <td class="px-6 py-3"><input type="checkbox" class="form-checkbox text-blue-500"></td>
                                <td class="px-6 py-3">{{ $siswa->nama }}</td>
                                <td class="px-6 py-3">{{ $siswa->kelas }}</td>
                                <td class="px-6 py-3">{{ $siswa->umur }}</td>
                                <td class="px-6 py-3">{{ $siswa->tb }} cm</td>
                                <td class="px-6 py-3">{{ $siswa->bb }} kg</td>
                                <td class="px-6 py-3">{{ $siswa->tensi ?? '-' }}</td>
                                <td class="px-6 py-3">{{ $siswa->goldar ?? '-' }}</td>
                                <td class="px-6 py-3">{{ $siswa->user->username ?? '-' }}</td>
                                <td class="px-6 py-3">
                                    <a href="{{ route('siswas.edit', $siswa->id) }}" class="text-yellow-400 hover:underline text-sm mr-2">Edit</a>
                                    <form action="{{ route('siswas.destroy', $siswa->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-blue-500 hover:underline text-sm">Delete</button>
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
