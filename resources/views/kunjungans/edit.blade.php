<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6">Edit Kunjungan</h1>

        <form action="{{ route('kunjungans.update', $kunjungan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Siswa dengan Autocomplete --}}
            <div class="mb-4">
                <label for="nama_siswa" class="block font-medium mb-2">Nama Siswa</label>
                <input type="text" id="nama_siswa" name="nama_siswa" class="w-full px-4 py-2 border rounded-lg bg-gray-100" autocomplete="off" readonly
                    value="{{ old('nama_siswa', $kunjungan->siswa->nama ?? '') }}">
                <input type="hidden" name="siswa_id" id="siswa_id" value="{{ old('siswa_id', $kunjungan->siswa_id) }}">
                @error('siswa_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- NIS --}}
            <div class="mb-4">
                <label for="nis_display" class="block font-medium mb-2">NIS</label>
                <input type="text" id="nis_display" class="w-full px-4 py-2 border rounded-lg bg-gray-100" readonly
                    value="{{ old('nis_display', $kunjungan->siswa->nis ?? '') }}">
            </div>

            {{-- Usia --}}
            <div class="mb-4">
                <label for="umur" class="block font-medium mb-2">Usia</label>
                <input type="number" name="umur" id="umur" class="w-full px-4 py-2 border rounded-lg bg-gray-100" readonly required
                    value="{{ old('umur', $kunjungan->umur) }}">
                @error('umur')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kelas, Jurusan, Kelas Ke digabung --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Detail Kelas</label>
                <div class="grid grid-cols-3 gap-4">
                    {{-- Tingkat Kelas --}}
                    <select name="kelas_tingkat" id="kelas_tingkat" class="px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required>
                        <option value="" disabled selected>-- Tingkat --</option>
                        <option value="X" {{ old('kelas_tingkat') == 'X' ? 'selected' : '' }}>X</option>
                        <option value="XI" {{ old('kelas_tingkat') == 'XI' ? 'selected' : '' }}>XI</option>
                        <option value="XII" {{ old('kelas_tingkat') == 'XII' ? 'selected' : '' }}>XII</option>
                    </select>

                    {{-- Jurusan --}}
                    <select name="kelas_jurusan" id="kelas_jurusan" class="px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required>
                        <option value="" disabled selected>-- Jurusan --</option>
                        <option value="Teknik Kendaraan Ringan Otomotif" {{ old('kelas_jurusan') == 'Teknik Kendaraan Ringan Otomotif' ? 'selected' : '' }}>Teknik Kendaraan Ringan Otomotif</option>
                        <option value="Teknik Komputer dan Jaringan" {{ old('kelas_jurusan') == 'Teknik Komputer dan Jaringan' ? 'selected' : '' }}>Teknik Komputer dan Jaringan</option>
                        <option value="Agribisnis Pengolahan Hasil Pertanian" {{ old('kelas_jurusan') == 'Agribisnis Pengolahan Hasil Pertanian' ? 'selected' : '' }}>Agribisnis Pengolahan Hasil Pertanian</option>
                        <option value="Bisnis Daring dan Pemasaran" {{ old('kelas_jurusan') == 'Bisnis Daring dan Pemasaran' ? 'selected' : '' }}>Bisnis Daring dan Pemasaran</option>
                        <option value="Otomatisasi dan Tata Kelola Perkantoran" {{ old('kelas_jurusan') == 'Otomatisasi dan Tata Kelola Perkantoran' ? 'selected' : '' }}>Otomatisasi dan Tata Kelola Perkantoran</option>
                        <option value="Akuntansi dan Keuangan Lembaga" {{ old('kelas_jurusan') == 'Akuntansi dan Keuangan Lembaga' ? 'selected' : '' }}>Akuntansi dan Keuangan Lembaga</option>
                        <option value="Perhotelan" {{ old('kelas_jurusan') == 'Perhotelan' ? 'selected' : '' }}>Perhotelan</option>
                    </select>

                    {{-- Kelas Ke --}}
                    <select name="kelas_ke" id="kelas_ke" class="px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" required>
                        <option value="" disabled selected>-- Kelas Ke --</option>
                        @for($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}" {{ old('kelas_ke') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
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


            {{-- User ID --}}
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <div class="flex justify-end space-x-4">
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                    Update
                </button>
            </div>
        </form>
    </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const siswaSelect = document.getElementById('siswa_id');
            const nisDisplay = document.getElementById('nis_display');
            const umurInput = document.getElementById('umur');
            const tingkat = document.getElementById('kelas_tingkat');
            const jurusan = document.getElementById('kelas_jurusan');
            const ke = document.getElementById('kelas_ke');
            const gabungan = document.getElementById('kelas_gabungan');

            function hitungUmur(tglLahir) {
                if (!tglLahir) return '';
                const today = new Date();
                const lahir = new Date(tglLahir);
                let umur = today.getFullYear() - lahir.getFullYear();
                const m = today.getMonth() - lahir.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < lahir.getDate())) umur--;
                return umur;
            }

             // Autocomplete Nama Siswa
            $("#nama_siswa").autocomplete({
                source: "{{ route('siswa.autocomplete') }}",
                minLength: 2,
                select: function (event, ui) {
                    $('#siswa_id').val(ui.item.id); // Hidden input
                    $('#nis_display').val(ui.item.nis);
                    $('#umur').val(hitungUmur(ui.item.tgl));
                }
            });

            function updateFields() {
                const selected = siswaSelect.options[siswaSelect.selectedIndex];
                const nis = selected.getAttribute('data-nis') || '';
                const tgl = selected.getAttribute('data-tgl') || '';

                nisDisplay.value = nis;
                umurInput.value = hitungUmur(tgl);
            }

            function updateKelasGabungan() {
                const v1 = tingkat.value;
                const v2 = jurusan.value;
                const v3 = ke.value;
                if (v1 && v2 && v3) gabungan.value = `${v1} - ${v2} - ${v3}`;
                else gabungan.value = '';
            }

            siswaSelect.addEventListener('change', updateFields);
            tingkat.addEventListener('change', updateKelasGabungan);
            jurusan.addEventListener('change', updateKelasGabungan);
            ke.addEventListener('change', updateKelasGabungan);

            // Inisialisasi saat load
            updateFields();
            updateKelasGabungan();
        });
    </script>
</x-app-layout>