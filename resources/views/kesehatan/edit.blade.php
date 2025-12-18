<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit Data Kesehatan</h1>
            @if (session('info'))
                <div class="mb-4 p-4 bg-yellow-100 border border-yellow-400 text-yellow-800 rounded">
                    {{ session('info') }}
                </div>
            @endif
        <form action="{{ route('kesehatan.update', $kesehatan->id) }}" method="POST">
            @csrf
            @method('PUT')


            {{-- Nama --}}
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama</label>
                <input type="text" name="nama" id="nama" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('nama', $kesehatan->nama) }}" placeholder="Masukan Nama siswa" required>
                @error('nama')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Usia --}}
            <div class="mb-4">
                <label for="umur" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Usia</label>
                <input type="number" name="umur" id="umur" min="15" max="250" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('umur', $kesehatan->umur) }}" required>
                @error('umur')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tinggi Badan --}}
            <div class="mb-4">
                <label for="tb" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tinggi Badan (cm)</label>
                <input type="number" name="tb" id="tb" min="0" max="250" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('tb', $kesehatan->tb) }}" required>
                @error('tb')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Berat Badan --}}
            <div class="mb-4">
                <label for="bb" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Berat Badan (kg)</label>
                <input type="number" name="bb" id="bb" min="0" max="180" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('bb', $kesehatan->bb) }}" required>
                @error('bb')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tensi --}}
            <div class="mb-4">
                <label for="tensi" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tensi</label>
                <input type="text" name="tensi" id="tensi" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('tensi', $kesehatan->tensi) }}" placeholder="Misal: 120/80">
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

            {{-- User ID --}}
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            {{-- Tombol Simpan --}}
            <div class="flex justify-end space-x-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600">
                    Perbarui
                </button>
            </div>
        </form>
    </div>

    {{-- JS: sama seperti di form create --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('tensi').addEventListener('input', function () {
        if (this.value.includes('-')) {
            this.value = this.value.replace(/-/g, '');
        }
    });

    document.getElementById('tb').addEventListener('input', function () {
        if (this.value > 250) this.value = 250;
    });

    document.getElementById('bb').addEventListener('input', function () {
        if (this.value > 180) this.value = 180;
    });

});
</script>

</x-app-layout>
