<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit Data Kesehatan</h1>
        <form action="{{ route('kesehatan.update', $kesehatan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Siswa (readonly) --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama Siswa</label>
                <input type="text" value="{{ $kesehatan->siswa->nama }}" 
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 bg-gray-100 cursor-not-allowed" readonly>
                <input type="hidden" name="siswa_id" value="{{ $kesehatan->siswa_id }}">
            </div>

            {{-- Tampilkan NIS (readonly) --}}
            <div class="mb-4">
                <label for="nis_display" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">NIS</label>
                <input type="text" id="nis_display" 
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 bg-gray-100" 
                    value="{{ $kesehatan->siswa->nis }}" readonly>
            </div>

            {{-- Umur --}}
            <div class="mb-4">
                <label for="umur" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Umur</label>
                <input type="number" name="umur" id="umur" max="250"  min="140" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" 
                    value="{{ old('umur', $kesehatan->umur) }}" required>
                @error('umur')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tinggi Badan --}}
            <div class="mb-4">
                <label for="tb" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tinggi Badan (cm)</label>
                <input type="number" name="tb" id="tb" max="180" min="40" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" 
                    value="{{ old('tb', $kesehatan->tb) }}" required>
                @error('tb')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Berat Badan --}}
            <div class="mb-4">
                <label for="bb" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Berat Badan (kg)</label>
                <input type="number" name="bb" id="bb" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" 
                    value="{{ old('bb', $kesehatan->bb) }}" required>
                @error('bb')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tensi --}}
            <div class="mb-4">
                <label for="tensi" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tensi</label>
                <input type="text" name="tensi" id="tensi" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" 
                    value="{{ old('tensi', $kesehatan->tensi) }}" placeholder="Misal: 120/80">
                @error('tensi')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Golongan Darah --}}
            <div class="mb-4">
                <label for="goldar" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Golongan Darah</label>
                <select name="goldar" id="goldar" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200">
                    <option value="" {{ old('goldar', $kesehatan->goldar) == '' ? 'selected' : '' }}>-- Pilih Golongan Darah --</option>
                    <option value="A" {{ old('goldar', $kesehatan->goldar) == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('goldar', $kesehatan->goldar) == 'B' ? 'selected' : '' }}>B</option>
                    <option value="AB" {{ old('goldar', $kesehatan->goldar) == 'AB' ? 'selected' : '' }}>AB</option>
                    <option value="O" {{ old('goldar', $kesehatan->goldar) == 'O' ? 'selected' : '' }}>O</option>
                </select>
                @error('goldar')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- User ID tersembunyi --}}
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            {{-- Tombol Simpan --}}
            <div class="flex justify-end space-x-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
