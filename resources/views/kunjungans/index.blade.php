<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Kunjungan') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('kunjungans.create') }}" class="mb-4 inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Tambah Kunjungan
        </a>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-center">No</th>
                        <th class="px-4 py-2 text-center">Nama</th>
                        <th class="px-4 py-2 text-center">Kelas</th>
                        <th class="px-4 py-2 text-center">Umur</th>
                        <th class="px-4 py-2 text-center">Keluhan</th>
                        <th class="px-4 py-2 text-center">Tindakan</th>
                        <th class="px-4 py-2 text-center">Obat</th>
                        <th class="px-4 py-2 text-center">User</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kunjungans as $index => $kunjungan)
                        <tr class="text-center">
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $kunjungan->nama }}</td>
                            <td class="border px-4 py-2">{{ $kunjungan->kelas }}</td>
                            <td class="border px-4 py-2">{{ $kunjungan->umur }}</td>
                            <td class="border px-4 py-2">{{ $kunjungan->keluhan }}</td>
                            <td class="border px-4 py-2">{{ $kunjungan->tindakan }}</td>
                            <td class="border px-4 py-2">{{ $kunjungan->stokobat->obat->nama_obat ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $kunjungan->user->username ?? '-' }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('kunjungans.edit', $kunjungan->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>