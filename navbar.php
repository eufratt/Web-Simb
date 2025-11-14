<!-- Header & Navigasi -->
    <header class="sticky top-0 z-50 w-full bg-white shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center h-20">
            <a href="#" class="block">
                <!-- Menggunakan gambar logo yang diunggah -->
                <!-- Pastikan file 'logobg.jpg' berada di direktori yang sama dengan index.php atau perbarui path-nya -->
                <img src="assets/logobg.png" alt="SILONGSOR Logo" class="h-40 w-auto"
                     onerror="this.onerror=null; this.src='https://placehold.co/180x40/f97316/1F2937?text=SILONGSOR';">
            </a>
            <div class="hidden md:flex space-x-6">
                <a href="#info" class="text-gray-600 hover:text-brand-green font-medium">Info</a>
                <a href="#mitigasi" class="text-gray-600 hover:text-brand-green font-medium">Mitigasi</a>
                <a href="#kontak" class="text-gray-600 hover:text-brand-green font-medium">Kontak</a>
                <a href="#lapor" class="text-gray-600 hover:text-brand-green font-medium">Lapor</a>
            </div>
            <a href="#lapor" class="hidden md:inline-block bg-brand-brown text-white px-5 py-2 rounded-lg font-medium shadow-lg hover:bg-yellow-900 transition duration-300">
                Lapor Sekarang
            </a>
            <!-- Tombol Menu Mobile -->
            <button id="mobile-menu-button" class="md:hidden text-brand-dark">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </nav>
        <!-- Menu Mobile (Dropdown) -->
        <div id="mobile-menu" class="hidden md:hidden bg-white px-6 pb-4 space-y-2">
            <a href="#info" class="block text-gray-600 hover:text-brand-green font-medium">Info</a>
            <a href="#mitigasi" class="block text-gray-600 hover:text-brand-green font-medium">Mitigasi</a>
            <a href="#kontak" class="block text-gray-600 hover:text-brand-green font-medium">Kontak</a>
            <a href="#lapor" class="block text-gray-600 hover:text-brand-green font-medium">Lapor</a>
            <a href="#lapor" class="block w-full text-center bg-brand-brown text-white px-5 py-2 rounded-lg font-medium shadow-lg hover:bg-yellow-900 transition duration-300 mt-2">
                Lapor Sekarang
            </a>
        </div>
    </header>