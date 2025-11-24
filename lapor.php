<?php
// --- Bagian Logika PHP ---

$message = '';
$message_type = '';

// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "tanah_longsor_db");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

date_default_timezone_set('Asia/Jakarta');

// Cek apakah formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Ambil dan bersihkan data input
    $nama = htmlspecialchars(trim($_POST['nama'] ?? ''));
    $isi = htmlspecialchars(trim($_POST['isi'] ?? ''));
    $tanggal = htmlspecialchars(trim($_POST['tanggal'] ?? ''));
    $lokasi = htmlspecialchars(trim($_POST['lokasi'] ?? ''));
    $tanggal = date("Y-m-d H:i:s");


    // 2. Validasi sederhana
    if (empty($nama) || empty($isi) || empty($tanggal) || empty($lokasi)) {
        $message = "Mohon lengkapi semua kolom isian.";
        $message_type = 'error';
    } else {

        // --- 3. Handle Upload Foto ---
        $uploadOk = true;
        $fotoNameFinal = NULL;

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['foto']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
                $message = "Format file foto harus JPG, JPEG, PNG, atau GIF.";
                $message_type = 'error';
                $uploadOk = false;
            }

            // Nama file baru unik
            $fotoNameFinal = time() . "_" . rand(1000, 9999) . "." . $ext;

            // Pindahkan file
            if ($uploadOk) {
                move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $fotoNameFinal);
            }
        }

        // --- 4. INSERT ke database ---
        if ($uploadOk) {

            // Jika tidak ada foto diupload, simpan NULL
            if ($fotoNameFinal == NULL) {
                $fotoValue = "NULL";
            } else {
                $fotoValue = "'$fotoNameFinal'";
            }

            // Query INSERT biasa
            $sql = "
            INSERT INTO laporan (nama, lokasi, deskripsi, tanggal, foto)
            VALUES (
                '$nama',
                '$lokasi',
                '$isi',
                '$tanggal',
                $fotoValue
            )
            ";

            if ($koneksi->query($sql)) {
                $message = "Laporan Anda berhasil dikirim! Terima kasih atas informasinya.";
                $message_type = "success";
            } else {
                $message = "Terjadi kesalahan: " . $koneksi->error;
                $message_type = "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Kejadian - SILONGSOR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    },
                    colors: {
                        'brand-green': '#166534',
                        'brand-brown': '#78350F',
                        'brand-light': '#F3F4F6',
                        'brand-dark': '#1F2937',
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans bg-white text-brand-dark flex flex-col min-h-screen">

    <?php include "navbar.php" ?>

    <!-- Konten Utama -->
    <main class="flex-grow px-4 pt-40 pb-12">
        <div class="container mx-auto max-w-3xl">

            <!-- Pesan Feedback PHP -->
            <?php if ($message): ?>
                <div class="mb-6 p-4 rounded-lg <?php echo $message_type == 'success' ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <!-- Kartu Form (Background Abu-abu sesuai Wireframe) -->
            <div class="bg-gray-200 rounded-[40px] p-8 md:p-12 shadow-inner">

                <form action="lapor.php" method="POST" enctype="multipart/form-data" class="space-y-6">

                    <!-- Nama -->
                    <div>
                        <input type="text" name="nama" placeholder="Ketik Nama Anda"
                            class="w-full px-6 py-4 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-transparent shadow-sm text-gray-700 placeholder-gray-500 bg-white">
                    </div>

                    <!-- Isi Laporan (Textarea dengan rounded corner besar) -->
                    <div>
                        <textarea name="isi" rows="6" placeholder="Ketik Isi Laporan Anda"
                            class="w-full px-6 py-4 rounded-[30px] border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-transparent shadow-sm text-gray-700 placeholder-gray-500 bg-white resize-none"></textarea>
                    </div>

                    <!-- Tanggal Kejadian -->
                    <div class="relative">
                        <input type="date" name="tanggal"
                            class="w-full px-6 py-4 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-transparent shadow-sm text-gray-700 placeholder-gray-500 bg-white cursor-pointer">
                        <!-- Label visual untuk placeholder date jika browser mendukung -->
                        <div class="absolute inset-y-0 right-0 flex items-center pr-6 pointer-events-none text-gray-500">
                            <!-- Icon Calendar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Lokasi Kejadian -->
                    <div>
                        <input type="text" name="lokasi" placeholder="Ketik Lokasi Kejadian"
                            class="w-full px-6 py-4 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-green focus:border-transparent shadow-sm text-gray-700 placeholder-gray-500 bg-white">
                    </div>

                    <!-- Unggah Foto -->
                    <div class="relative group">
                        <label for="foto" class="flex items-center justify-between w-full px-6 py-4 bg-white rounded-full border border-gray-300 cursor-pointer hover:bg-gray-50 transition shadow-sm">
                            <span id="file-label" class="text-gray-500">Unggah Foto Kejadian</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 group-hover:text-brand-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </label>
                        <input type="file" name="foto" id="foto" class="hidden" accept="image/*" onchange="updateFileName(this)">
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-brand-green text-white font-bold py-4 rounded-full shadow-lg hover:bg-green-800 transition duration-300 transform hover:scale-[1.02]">
                            KIRIM LAPORAN
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <?php include "footer.php" ?>


    <script>
        // Script sederhana untuk mengubah teks pada input file saat file dipilih
        function updateFileName(input) {
            const label = document.getElementById('file-label');
            if (input.files && input.files.length > 0) {
                label.textContent = input.files[0].name;
                label.classList.add('text-brand-green', 'font-medium');
                label.classList.remove('text-gray-500');
            } else {
                label.textContent = "Unggah Foto Kejadian";
                label.classList.remove('text-brand-green', 'font-medium');
                label.classList.add('text-gray-500');
            }
        }
    </script>

</body>

</html>