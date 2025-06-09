<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit Alat Medis</h1>

        <form action="{{ route('alatmedis.update', $alatmedis->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Alat Medis --}}
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama Alat</label>
                <input type="text" name="nama" id="nama" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('nama', $alatmedis->nama) }}" required>
                @error('nama')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kondisi --}}
            <div class="mb-4">
                <label for="kondisi" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Kondisi</label>
                <select name="kondisi" id="kondisi" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required>
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="Baik" {{ old('kondisi', $alatmedis->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak Ringan" {{ old('kondisi', $alatmedis->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="Rusak Berat" {{ old('kondisi', $alatmedis->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
                @error('kondisi')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- User ID (Tersembunyi) --}}
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            {{-- Tombol Update --}}
            <div class="flex justify-end space-x-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">Perbarui</button>
            </div>
        </form>
    </div>
</x-app-layout>
