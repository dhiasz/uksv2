<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit Obat</h1>
        <form action="{{ route('obats.update', $obat->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Obat --}}
            <div class="mb-4">
                <label for="nama_obat" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama Obat</label>
                <input
                    type="text"
                    name="nama_obat"
                    id="nama_obat"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    value="{{ old('nama_obat', $obat->nama_obat) }}"
                    required>
                @error('nama_obat')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jenis Obat --}}
            <div class="mb-4">
                <label for="jenis_obat" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Jenis Obat</label>
                <input
                    type="text"
                    name="jenis_obat"
                    id="jenis_obat"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    value="{{ old('jenis_obat', $obat->jenis_obat) }}"
                    required>
                @error('jenis_obat')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Satuan --}}
            <div class="mb-4">
                <label for="satuan" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Satuan</label>
                <input
                    type="text"
                    name="satuan"
                    id="satuan"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    value="{{ old('satuan', $obat->satuan) }}"
                    required>
                @error('satuan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="mb-4">
                <label for="kategori" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Kategori</label>
                <input
                    type="text"
                    name="kategori"
                    id="kategori"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    value="{{ old('kategori', $obat->kategori) }}"
                    required>
                @error('kategori')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Dosis --}}
            <div class="mb-4">
                <label for="dosis" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Dosis</label>
                <input
                    type="text"
                    name="dosis"
                    id="dosis"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    value="{{ old('dosis', $obat->dosis) }}"
                    required>
                @error('dosis')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol aksi --}}
            <div class="flex justify-end space-x-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
