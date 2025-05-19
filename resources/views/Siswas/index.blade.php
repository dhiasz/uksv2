<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Siswa') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Daftar Siswa</h1>

            <a href="{{ route('siswas.create') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition mb-4 inline-block">
                Tambah Siswa
            </a>

            @if(session('success'))
                <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-700 border rounded text-center">
                    <thead>
                        <tr class="bg-red-700 dark:bg-gray-600 text-white">
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Kelas</th>
                            <th class="px-4 py-2 border">Umur</th>
                            <th class="px-4 py-2 border">Tinggi Badan</th>
                            <th class="px-4 py-2 border">Berat Badan</th>
                            <th class="px-4 py-2 border">Tensi</th>
                            <th class="px-4 py-2 border">Golongan Darah</th>
                            <th class="px-4 py-2 border">User</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswas as $index => $siswa)
                            <tr class="{{ $index % 2 === 0 ? 'bg-gray-100 dark:bg-gray-800' : 'bg-white dark:bg-gray-700' }}">
                                <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 border">{{ $siswa->nama }}</td>
                                <td class="px-4 py-2 border">{{ $siswa->kelas }}</td>
                                <td class="px-4 py-2 border">{{ $siswa->umur }}</td>
                                <td class="px-4 py-2 border">{{ $siswa->tb }} cm</td>
                                <td class="px-4 py-2 border">{{ $siswa->bb }} kg</td>
                                <td class="px-4 py-2 border">{{ $siswa->tensi ?? '-' }}</td>
                                <td class="px-4 py-2 border">{{ $siswa->goldar ?? '-' }}</td>
                                <td class="px-4 py-2 border">{{ $siswa->user->username ?? '-' }}</td>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('siswas.edit', $siswa->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">Edit</a>
                                    <form action="{{ route('siswas.destroy', $siswa->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center p-4 text-gray-500 dark:text-gray-400">Belum ada data siswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
