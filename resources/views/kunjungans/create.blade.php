<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Tambah Kunjungan</h1>
        
        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif
                <form action="{{ route('kunjungans.store') }}" method="POST">
                    @csrf

                        {{-- Nama Pasien --}}
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Nama Pasien
                </label>
                <input
                    type="text"
                    name="nama"
                    id="nama"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    value="{{ old('nama') }}"
                    required
                >
                @error('nama')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Umur --}}
            <div class="mb-4">
                <label for="umur" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Umur
                </label>
                <input
                    type="number"
                    name="umur"
                    id="umur"
                    min="1"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    value="{{ old('umur') }}"
                    required
                >
                @error('umur')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Detail Kelas --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Detail Kelas
                </label>

    <div class="grid grid-cols-12 gap-4">

        {{-- Tingkat (kecil) --}}
        <div class="col-span-2">
            <select name="kelas_tingkat"  id="kelas_tingkat"  class="w-full px-2 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 text-sm"  required >
                <option value="" disabled selected>--</option>
                <option value="X" {{ old('kelas_tingkat') == 'X' ? 'selected' : '' }}>X</option>
                <option value="XI" {{ old('kelas_tingkat') == 'XI' ? 'selected' : '' }}>XI</option>
                <option value="XII" {{ old('kelas_tingkat') == 'XII' ? 'selected' : '' }}>XII</option>
            </select>
        </div>

                {{-- Jurusan (lebar) --}}
                <div class="col-span-7">
                    <select name="kelas_jurusan"  id="kelas_jurusan"  class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required>
                        <option value="" disabled selected>-- Jurusan --</option>
                        <option value="Teknik Kendaraan Ringan Otomotif" {{ old('kelas_jurusan') == 'Teknik Kendaraan Ringan Otomotif' ? 'selected' : '' }}> Teknik Kendaraan Ringan Otomotif </option>
                        <option value="Teknik Komputer dan Jaringan" {{ old('kelas_jurusan') == 'Teknik Komputer dan Jaringan' ? 'selected' : '' }}>  Teknik Komputer dan Jaringan  </option>
                        <option value="Agribisnis Pengolahan Hasil Pertanian" {{ old('kelas_jurusan') == 'Agribisnis Pengolahan Hasil Pertanian' ? 'selected' : '' }}>  Agribisnis Pengolahan Hasil Pertanian </option>
                        <option value="Bisnis Daring dan Pemasaran" {{ old('kelas_jurusan') == 'Bisnis Daring dan Pemasaran' ? 'selected' : '' }}> Bisnis Daring dan Pemasaran  </option>
                        <option value="Otomatisasi dan Tata Kelola Perkantoran" {{ old('kelas_jurusan') == 'Otomatisasi dan Tata Kelola Perkantoran' ? 'selected' : '' }}> Otomatisasi dan Tata Kelola Perkantoran </option>
                        <option value="Akuntansi dan Keuangan Lembaga" {{ old('kelas_jurusan') == 'Akuntansi dan Keuangan Lembaga' ? 'selected' : '' }}> Akuntansi dan Keuangan Lembaga </option>
                        <option value="Perhotelan" {{ old('kelas_jurusan') == 'Perhotelan' ? 'selected' : '' }}> Perhotelan  </option>
                    </select>
                </div>

                {{-- Kelas Ke (sedang) --}}
                <div class="col-span-3">
                    <select name="kelas_ke" id="kelas_ke" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required  >
                        <option value="" disabled selected>-- Kelas --</option>
                        @for($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}" {{ old('kelas_ke') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

            </div>

            @error('kelas')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
</div>

            {{-- Hidden Gabungkan Kelas --}}
            <input type="hidden" name="kelas" id="kelas_gabungan" value="{{ old('kelas') }}">

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
                <select name="sobat_id" id="sobat_id" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" >
                    <option value="">-- Pilih Obat --</option>
                    @foreach($stokobats as $stok)
                        <option value="{{ $stok->id }}">
                            {{ $stok->obat->nama_obat }} (Total Stok: {{ $stok->total_jumlah  }})
                        </option>
                    @endforeach
                </select>
            </div>

            
            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-gray-700 dark:text-gray-300 font-medium mb-2"> Status </label>
                <select  name="status" id="status"  class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Ditangani">Ditangani</option>
                    <option value="Dirujuk">Dirujuk</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            {{-- User ID --}}
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            {{-- Tombol Simpan --}}
            <div class="flex justify-end space-x-4">
                <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600">
                    Simpan
                </button>
            </div>
            @if (session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

        </form>
    </div>

      {{-- jQuery dan jQuery UI --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tingkat = document.getElementById('kelas_tingkat');
            const jurusan = document.getElementById('kelas_jurusan');
            const ke = document.getElementById('kelas_ke');
            const gabungan = document.getElementById('kelas_gabungan');


            function updateKelasGabungan() {
                const v1 = tingkat.value;
                const v2 = jurusan.value;
                const v3 = ke.value;
                if (v1 && v2 && v3) gabungan.value = `${v1} - ${v2} - ${v3}`;
                else gabungan.value = '';
            }

            tingkat.addEventListener('change', updateKelasGabungan);
            jurusan.addEventListener('change', updateKelasGabungan);
            ke.addEventListener('change', updateKelasGabungan);

            // Inisialisasi saat load
            updateKelasGabungan();
        });
    </script>
</x-app-layout>






