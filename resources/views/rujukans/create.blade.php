<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Tambah Rujukan untuk: {{ $kunjungan->nama }}</h1>
        <form action="{{ url('/kunjungan/' . $kunjungan->id . '/rujukan') }}" method="POST">
            @csrf

            {{-- Alamat --}}
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('alamat') }}" required>
                @error('alamat')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Diagnosa --}}
            <div class="mb-4">
                <label for="diagnosa" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Diagnosa</label>
                <input type="text" name="diagnosa" id="diagnosa" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('diagnosa') }}" required>
                @error('diagnosa')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tujuan --}}
            <div class="mb-4">
                <label for="tujuan" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tujuan</label>
                <input type="text" name="tujuan" id="tujuan" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200" value="{{ old('tujuan') }}" required>
                @error('tujuan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div id="notif" class="mb-4"></div>
            {{-- Tombol Simpan dan Kembali --}}
            <div class="flex justify-end space-x-4">
                <a href="{{ route('kunjungans.index', $kunjungan->id) }}" class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">Simpan</button>
                <a href="{{ route('rujukans.print', $kunjungan->id) }}" target="_blank" class="btn btn-sm btn-warning px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 transition ">
                buat Rujukan
                </a>
            </div>
        </form>
    </div>
</x-app-layout>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        $('form').submit(function(e) {
            e.preventDefault(); // cegah submit biasa

            $('#notif').html(''); // bersihkan notifikasi dulu

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#notif').html('<p class="text-green-600 font-semibold">Rujukan berhasil ditambahkan!</p>');
                    $('form')[0].reset(); // reset form jika ingin bersih
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorList = '<ul class="text-red-600">';
                    $.each(errors, function(key, value) {
                        errorList += '<li>' + value[0] + '</li>';
                    });
                    errorList += '</ul>';
                    $('#notif').html(errorList);
                }
            });
        });
    });
</script>
