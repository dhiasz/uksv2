<x-app-layout>
    <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6">Edit Stok Obat</h2>

        <form action="{{ route('stokobats.update', $stokobat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="obat_id" class="block font-medium text-gray-700">Nama Obat</label>
                <select name="obat_id" id="obat_id" class="w-full border rounded px-3 py-2">
                    @foreach ($obats as $obat)
                        <option value="{{ $obat->id }}" {{ $obat->id == $stokobat->obat_id ? 'selected' : '' }}>
                            {{ $obat->nama_obat }}
                        </option>
                    @endforeach
                </select>
                @error('obat_id') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="jumlah" class="block font-medium text-gray-700">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $stokobat->jumlah) }}" class="w-full border rounded px-3 py-2" required>
                @error('jumlah') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="kadaluarsa" class="block font-medium text-gray-700">Tanggal Kadaluarsa</label>
                <input type="date" name="kadaluarsa" id="kadaluarsa" value="{{ old('kadaluarsa', \Carbon\Carbon::parse($stokobat->kadaluarsa)->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2" required>
                @error('kadaluarsa') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal" class="block font-medium text-gray-700">Tanggal Masuk</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($stokobat->masuk)->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2" required>
                @error('tanggal') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('stokobats.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Perbarui</button>
            </div>
        </form>
    </div>
</x-app-layout>
