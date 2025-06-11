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
                Unit Kesehatan Sekolah
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
                <h1 class="mb-1 font-medium">Let's get started</h1>
                <p class="mb-2 text-[#706f6c] dark:text-[#A1A09A]">
                    Laravel has an incredibly rich ecosystem. <br>
                    We suggest starting with the following. <br>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam repudiandae doloremque aperiam. Quae vero non, illo sequi itaque fugit autem illum quam a, rem nemo est harum nihil. Architecto itaque animi aliquid odio nam est quas iure porro aliquam, consequuntur et, officiis libero beatae accusamus recusandae quo voluptatum blanditiis iusto quis veritatis. Fugiat neque quaerat, eum consectetur id animi, doloribus architecto, delectus voluptates iste quasi eveniet. Dicta placeat amet odit dignissimos ratione, animi ullam! Ad labore laborum, sit nobis voluptatum, itaque nostrum omnis accusantium qui pariatur quibusdam neque sequi atque quam quo temporibus quis incidunt alias quas. Distinctio pariatur adipisci tempore consequatur voluptas culpa nobis rerum obcaecati vero libero similique, voluptatum eius fugit enim eveniet beatae ad iure assumenda voluptates aut dolore exercitationem. Rem aliquam commodi, deserunt iusto repudiandae nostrum, officiis assumenda excepturi quam nemo ipsam repellendus esse. Sint et quis ea unde ipsam, tempore consequuntur repudiandae facere veritatis velit. Fugit nulla beatae sint itaque neque natus dolore pariatur sunt tempore aliquam, numquam totam atque! Labore esse dolorum praesentium impedit, placeat doloremque modi nobis dolorem, autem beatae harum nisi quasi odio fugiat repellendus sequi dolor quae, velit blanditiis natus repellat? Velit maiores, enim aperiam architecto ipsam minus! Provident, porro. Illo dignissimos adipisci harum nemo labore voluptatum, cumque praesentium maiores, voluptate eveniet aliquam ipsam sit fuga incidunt minima? Animi ea quos sint architecto repudiandae, aperiam, a debitis adipisci minus sit excepturi mollitia soluta delectus itaque totam similique possimus culpa dolor voluptatibus? Aperiam ea pariatur non obcaecati, maiores vero, distinctio perferendis tenetur alias impedit illum voluptas, animi iste quis iure. Culpa officia, cupiditate, dolorum impedit adipisci corporis numquam unde similique assumenda reiciendis qui atque, eveniet nostrum quos provident vitae illo! Cum, ipsam iste nisi voluptate eius omnis facilis beatae! Illo facilis sequi amet eius rem corporis placeat consequuntur quisquam officiis? Commodi, quo voluptatum at harum molestias rem culpa veritatis sapiente consequatur quas tempore officiis amet neque odio distinctio. Minus, tempore. Obcaecati odit, soluta sit dolores veniam possimus aliquam dolorem deserunt. Culpa, officiis libero eos exercitationem sed earum veritatis labore quas nemo explicabo vitae numquam voluptate non quam possimus obcaecati ea consequatur fugit nostrum rem repudiandae quia. Fuga beatae ducimus corporis nobis exercitationem, sint cupiditate fugiat! Illum dolorum doloribus ratione soluta sit fugit aut, consequatur autem, velit placeat sequi reiciendis corrupti in rem architecto eligendi aliquid expedita pariatur, facere itaque voluptates at libero neque amet! Voluptatibus impedit praesentium architecto debitis perspiciatis sequi voluptate molestiae sint odit, quia explicabo nisi, quod omnis non illum possimus magni. Voluptatum explicabo, commodi itaque sint ducimus quaerat consequuntur illum consequatur error. Corporis incidunt sequi excepturi dolorum cumque omnis nihil minus voluptatem doloremque deleniti repellat in hic repellendus quidem esse dolore ipsam quasi ullam nisi ea maxime, quod minima impedit voluptate. Explicabo labore molestiae architecto cumque. Vero dicta dolor aliquam voluptates obcaecati suscipit quis in molestias iste atque facere, rem laboriosam ex voluptatum minima alias quidem, dolorem, magni eligendi quae praesentium accusantium autem! Rerum quisquam mollitia, debitis dolorem provident vel dolorum doloribus eligendi porro repudiandae quas animi illum accusamus sit quos, consequatur voluptatum, veniam iusto voluptatibus qui doloremque consectetur soluta. Autem nesciunt iure tempora voluptatum natus officia cupiditate expedita perferendis quis quae labore ratione illum, voluptatibus ipsam doloremque assumenda ad numquam repellat possimus? Debitis quisquam recusandae adipisci temporibus est doloremque, nemo praesentium harum exercitationem ipsa eius qui ullam, sit, maxime corporis non voluptas placeat! Neque, nobis? Commodi repudiandae ab perspiciatis iste? Error accusantium iste voluptatem veniam deleniti ullam, praesentium ipsa vel odit atque dolores voluptate eos accusamus molestiae illum aliquid explicabo corrupti! Corrupti eligendi ab odio molestiae qui iusto iure saepe architecto, sed veniam possimus id aliquam itaque sunt quaerat, minus incidunt tenetur fugit obcaecati vitae non. Ea, corrupti. Adipisci ratione quisquam amet. Soluta exercitationem eaque, iusto culpa molestias repellat voluptates quae facilis ducimus accusamus laudantium optio? Minus aut sed quos molestias sit. Quis saepe voluptates vero provident aperiam molestiae deserunt nobis deleniti, numquam minima quisquam corporis aut consequatur? Blanditiis temporibus doloremque quo non voluptates ipsum aperiam beatae delectus recusandae voluptate, eos mollitia rem. Sed, atque eos blanditiis quaerat ex impedit id ad distinctio velit? Vitae, deleniti aut error similique fuga sapiente fugit aliquid cupiditate accusantium, dolorum consectetur. Ipsa aliquid natus maiores perspiciatis quis neque quaerat architecto iusto earum aliquam repellat odit nihil reprehenderit illo, reiciendis mollitia cum nulla. Cumque distinctio minima unde consectetur id perspiciatis incidunt quidem soluta beatae ut, provident, corrupti consequatur voluptatibus aliquam? Iste ex mollitia a error, numquam natus sint? Beatae ullam asperiores quia soluta odit aliquam, voluptas maxime voluptatem libero, eveniet modi eum! Mollitia, quam architecto. Perspiciatis architecto labore nemo fugiat itaque quae vero. Minima maxime perspiciatis excepturi tempora reprehenderit ducimus ab architecto delectus! Laudantium veritatis ad atque tenetur fuga itaque soluta explicabo, optio, quas sapiente facere tempore nobis harum iste eos voluptates vel delectus nihil, minus perspiciatis quam? Magnam laboriosam cum deserunt sint eum excepturi maxime consectetur nihil earum. Exercitationem, corporis. Veniam consectetur pariatur accusantium nesciunt soluta? Dolorum pariatur labore delectus tenetur nam maiores, nesciunt, unde dolorem sequi sit expedita? Neque error maxime molestias, ipsa facilis ullam necessitatibus ea deleniti dolorum laboriosam voluptatem nisi? Maiores recusandae, modi error, ullam eveniet quisquam quos sunt enim vel dignissimos distinctio consectetur praesentium odit ipsum laborum quaerat, quod hic necessitatibus iste explicabo iusto? Qui architecto ipsam iure nesciunt consequuntur commodi culpa suscipit unde saepe sunt aut quidem doloribus error, repudiandae harum perspiciatis. Magnam autem asperiores quo fugiat, impedit, temporibus libero blanditiis quod ipsum nam dolorum nobis fuga necessitatibus inventore maxime quos corporis provident magni vitae ut. Corporis hic et omnis odio est veritatis nemo voluptate reiciendis autem molestiae enim aliquam saepe labore ab atque, maxime quaerat perferendis? Atque sapiente inventore, molestiae vel mollitia, necessitatibus culpa laudantium corrupti beatae eum nam iure! Modi totam nesciunt natus facilis consequatur itaque ex saepe cum omnis cupiditate dolorem aut aperiam aspernatur tenetur iste, debitis ea illo quibusdam dolore! Sequi dolorem minus, qui blanditiis a natus veniam unde assumenda, laborum, voluptatem error pariatur dolorum ratione atque. A, voluptatem aspernatur eum expedita recusandae optio veritatis, corporis vel rerum reiciendis amet quasi atque enim?
                </p>
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


