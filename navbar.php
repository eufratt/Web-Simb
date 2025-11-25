<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Glow</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Efek asap lembut + glow halus */
        .menu-glow {
            @apply text-white drop-shadow-[0_0_12px_rgba(255,255,255,0.9)] 
            transition ease-out duration-300;
        }

        .menu-glow:hover {
            @apply drop-shadow-[0_0_20px_rgba(255,255,255,1)] 
            text-white;
        }
    </style>
</head>

<body class="bg-stone-800">

    <!-- Header & Navigasi -->
    <header class="fixed top-4 left-1/2 -translate-x-1/2 w-[92%] md:w-[85%] 
    bg-white/40 backdrop-blur-sm border border-white/20
    shadow-lg rounded-2xl px-6 py-3 flex items-center justify-between z-50 
    drop-shadow-[0_0_20px_rgba(255,255,255,0.6)]">

        <!-- LEFT LOGO -->
        <a href="landing.php" class="flex items-center space-x-3">
            <img src="assets/logobg.png"
                class="h-12 w-auto rounded-lg"
                onerror="this.src='https://placehold.co/60x60/f97316/FFF?text=S';">
        </a>

        <!-- DESKTOP MENU -->
        <nav class="hidden md:flex items-center space-x-10">

            <a href="#info" 
                class="menu-glow text-lg font-medium">
                Info
            </a>

            <a href="#mitigasi" 
                class="menu-glow text-lg font-medium">
                Mitigasi
            </a>

            <a href="#saran" 
                class="menu-glow text-lg font-medium">
                Saran
            </a>
        </nav>

        <!-- RIGHT BUTTON -->
        <div class="flex items-center space-x-4">
            <button class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110">
                <a href="#lapor" class="hidden md:inline-block 
                px-4 py-2 bg-brand-brown/70 text-white rounded-xl
                hover:bg-brand-brown/50 border border-white/30 backdrop-blur-lg transition duration-300">
                    Lapor Sekarang
                </a>
            </button>

            <!-- Mobile hamburger -->
            <button id="mobile-menu-button" class="md:hidden text-white">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </header>

    <!-- MOBILE MENU -->
    <div id="mobile-menu" class="hidden md:hidden 
     bg-white/10 backdrop-blur-xl border border-white/20
     w-[92%] mx-auto mt-24 p-6 rounded-xl space-y-4 text-white">

        <a href="#info" class="block menu-glow text-xl">Info</a>
        <a href="#mitigasi" class="block menu-glow text-xl">Mitigasi</a>
        <a href="#saran" class="block menu-glow text-xl">Saran</a>

        <a href="#lapor" class="block text-center mt-3 px-4 py-3 bg-white/20 
        rounded-xl border border-white/30 hover:bg-white/30 backdrop-blur-lg">
            Lapor Sekarang
        </a>
    </div>

    <script>
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    </script>

</body>

</html>
