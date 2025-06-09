<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit Data Siswa</h1>

        <form action="{{ route('siswas.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Input: Nama --}}
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama</label>
                <input type="text" name="nama" id="nama"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    value="{{ old('nama', $siswa->nama) }}" required>
                @error('nama')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input: NIS --}}
            <div class="mb-4">
                <label for="nis" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">NIS</label>
                <input type="number" name="nis" id="nis" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('nis', $siswa->nis ?? '') }}" required min="1" oninput="this.value = this.value.slice(0, 10)">
                @error('nis')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input: Tanggal Lahir --}}
            <div class="mb-4">
                <label for="tgl" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tanggal Lahir</label>
                <input type="date" name="tgl" id="tgl"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    value="{{ old('tgl', $siswa->tgl) }}" required>
                @error('tgl')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Hidden Input: user_id --}}
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            {{-- Tombol Aksi --}}
            <div class="flex justify-end space-x-4">
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
