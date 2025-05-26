<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Tambah Kunjungan</h1>
        <form action="{{ route('kunjungans.store') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama</label>
                <input type="text" name="nama" id="nama" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kelas --}}
            <div class="mb-4">
                <label for="kelas" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Kelas</label>
                <input type="text" name="kelas" id="kelas" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('kelas') }}" required>
                @error('kelas')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Umur --}}
            <div class="mb-4">
                <label for="umur" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Umur</label>
                <input type="number" name="umur" id="umur" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('umur') }}" required>
                @error('umur')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Keluhan --}}
            <div class="mb-4">
                <label for="keluhan" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Keluhan</label>
                <textarea name="keluhan" id="keluhan" rows="3" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required>{{ old('keluhan') }}</textarea>
                @error('keluhan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tindakan --}}
            <div class="mb-4">
                <label for="tindakan" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tindakan</label>
                <textarea name="tindakan" id="tindakan" rows="3" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required>{{ old('tindakan') }}</textarea>
                @error('tindakan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Pilih Obat --}}
            <div class="mb-4">
                <label for="sobat_id" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Obat yang Digunakan</label>
                <select name="sobat_id" id="sobat_id" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200">
                    <option value="">-- Pilih Obat --</option>
                    @foreach($stokobats as $stok)
                        <option value="{{ $stok->id }}" {{ old('sobat_id') == $stok->id ? 'selected' : '' }}>
                            {{ $stok->obat->nama_obat }} (Stok: {{ $stok->jumlah }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- User ID (tersembunyi atau dari session) --}}
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            {{-- Tombol Simpan dan Kembali --}}
            <div class="flex justify-end space-x-4">
                <a href="{{ route('kunjungans.index') }}" class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
