<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Tambah Data Kesehatan</h1>
        <form action="{{ route('kesehatan.store') }}" method="POST">
            @csrf

            {{-- Pilih Siswa --}}
            <div class="mb-4">
                
                <label for="nama_siswa" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama Siswa</label>
                <input type="text" id="nama_siswa" name="nama_siswa" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" autocomplete="off" required>
                <input type="hidden" name="siswa_id" id="siswa_id" value="{{ old('siswa_id') }}">
                @error('siswa_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- NIS (otomatis terisi) --}}
            <div class="mb-4">
                <label for="nis_display" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">NIS</label>
                <input type="text" id="nis_display" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 bg-gray-100" readonly>
            </div>

            {{-- Umur (otomatis terisi) --}}
            <div class="mb-4">
                <label for="umur" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Usia</label>
                <input type="number" name="umur" id="umur" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 bg-gray-100" value="{{ old('umur') }}" required readonly>
                @error('umur')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

           {{-- Tinggi Badan --}}
            <div class="mb-4">
                <label for="tb" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tinggi Badan (cm)</label>
                <input type="number" name="tb" id="tb" min="0" max="250" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('tb') }}" required>
                @error('tb')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Berat Badan --}}
            <div class="mb-4">
                <label for="bb" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Berat Badan (kg)</label>
                <input type="number" name="bb" id="bb" min="0" max="180" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('bb') }}" required>
                @error('bb')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tensi --}}
            <div class="mb-4">
                <label for="tensi" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tensi</label>
                <input type="text" name="tensi" id="tensi" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('tensi') }}" placeholder="Misal: 120/80">
                @error('tensi')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Golongan Darah --}}
            <div class="mb-4">
                <label for="goldar" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Golongan Darah</label>
                <select name="goldar" id="goldar" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200">
                    <option value="" {{ old('goldar') == '' ? 'selected' : '' }}>-- Pilih Golongan Darah --</option>
                    <option value="A" {{ old('goldar') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('goldar') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="AB" {{ old('goldar') == 'AB' ? 'selected' : '' }}>AB</option>
                    <option value="O" {{ old('goldar') == 'O' ? 'selected' : '' }}>O</option>
                </select>
                @error('goldar')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- User ID (hidden) --}}
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            {{-- Tombol Simpan --}}
            <div class="flex justify-end space-x-4">
                <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    {{-- jquery & jquery-ui for autocomplete --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function hitungUmur(tglLahir) {
                if (!tglLahir) return '';
                const today = new Date();
                const lahir = new Date(tglLahir);
                let umur = today.getFullYear() - lahir.getFullYear();
                const m = today.getMonth() - lahir.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < lahir.getDate())) umur--;
                return umur;
            }

            $("#nama_siswa").autocomplete({
                source: "{{ route('siswa.autocomplete') }}",
                minLength: 2,
                select: function(event, ui) {
                    $('#siswa_id').val(ui.item.id);
                    $('#nama_siswa').val(ui.item.label);
                    $('#nis_display').val(ui.item.nis);
                    $('#umur').val(hitungUmur(ui.item.tgl));
                }
            });

            // Reset fields if input cleared
            $('#nama_siswa').on('change keyup', function() {
                if ($(this).val() === '') {
                    $('#siswa_id').val('');
                    $('#nis_display').val('');
                    $('#umur').val('');
                }
            });

            // Validasi input Tensi agar tidak mengandung karakter minus '-'
            document.getElementById('tensi').addEventListener('input', function(e) {
                if (this.value.includes('-')) {
                    this.value = this.value.replace(/-/g, '');
                }
            });

             document.getElementById('tb').addEventListener('input', function () {
                if (this.value > 250) this.value = 300;
            });

            document.getElementById('bb').addEventListener('input', function () {
                if (this.value > 180) this.value = 180;
            });
        });
    </script>
</x-app-layout>
