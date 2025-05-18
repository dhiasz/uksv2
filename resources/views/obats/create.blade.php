<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Tambah Obat</h1>
        <form action="{{ route('obats.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama_obat" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama Obat</label>
                <input type="text" name="nama_obat" id="nama_obat" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('nama_obat') }}" required>
                @error('nama_obat')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jenis_obat" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Jenis Obat</label>
                <input type="text" name="jenis_obat" id="jenis_obat" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('jenis_obat') }}" required>
                @error('jenis_obat')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('obats.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
