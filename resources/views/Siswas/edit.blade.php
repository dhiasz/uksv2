<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit Data Siswa</h1>

        <form action="{{ route('siswas.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama</label>
                <input type="text" name="nama" id="nama" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('nama', $siswa->nama) }}" required>
                @error('nama')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kelas --}}
            <div class="mb-4">
                <label for="kelas" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Kelas</label>
                <input type="text" name="kelas" id="kelas" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('kelas', $siswa->kelas) }}" required>
                @error('kelas')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Umur --}}
            <div class="mb-4">
                <label for="umur" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Umur</label>
                <input type="number" name="umur" id="umur" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('umur', $siswa->umur) }}" required>
                @error('umur')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tinggi Badan --}}
            <div class="mb-4">
                <label for="tb" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tinggi Badan (cm)</label>
                <input type="number" name="tb" id="tb" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('tb', $siswa->tb) }}" required>
                @error('tb')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Berat Badan --}}
            <div class="mb-4">
                <label for="bb" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Berat Badan (kg)</label>
                <input type="number" name="bb" id="bb" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('bb', $siswa->bb) }}" required>
                @error('bb')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tekanan Darah --}}
            <div class="mb-4">
                <label for="tensi" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tekanan Darah</label>
                <input type="text" name="tensi" id="tensi" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('tensi', $siswa->tensi) }}">
                @error('tensi')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Golongan Darah --}}
            <div class="mb-4">
                <label for="goldar" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Golongan Darah</label>
                <input type="text" name="goldar" id="goldar" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('goldar', $siswa->goldar) }}">
                @error('goldar')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- User ID --}}
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="flex justify-end space-x-4">
                <a href="{{ route('siswas.index') }}" class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
