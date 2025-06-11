<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Tambah Stok Obat</h1>

        <form action="{{ route('stokobats.store') }}" method="POST">
            @csrf

            {{-- Pilih Obat --}}
            <div class="mb-4">
                <label for="obat_id" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama Obat</label>
                <select name="obat_id" id="obat_id" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    @foreach($obats as $obat)
                        <option value="{{ $obat->id }}">{{ $obat->nama_obat }}</option>
                    @endforeach
                </select>
                @error('obat_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jumlah --}}
            <div class="mb-4">
                <label for="jumlah" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" min="1" value="{{ old('jumlah') }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                @error('jumlah')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tanggal Masuk --}}
            <div class="mb-4">
            <label for="masuk" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tanggal Masuk</label>
            <input type="date" name="masuk" id="masuk" 
                value="{{ old('masuk', \Carbon\Carbon::now()->format('Y-m-d')) }}" 
                class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" 
                readonly>
            @error('masuk')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>


            {{-- Kadaluarsa --}}
            <div class="mb-4">
                <label for="kadaluarsa" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tanggal Kadaluarsa</label>
                <input type="date" name="kadaluarsa" id="kadaluarsa" value="{{ old('kadaluarsa') }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                @error('kadaluarsa')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-4">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
