<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">
            Edit Kunjungan
        </h1>

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

        @php
            // Pecah kelas: "X - Teknik Komputer dan Jaringan - 2"
            $kelasParts = explode(' - ', $kunjungan->kelas);
            $kelasTingkat = $kelasParts[0] ?? '';
            $kelasJurusan = $kelasParts[1] ?? '';
            $kelasKe      = $kelasParts[2] ?? '';
        @endphp

        <form action="{{ route('kunjungans.update', $kunjungan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Pasien --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Nama Pasien
                </label>
                <input
                    type="text"
                    name="nama"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    value="{{ old('nama', $kunjungan->nama) }}"
                    required
                >
            </div>

            {{-- Umur --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Umur
                </label>
                <input
                    type="number"
                    name="umur"
                    min="1"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    value="{{ old('umur', $kunjungan->umur) }}"
                    required
                >
            </div>

            {{-- Detail Kelas --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Detail Kelas
                </label>

                <div class="grid grid-cols-12 gap-4">

                    {{-- Tingkat (kecil) --}}
                    <div class="col-span-2">
                        <select
                            name="kelas_tingkat"
                            class="w-full px-2 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 text-sm"
                            required
                        >
                            <option value="">-- --</option>
                            @foreach(['X','XI','XII'] as $item)
                                <option value="{{ $item }}"
                                    {{ old('kelas_tingkat', $kelasTingkat) == $item ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jurusan (lebar) --}}
                    <div class="col-span-7">
                        <select
                            class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed">
                            <option>{{ $kelasJurusan }}</option>
                        </select>
                        <input type="hidden" name="kelas_jurusan" value="{{ $kelasJurusan }}">
                    </div>

                    {{-- Kelas Ke (sedang) --}}
                    <div class="col-span-3">
                        <select
                            class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed">
                            <option>{{ $kelasKe }}</option>
                        </select>
                        <input type="hidden" name="kelas_ke" value="{{ $kelasKe }}">
                    </div>
                </div>
            </div>


            {{-- Keluhan --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Keluhan
                </label>
                <textarea
                    name="keluhan"
                    rows="3"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    required>{{ old('keluhan', $kunjungan->keluhan) }}</textarea>
            </div>

            {{-- Tindakan --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Tindakan
                </label>
                <textarea
                    name="tindakan"
                    rows="3"
                    class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200"
                    required>{{ old('tindakan', $kunjungan->tindakan) }}</textarea>
            </div>

            {{-- Obat --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Obat yang Digunakan
                </label>
                <select name="sobat_id" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200">
                    <option value="">-- Tidak Menggunakan Obat --</option>
                    @foreach($stokobats as $stok)
                        <option value="{{ $stok->id }}"
                            {{ old('sobat_id', $kunjungan->sobat_id) == $stok->id ? 'selected' : '' }}>
                            {{ $stok->obat->nama_obat }} (Stok: {{ $stok->total_jumlah }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                    Status
                </label>
                <select name="status" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200">
                    <option value="">-- Pilih Status --</option>
                    @foreach(['Ditangani','Dirujuk','Selesai'] as $status)
                        <option value="{{ $status }}"
                            {{ old('status', $kunjungan->status) == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">
                    Perbarui
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