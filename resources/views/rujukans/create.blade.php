<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Tambah Rujukan untuk : {{ $kunjungan->siswa->nama }}</h1>
        <form action="{{ route('rujukans.store', $kunjungan->id) }}" method="POST" target="_blank">
            @csrf

            {{-- Alamat --}}
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('alamat') }}" required>
                @error('alamat')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Diagnosa --}}
            <div class="mb-4">
                <label for="diagnosa" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Diagnosa</label>
                <input type="text" name="diagnosa" id="diagnosa" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('diagnosa') }}" required>
                @error('diagnosa')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tujuan --}}
            <div class="mb-4">
                <label for="tujuan" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tujuan</label>
                <input type="text" name="tujuan" id="tujuan" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('tujuan') }}" required>
                @error('tujuan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div id="notif" class="mb-4"></div>
            {{-- Tombol Simpan --}}
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-900 transition">
                    Buat Rujukan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

