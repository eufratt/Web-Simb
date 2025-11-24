<?php
// --- Bagian Logika PHP ---

$message = '';
$message_type = '';

// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "tanah_longsor_db");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

date_default_timezone_set('Asia/Jakarta');

// Cek submit form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = isset($_POST['nama']) ? htmlspecialchars(trim($_POST['nama'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $saran = isset($_POST['saran']) ? htmlspecialchars(trim($_POST['saran'])) : '';
    $tanggal = date("Y-m-d H:i:s");

    if (!empty($nama) && !empty($email) && !empty($saran)) {

        // INSERT INTO BIASA
        $sql = "
            INSERT INTO saran (nama, email, pesan, tanggal)
            VALUES (
                '$nama',
                '$email',
                '$saran',
                '$tanggal'
            )
        ";

        if ($koneksi->query($sql) === TRUE) {
            $message = 'Terima kasih! Masukan Anda telah kami terima.';
            $message_type = 'success';
        } else {
            $message = 'Gagal menyimpan data: ' . $koneksi->error;
            $message_type = 'error';
        }
    } else {
        $message = 'Harap pastikan E-mail Address dan Keluhan telah diisi.';
        $message_type = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waspada Tanah Longsor - Informasi & Mitigasi</title>
    <!-- Memuat Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Memuat font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Konfigurasi kustom Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'brand-green': '#166534', // Hijau tua
                        'brand-brown': '#78350F', // Coklat
                        'brand-light': '#F3F4F6', // Abu-abu muda
                        'brand-dark': '#1F2937', // Abu-abu tua
                    }
                }
            }
        }
    </script>
    <style>
        /* Menambahkan smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        @keyframes appear {
            from {
                opacity: 0;
                scale: 0.5;
            }

            to {
                opacity: 1;
                scale: 1;
            }
        }

        .animasi {
            animation: appear 1.2s ease-out;
            animation-timeline: view();
            animation-range: entry 0% cover 50%;
            animation-duration: 10s;
        }

        .block,
        .lapor {
            animation: appear 1.2s ease-out;
            animation-timeline: view();
            animation-range: entry 0% cover 30%;
            animation-duration: 10s;
        }
    </style>
</head>

<body class="font-sans bg-white text-brand-dark">

    <?php include 'navbar.php' ?>

    <!-- HERO SLIDER -->
    <section id="beranda" class="relative min-h-screen flex items-center justify-center overflow-hidden bg-brand-light">

        <!-- Wrapper semua slide -->
        <div id="slider" class="absolute inset-0 w-full h-full blur-sm">

            <!-- Slide 1 -->
            <div class="slide absolute inset-0 opacity-100 transition-opacity duration-3000">
                <img src="assets/longsor1.jpeg"
                    class="w-full h-full object-cover opacity-80">
            </div>

            <!-- Slide 2 -->
            <div class="slide absolute inset-0 opacity-0 transition-opacity duration-3000">
                <img src="assets/longsor2.png"
                    class="w-full h-full object-cover opacity-80">
            </div>

            <!-- Slide 3 -->
            <div class="slide absolute inset-0 opacity-0 transition-opacity duration-3000">
                <img src="assets/longsor3.jpg"
                    class="w-full h-full object-cover opacity-80">
            </div>
        </div>

        <!-- Konten hero -->
        <div class="relative z-10 text-center px-6">
            <h1 class="text-5xl md:text-7xl font-bold text-brand-dark mb-10 leading-tight">
                Bencana <span class="text-brand-brown">Longsor</span>
            </h1>
            <div class="flex justify-center space-x-4">
                <button class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500">
                    <a href="#info" class="bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold text-lg shadow-lg hover:bg-orange-700 transition duration-300">
                        Pelajari Lebih Lanjut
                    </a>
                </button>
            </div>
        </div>

        <!-- Tombol Prev / Next -->
        <button id="prevBtn" class="absolute left-5 top-1/2 -translate-y-1/2 bg-black/40 text-white px-4 py-2 rounded-full">
            ‹
        </button>
        <button id="nextBtn" class="absolute right-5 top-1/2 -translate-y-1/2 bg-black/40 text-white px-4 py-2 rounded-full">
            ›
        </button>
    </section>


    <!-- Informasi: Apa Itu Tanah Longsor? -->
    <section id="info" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <!-- Gambar/Ilustrasi -->
                <div class="w-full md:w-1/2 animasi">
                    <img src="https://placehold.co/600x400/d4d4d8/1f2937?text=Ilustrasi+Tanah+Longsor" alt="Ilustrasi Tanah Longsor" class="rounded-lg shadow-2xl object-cover w-full h-100">
                </div>
                <!-- Teks Penjelasan -->
                <div class="w-ful md:w-1/2 overscroll-auto md:overscroll-contain overflow-y-auto h-80 p-2">

                    <h2 class="text-3xl md:text-4xl font-bold text-brand-dark mb-6 mt-2">
                        Definisi Tanah Longsor
                    </h2>

                    <p class="text-gray-600 text-lg mb-4">
                        Tanah longsor adalah perpindahan material pembentuk lereng (berupa batuan, bahan rombakan, tanah, atau material campuran)
                        yang bergerak ke bawah atau keluar lereng.
                    </p>

                    <p class="text-gray-600 text-lg mb-6">
                        Peristiwa ini dapat terjadi secara tiba-tiba atau perlahan dan seringkali dipicu oleh faktor alam seperti curah hujan tinggi,
                        gempa bumi, atau aktivitas manusia yang tidak bertanggung jawab.
                    </p>


                    <!-- =============================== -->
                    <!-- FAKTOR PENYEBAB LONGSOR -->
                    <!-- =============================== -->

                    <h2 class="text-3xl md:text-4xl font-bold text-brand-dark mb-6 mt-6">
                        Faktor Penyebab Terjadinya Longsor
                    </h2>

                    <h4 class="text-2xl font-semibold text-brand-dark mb-4">
                        A. Faktor Alam
                    </h4>

                    <ol class="list-decimal ml-6 text-gray-700 space-y-2 mb-6">
                        <li>Perubahan kondisi geologi seperti lapisan tanah yang rapuh atau batuan yang mudah pecah.</li>
                        <li>Curah hujan tinggi yang membuat tanah jenuh air sehingga kehilangan kestabilannya.</li>
                        <li>Topografi curam seperti lereng bukit atau jurang yang rentan mengalami pergerakan tanah.</li>
                    </ol>

                    <h4 class="text-2xl font-semibold text-brand-dark mb-4">
                        B. Faktor Manusia
                    </h4>

                    <ol class="list-decimal ml-6 text-gray-700 space-y-2 mb-8">
                        <li>Penggundulan hutan dan hilangnya akar tanaman yang seharusnya memperkuat tanah.</li>
                        <li>Pembangunan permukiman atau infrastruktur di area rawan longsor tanpa analisis struktur tanah.</li>
                        <li>Sistem drainase buruk yang menyebabkan air menggenang di lereng sehingga memperlemah kestabilan tanah.</li>
                    </ol>


                    <!-- =============================== -->
                    <!-- TIPE-TIPE TANAH LONGSOR -->
                    <!-- =============================== -->

                    <h2 class="text-3xl md:text-4xl font-bold text-brand-dark mb-6">
                        Tipe-Tipe Tanah Longsor
                    </h2>

                    <ul class="list-disc ml-6 text-gray-700 space-y-2 mb-8">
                        <li><strong>Falls</strong> – material batu atau tanah jatuh bebas dari tebing yang sangat curam.</li>
                        <li><strong>Slides</strong> – pergerakan tanah yang meluncur pada bidang gelincir, bisa translasi atau rotasional.</li>
                        <li><strong>Flows</strong> – tanah bergerak seperti cairan akibat kejenuhan air.</li>
                        <li><strong>Topples</strong> – tanah atau batuan terjungkal ke depan karena tekanan atau rotasi.</li>
                        <li><strong>Creep</strong> – pergerakan sangat lambat yang sering tidak disadari.</li>
                        <li><strong>Spread</strong> – penyebaran lateral massa tanah akibat kegagalan lapisan bawah.</li>
                    </ul>


                    <!-- =============================== -->
                    <!-- DAMPAK TANAH LONGSOR -->
                    <!-- =============================== -->

                    <h2 class="text-3xl md:text-4xl font-bold text-brand-dark mb-6">
                        Dampak Tanah Longsor
                    </h2>

                    <h4 class="text-2xl font-semibold text-brand-dark mb-4">
                        Dampak Positif
                    </h4>

                    <ul class="list-disc ml-6 text-gray-700 space-y-2 mb-6">
                        <li>Meningkatkan kestabilan tanah setelah material lemah runtuh.</li>
                        <li>Membentuk lahan baru yang dapat dimanfaatkan untuk kegiatan tertentu.</li>
                        <li>Membantu proses pelapukan batuan sehingga menciptakan tanah subur.</li>
                        <li>Meningkatkan kelembapan tanah di area tertentu.</li>
                    </ul>

                    <h4 class="text-2xl font-semibold text-brand-dark mb-4">
                        Dampak Negatif
                    </h4>

                    <ul class="list-disc ml-6 text-gray-700 space-y-2 mb-10">
                        <li>Kerusakan lingkungan serta rusaknya ekosistem.</li>
                        <li>Kerugian materi seperti rumah, jalan, kendaraan, dan fasilitas umum.</li>
                        <li>Gangguan ekonomi serta lumpuhnya aktivitas masyarakat.</li>
                        <li>Risiko korban jiwa dan hilangnya tempat tinggal.</li>
                    </ul>
                    
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-2 rounded-lg text-center">
                        <p class="font-medium">Memahami risiko di sekitar kita adalah langkah awal untuk keselamatan.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Upaya Mitigasi -->
    <section id="mitigasi" class="py-20 bg-brand-light">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-brand-dark">
                    Gimana cara memitigasinya?
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 animasi">
                <!-- Kartu Mitigasi 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100">
                    <img src="https://placehold.co/600x400/86efac/1c1917?text=Reboisasi" alt="Menanam Pohon" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">Reboisasi & Tanam Vetiver</h3>
                        <p class="text-gray-600">Menanam pohon dan tanaman dengan akar kuat (seperti vetiver) di lereng dapat membantu mengikat tanah dan mengurangi erosi.</p>
                    </div>
                </div>
                <!-- Kartu Mitigasi 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100">
                    <img src="https://placehold.co/600x400/a3e635/1c1917?text=Terasering" alt="Terasering" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">Membuat Terasering</h3>
                        <p class="text-gray-600">Di lahan miring, pembuatan terasering (sengkedan) efektif untuk mengurangi kecepatan aliran air dan menahan tanah.</p>
                    </div>
                </div>
                <!-- Kartu Mitigasi 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100">
                    <img src="https://placehold.co/600x400/fca5a5/1c1917?text=Sistem+Peringatan" alt="Sistem Peringatan Dini" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">Sistem Peringatan Dini</h3>
                        <p class="text-gray-600">Membangun sistem peringatan dini (EWS) sederhana di komunitas untuk memantau curah hujan dan pergerakan tanah.</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-12">
                <a href="#" class="text-brand-brown font-semibold text-lg hover:underline">
                    Lihat Panduan Mitigasi Lengkap &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- Kontak / CTA -->
    <section id="lapor" class="py-40 bg-brand-brown text-white">
        <div class="lapor container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                Ada longsor di daerah sekitarmu?
            </h2>
            <button class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500">
                <a href="lapor.php" class="bg-white text-brand-brown px-8 py-3 rounded-lg font-semibold text-lg shadow-lg hover:bg-gray-100 transition duration-300">
                    Lapor Sekarang
                </a>
            </button>
        </div>
    </section>

    <!-- Bagian Saran & Keluhan (Sesuai Mockup) -->
    <section id="kontak" class="py-10 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-16">
                <!-- Info Kontak -->
                <div class="w-full md:w-1/2">
                    <h3 class="text-2xl font-semibold text-brand-dark mb-4">Contact</h3>
                    <p class="text-gray-600 mb-4">Hubungi kami jika ada pertanyaan lebih lanjut.</p>
                    <p class="text-gray-600"><strong>Email:</strong> info@silongsor.id</p>
                    <p class="text-gray-600"><strong>Telepon:</strong> (021) 123-4567</p>

                    <h3 class="text-2xl font-semibold text-brand-dark mt-8 mb-4">Follow Us</h3>
                    <!-- Social Media (opsional) -->
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-brand-green">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.24 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-brand-green">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Form Saran & Keluhan -->
                <div class="w-full md:w-1/2 bg-brand-light p-8 rounded-lg shadow-lg block">
                    <h3 class="text-2xl font-semibold text-brand-dark mb-2">Saran & Keluhan</h3>
                    <p class="text-gray-600 mb-6">Kami menghargai masukan Anda untuk perbaikan.</p>

                    <?php
                    // Menampilkan pesan feedback jika ada
                    if ($message):
                    ?>
                        <div class="mb-4 p-4 rounded-lg <?php echo $message_type == 'success' ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300'; ?>" role="alert">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Formulir diubah untuk mengirim data ke file ini sendiri (index.php) -->
                    <form action="#kontak" method="POST">
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" id="nama" name="nama" placeholder="Tuliskan nama Anda..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-brand-green focus:border-brand-green">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail Address</label>
                            <input type="email" id="email" name="email" placeholder="email@anda.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-brand-green focus:border-brand-green">
                        </div>
                        <div class="mb-6">
                            <label for="saran" class="block text-sm font-medium text-gray-700 mb-1">Saran</label>
                            <textarea id="saran" name="saran" rows="4" placeholder="Jelaskan keluhan Anda di sini..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-brand-green focus:border-brand-green"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-auto bg-brand-brown text-white px-6 py-3 rounded-lg font-semibold shadow-lg transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110">
                                Kirim Masukan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php' ?>

    <script>
        // JavaScript untuk menu mobile
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Menutup menu saat link di-klik (untuk navigasi di halaman yang sama)
        const mobileLinks = document.querySelectorAll('#mobile-menu a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // slider beranda
        const slides = document.querySelectorAll(".slide");
        let index = 0;

        function showSlide(i) {
            slides.forEach((slide, idx) => {
                slide.style.opacity = idx === i ? "1" : "0";
            });
        }

        document.getElementById("nextBtn").addEventListener("click", () => {
            index = (index + 1) % slides.length;
            showSlide(index);
        });

        document.getElementById("prevBtn").addEventListener("click", () => {
            index = (index - 1 + slides.length) % slides.length;
            showSlide(index);
        });

        // Auto slide
        setInterval(() => {
            index = (index + 1) % slides.length;
            showSlide(index);
        }, 4000);
    </script>

</body>

</html>