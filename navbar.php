    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <!-- Header & Navigasi -->
    <header class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[90%] md:w-[85%]">
    <nav class="flex items-center justify-between px-6 py-3
                bg-[#E6C7A5]/80 backdrop-blur-md rounded-2xl
                shadow-lg border border-white/10">

        <!-- Logo -->
        <a href="landing.php" class="block">
            <img src="assets/logobg.png" 
                 alt="SILONGSOR Logo" 
                 class="h-16 w-auto p-2">
        </a>

        <!-- Menu Desktop -->
        <div class="hidden md:flex space-x-6">
            <a href="landing.php#info" class="text-stone-900 hover:text-stone-700 font-medium">Info</a>
            <a href="landing.php#mitigasi" class="text-stone-900 hover:text-stone-700 font-medium">Mitigasi</a>
            <a href="landing.php#saran" class="text-stone-900 hover:text-stone-700 font-medium">Saran</a>
        </div>

        <!-- Tombol -->
        <a href="landing.php#lapor" 
           class="hidden md:inline-block bg-orange-500 text-white px-5 py-2 rounded-lg font-medium 
          shadow hover:bg-orange-600 transition duration-300">
            Lapor Sekarang
        </a>

        <!-- Tombol Menu Mobile -->
        <button id="mobile-menu-button" class="md:hidden text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </nav>

    <!-- Menu Mobile -->
    <div id="mobile-menu" class="hidden md:hidden bg-black/70 backdrop-blur-xl
                                mt-3 rounded-xl px-6 py-4 space-y-3 text-white border border-white/10">

        <a href="landing.php#info" class="block text-white/90 hover:text-white">Info</a>
        <a href="landing.php#mitigasi" class="block text-white/90 hover:text-white">Mitigasi</a>
        <a href="landing.php#saran" class="block text-white/90 hover:text-white">Saran</a>

        <a href="landing.php#lapor" 
           class="block w-full text-center bg-white/20 text-white py-2 rounded-lg 
                  font-medium shadow hover:bg-white/30 transition duration-300">
            Lapor Sekarang
        </a>
    </div>
</header>

<script>
    const mobileBtn = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    mobileBtn.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
    });
</script>


    </body>
    </html>