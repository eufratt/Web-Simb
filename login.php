<?php
// Memulai sesi
session_start();

// Jika pengguna sudah login, alihkan ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Memasukkan file konfigurasi database
require_once 'config.php';

$error_message = '';

// Cek jika form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi dasar
    if (empty($username) || empty($password)) {
        $error_message = "Username dan password tidak boleh kosong.";
    } else {
        // Menyiapkan statement SQL untuk mencegah SQL Injection
        $sql = "SELECT id, username, password_hash FROM users WHERE username = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            
            if ($stmt->execute()) {
                $stmt->store_result();
                
                // Cek jika username ada
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        // Verifikasi password
                        if (password_verify($password, $hashed_password)) {
                            // Password benar, mulai sesi baru
                            session_regenerate_id();
                            $_SESSION['user_id'] = $id;
                            $_SESSION['username'] = $username;
                            
                            // Alihkan ke dashboard
                            header("Location: dashboard.php");
                            exit;
                        } else {
                            // Password salah
                            $error_message = "Username atau password salah.";
                        }
                    }
                } else {
                    // Username tidak ditemukan
                    $error_message = "Username atau password salah.";
                }
            } else {
                $error_message = "Terjadi kesalahan. Silakan coba lagi.";
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SILONGSOR</title>
    <!-- Memuat Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Memuat font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Konfigurasi kustom Tailwind (dicocokkan dari index.php) -->
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
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="font-sans bg-brand-light text-brand-dark flex flex-col min-h-screen">

    <!-- Header & Navigasi (Berdasarkan wireframe) -->
    <header class="sticky top-0 z-50 w-full bg-white shadow-md">
        <!-- Navigasi Utama -->
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center h-20">
            <!-- Nama/Brand -->
            <a href="index.php" class="text-3xl font-bold text-brand-dark">
                Nama
            </a>
            <!-- Link Navigasi Utama -->
            <div class="hidden md:flex space-x-8">
                <a href="index.php#beranda" class="text-gray-600 hover:text-brand-green font-medium">Beranda</a>
                <a href="#" class="text-gray-600 hover:text-brand-green font-medium">Berita</a>
                <a href="#" class="text-gray-600 hover:text-brand-green font-medium">Artikel</a>
                <a href="index.php#lapor" class="text-gray-600 hover:text-brand-green font-medium">Lapor</a>
                <a href="#" class="text-gray-600 hover:text-brand-green font-medium">Peta</a>
            </div>
            <!-- Tombol (jika perlu) -->
            <a href="login.php" class="hidden md:inline-block bg-brand-brown text-white px-5 py-2 rounded-lg font-medium shadow-lg hover:bg-yellow-900 transition duration-300">
                Login Admin
            </a>
        </nav>
        <!-- Navigasi Sekunder (Berdasarkan wireframe) -->
        <div class="w-full bg-gray-100 border-t border-gray-200">
            <div class="container mx-auto px-6 py-2 flex justify-end items-center space-x-6">
                <a href="mailto:info@silongsor.id" class="text-sm text-gray-500 hover:text-brand-green">Email</a>
                <a href="#" class="text-sm text-gray-500 hover:text-brand-green">Media Sosial</a>
                <a href="index.php#kontak" class="text-sm text-gray-500 hover:text-brand-green">Saran</a>
            </div>
        </div>
    </header>

    <!-- Konten Utama: Form Login -->
    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Card Login -->
            <div class="bg-white shadow-2xl rounded-2xl p-8 sm:p-10">
                <!-- LOGO -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-brand-dark">
                        LOGO
                    </h2>
                    <p class="mt-2 text-gray-600">Login untuk mengakses dashboard admin</p>
                </div>

                <!-- Tampilkan pesan error jika ada -->
                <?php if (!empty($error_message)): ?>
                    <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 border border-red-300" role="alert">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                <!-- Form Login -->
                <form class="space-y-6" action="login.php" method="POST">
                    <!-- Input Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                            Username
                        </label>
                        <input id="username" name="username" type="text" autocomplete="username" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-brand-green focus:border-brand-green"
                               placeholder="Masukkan username Anda">
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-brand-green focus:border-brand-green"
                               placeholder="Masukkan password Anda">
                    </div>

                    <!-- Tombol Submit -->
                    <div>
                        <button type="submit"
                                class="w-full flex justify-center bg-brand-green text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:bg-green-800 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-green">
                            Login
                        </button>
                    </div>
                </form>

                <!-- Link ke Register -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Belum punya akun?
                        <a href="register.php" class="font-medium text-brand-green hover:text-green-800">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-8 bg-brand-dark text-gray-400 mt-auto">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2024 SILONGSOR. Dibuat untuk tujuan edukasi.</p>
        </div>
    </footer>

</body>
</html>