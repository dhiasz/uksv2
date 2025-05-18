<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit Kunjungan</h1>
        <form action="{{ route('kunjungans.update', $kunjungan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $kunjungan->nama) }}" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                @error('nama')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="kelas" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Kelas</label>
                <input type="text" name="kelas" id="kelas" value="{{ old('kelas', $kunjungan->kelas) }}" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                @error('kelas')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="umur" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Umur</label>
                <input type="number" name="umur" id="umur" value="{{ old('umur', $kunjungan->umur) }}" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                @error('umur')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="keluhan" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Keluhan</label>
                <textarea name="keluhan" id="keluhan" rows="3" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">{{ old('keluhan', $kunjungan->keluhan) }}</textarea>
                @error('keluhan')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="tindakan" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tindakan</label>
                <textarea name="tindakan" id="tindakan" rows="3" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">{{ old('tindakan', $kunjungan->tindakan) }}</textarea>
                @error('tindakan')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('kunjungans.index') }}" class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
