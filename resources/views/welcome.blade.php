<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else 

    @endif
</head>
<body  class="bg-[#f0f2f5] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen">
     <!-- Fixed Centered Header/Navbar -->
<header class="fixed top-0 left-1/2 transform -translate-x-1/2 
               w-full lg:max-w-4xl max-w-[335px] 
               text-sm z-50 bg-white shadow border 
               rounded-[15px] p-4 backdrop-blur-md bg-opacity-90">

    <div class="flex items-center justify-between gap-4">
        <!-- Logo dan Judul -->
        <div class="flex items-center gap-3">
            <img src="logo-uks.png" alt="Logo UKS" class="w-12 h-12">
            <h1 class="text-lg font-semibold text-[#1b1b18]">
                Usaha Kesehatan Sekolah
            </h1>
        </div>

        <!-- Tombol hamburger hanya di mobile -->
        <button id="menu-btn" 
                class="lg:hidden flex flex-col justify-center items-center w-8 h-8 gap-1.5"
                aria-label="Toggle menu">
            <span class="block w-6 h-0.5 bg-[#1b1b18]"></span>
            <span class="block w-6 h-0.5 bg-[#1b1b18]"></span>
            <span class="block w-6 h-0.5 bg-[#1b1b18]"></span>
        </button>

        <!-- Nav Desktop: tampil sejajar kanan -->
        @if (Route::has('login'))
        <nav class="hidden lg:flex items-center gap-3">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="px-5 py-1.5 text-[#1b1b18] border border-[#19140035] hover:border-[#1915014a] rounded-sm text-sm">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-5 py-1.5 text-[#1b1b18] border border-transparent hover:border-[#19140035] rounded-sm text-sm">
                    Log in
                </a>
               
            @endauth
        </nav>
        @endif
    </div>

    <!-- Nav Mobile: tampil saat tombol diklik -->
    @if (Route::has('login'))
    <nav id="menu"
         class="max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out
                flex-col gap-3 mt-4
                border border-[#19140035] rounded-md lg:hidden p-4 
                bg-white text-[#1b1b18] z-40">
        @auth
            <a href="{{ url('/dashboard') }}"
               class="block px-5 py-2 border border-[#19140035] rounded-sm hover:border-[#1915014a] text-sm">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}"
               class="block px-5 py-2 border border-transparent rounded-sm hover:border-[#19140035] text-sm">
                Log in
            </a>
        @endauth
    </nav>
    @endif
</header>





        <!-- Hero Section -->
    <div class="relative w-full h-[500px] overflow-hidden">
        <img src="https://marketplace.canva.com/EAF1tvIC6M8/1/0/1600w/canva-biru-ilustrasi-lucu-kesehatan-mental-presentasi-pkezvRautmU.jpg"
             alt="Hero" class="w-full h-full object-cover">
        </div>
    </div>

    <!-- Main Content -->
    <div class="mx-5 mb-5 -mt-20 z-10">
        <main class="relative flex w-full flex-col-reverse lg:flex-row
             px-10 py-6 lg:p-20 
             bg-white/70 dark:bg-[#161615]/70 text-[#1b1b18] dark:text-[#EDEDEC] 
             shadow-xl backdrop-blur-md border border-white/30 
             rounded-[20px] overflow-hidden">
            
            <!-- Gradasi Transparan Bagian Atas -->
            <div class="absolute top-0 left-0 w-full h-16 bg-gradient-to-b from-white/10 dark:from-[#161615]/10 to-transparent pointer-events-none z-20"></div>

            <!-- Konten -->
            <div class="relative z-10 flex-1 text-[13px] leading-[20px]">
                <h1 class="mb-1 text-4xl font-bold">SMK NEGERI 1 CIPANAS</h1>
                
            <div class="bg-gray-50 border border-gray-300 rounded-lg p-4 w-full flex gap-4">
            
                <div class="min-w-96 p-4 mr-10   rounded">
                    <h1 class="text-blue-950 font-bold text-2xl">Fokus Sekolah Sehat</h1> 
                        <p class="text-blue-950 text-lg">
                            <br><strong>Sehat Bergizi</strong>
                            <br><strong>Sehat Fisik</strong>
                            <br><strong>Sehat Imunisasi</strong>
                            <br><strong>Sehat Jiwa</strong>
                            <br><strong>Sehat Lingkungan</strong>
                        </p>
                </div>

                <div class=" p-4   rounded text-lg">
                    <br>
                        <p class="text-blue-950 font-lg font-bold">
                            <br>Berdasarkan hasil Riset Kesehatan Dasar (Riskesdas) Kementerian Kesehatan Tahun 2018, kondisi kesehatan pada usia anak sekolah dan remaja sangat mengkhawatirkan, khususnya terkait konsumsi makanan berisiko setiap hari, status gizi, kebersihan diri, dan aktivitas fisik.
                            <br>Untuk itu, pemerintah, sekolah, dan masyarakat perlu bergotong royong untuk merevitalisasi Usaha Kesehatan Sekolah (UKS) yang berfokus pada pemenuhan gizi, olahraga (gerak badan), dan imunisasi lengkap sehingga peserta didik dapat mengikuti pembelajaran dengan optimal, seiring dimulainya kembali pembelajaran tatap muka.
                        </p>
                </div>
            </div>

            </div>
        </main>
    </div>




        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>

    <footer class= " text-gray-800 py-10">
  <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between gap-10">
    
    <!-- Logo dan Nama -->
    <div class="flex flex-col items-center md:items-start text-center md:text-left">
      <img src="logo-uks.png" alt="Logo UKS" class="w-20 md:w-40 mb-2">

      <p class="font-bold text-blue-950 ">SMK Negeri 1 Cipanas UKS</p>
    </div>

    <!-- Kontak -->
    <div class="flex-2">
      <h4 class="text-base font-semibold mb-2 text-blue-950 "><strong> Kontak </strong></h4>
      <ul class="space-y-1 text-sm text-blue-950">
        <li class="flex items-start  text-blue-950"><span class="mr-2">🏢</span><strong> SMK Negeri 1 Cipanas</strong></li>
        <li class="flex items-start  text-blue-950"><span class="mr-2">📍</span><strong> Jalan Raya, Cimacan, Kecamatan Cipanas, Kabupaten Cianjur, Jawa Barat, kode pos 43253</strong></li>
        <li class="flex items-start  text-blue-950"><span class="mr-2">🌐</span><strong> <a href="https://smkn1cipanas.sch.id/" class="">smkn1cipanas.sch.id</a> </strong></li>
        <li class="flex items-start  text-blue-950"><span class="mr-2">🌐</span><strong> <a href="https://www.instagram.com/pmrsmkn1cipanas/" class="">www.instagram.com/pmrsmkn1cipanas/</a> </strong></li>
      </ul>
    </div>

  </div>
</footer>

</html>

<script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');

    let isOpen = false;

    btn.addEventListener('click', () => {
        if (!isOpen) {
            menu.classList.remove('hidden');
            requestAnimationFrame(() => {
                menu.style.maxHeight = menu.scrollHeight + 'px';
                menu.style.opacity = '1';
            });
        } else {
            menu.style.maxHeight = '0px';
            menu.style.opacity = '0';
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 500); // sesuai dengan duration-500
        }
        isOpen = !isOpen;
    });

    // Reset style saat resize ke desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            menu.style.maxHeight = '';
            menu.style.opacity = '';
            menu.classList.remove('hidden');
        } else if (!isOpen) {
            menu.style.maxHeight = '0px';
            menu.style.opacity = '0';
            menu.classList.add('hidden');
        }
    });
</script>