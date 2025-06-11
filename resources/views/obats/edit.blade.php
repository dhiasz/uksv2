<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit Obat</h1>
        <form action="{{ route('obats.update', $obat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_obat" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama Obat</label>
                <input type="text" name="nama_obat" id="nama_obat" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
                @error('nama_obat')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="golongan_obat" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Golongan Obat</label>
                <select name="golongan_obat" id="golongan_obat" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required>
                    <option value="">-- Pilih Golongan --</option>
                    <option value="Obat Bebas" {{ old('golongan_obat', $obat->golongan_obat) == 'Obat Bebas' ? 'selected' : '' }}>Obat Bebas</option>
                    <option value="Obat Bebas Terbatas" {{ old('golongan_obat', $obat->golongan_obat) == 'Obat Bebas Terbatas' ? 'selected' : '' }}>Obat Bebas Terbatas</option>
                    <option value="Obat Keras" {{ old('golongan_obat', $obat->golongan_obat) == 'Obat Keras' ? 'selected' : '' }}>Obat Keras</option>
                    <option value="Obat Keras" {{ old('golongan_obat', $obat->golongan_obat) == 'Obat Herbal Terstandar' ? 'selected' : '' }}>Obat Herbal Terstandar</option>
                </select>
                @error('golongan_obat')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="kategori" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Kategori</label>
                <select name="kategori" id="kategori" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Antibiotik" {{ old('kategori', $obat->kategori) == 'Antibiotik' ? 'selected' : '' }}>Antibiotik</option>
                    <option value="Analgesik" {{ old('kategori', $obat->kategori) == 'Analgesik' ? 'selected' : '' }}>Analgesik</option>
                    <option value="Antipiretik" {{ old('kategori', $obat->kategori) == 'Antipiretik' ? 'selected' : '' }}>Antipiretik</option>
                    <option value="Vitamin" {{ old('kategori', $obat->kategori) == 'Vitamin' ? 'selected' : '' }}>Vitamin</option>
                </select>
                @error('kategori')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="sediaan" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Sediaan</label>
                <select name="sediaan" id="sediaan" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required>
                    <option value="">-- Pilih Sediaan --</option>
                    <option value="Tablet" {{ old('sediaan', $obat->sediaan) == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                    <option value="Kapsul" {{ old('sediaan', $obat->sediaan) == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                    <option value="Sirup" {{ old('sediaan', $obat->sediaan) == 'Sirup' ? 'selected' : '' }}>Sirup</option>
                    <option value="Salep" {{ old('sediaan', $obat->sediaan) == 'Salep' ? 'selected' : '' }}>Salep</option>
                </select>
                @error('sediaan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="satuan" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Satuan</label>
                <select name="satuan" id="satuan" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required>
                    <option value="mg" {{ old('satuan') == 'Pcs' ? 'selected' : '' }}>mg</option>
                    <option value="ml" {{ old('satuan') == 'Botol' ? 'selected' : '' }}>ml</option>
                </select>
                @error('satuan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="dosis" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Dosis</label>
                <input type="text" name="dosis" id="dosis" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('dosis', $obat->dosis) }}" required>
                @error('dosis')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
