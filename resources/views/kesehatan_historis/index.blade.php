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
            {{ __('Histori Kesehatan') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

            <h1 class="text-2xl font-bold mb-6">Histori Kesehatan: {{ $kesehatan->siswa->nama ?? 'Tidak diketahui' }}</h1>

            <a href="{{ route('kesehatan.index') }}" 
               class="inline-block mb-6 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
               &larr; Kembali ke Data Kesehatan
            </a>

            {{-- Data Terbaru Saat Ini --}}
            <div class="mb-8 p-4 bg-gray-100 dark:bg-gray-700 rounded shadow">
                <h2 class="text-xl font-semibold mb-3">Data Terbaru Saat Ini</h2>
                <table class="min-w-full text-left text-black">
                    <tr>
                        <th class="px-4 py-2">Umur</th>
                        <td class="px-4 py-2">{{ $kesehatan->umur }}</td>
                    </tr>
                    <tr class="bg-gray-200 dark:bg-gray-600">
                        <th class="px-4 py-2">Tinggi (cm)</th>
                        <td class="px-4 py-2">{{ $kesehatan->tb }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2">Berat (kg)</th>
                        <td class="px-4 py-2">{{ $kesehatan->bb }}</td>
                    </tr>
                    <tr class="bg-gray-200 dark:bg-gray-600">
                        <th class="px-4 py-2">Tensi</th>
                        <td class="px-4 py-2">{{ $kesehatan->tensi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2">Golongan Darah</th>
                        <td class="px-4 py-2">{{ $kesehatan->goldar ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            {{-- Daftar Histori --}}
            <div class="overflow-x-auto rounded-lg">
                @if($historis->count())
                <table class="min-w-full text-sm font-light text-white text-center">
                    <thead class="bg-green-800 border-b border-gray-700 uppercase">
                            <tr>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Umur</th>
                                <th class="px-6 py-3">Tinggi (cm)</th>
                                <th class="px-6 py-3">Berat (kg)</th>
                                <th class="px-6 py-3">Tensi</th>
                                <th class="px-6 py-3">Golongan Darah</th>
                            </tr>
                        </thead>
                        <tbody class="text-white">
                            @foreach($historis as $item)
                                <tr class="{{ $loop->even ? 'bg-white' : 'bg-gray-50' }} border-b border-gray-700 text-black">
                                    <td class="px-6 py-3">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="px-6 py-3">{{ $item->umur }}</td>
                                    <td class="px-6 py-3">{{ $item->tb }}</td>
                                    <td class="px-6 py-3">{{ $item->bb }}</td>
                                    <td class="px-6 py-3">{{ $item->tensi ?? '-' }}</td>
                                    <td class="px-6 py-3">{{ $item->goldar ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $historis->links() }}
                    </div>
                @else
                    <p class="text-gray-600 text-center py-6">Belum ada data histori untuk kesehatan ini.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
