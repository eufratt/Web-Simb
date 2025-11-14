<?php
session_start();

// Jika sudah login
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

require_once 'config.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error_message = "Username dan password tidak boleh kosong.";
    } else {
        // LOGIN SEDERHANA TANPA HASH
        $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if ($password === $row['password']) { // langsung cocokkan password
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];

                header("Location: dashboard.php");
                exit;
            } else {
                $error_message = "Username atau password salah.";
            }
        } else {
            $error_message = "Username atau password salah.";
        }
    }
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

    <?php include 'navbar.php' ?>

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