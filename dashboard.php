<?php
// Koneksi database
$koneksi = new mysqli("localhost", "root", "", "tanah_longsor_db");

// Query laporan
$laporan = $koneksi->query("SELECT * FROM laporan ORDER BY tanggal DESC LIMIT 5");

// Query saran
$saran = $koneksi->query("SELECT * FROM saran ORDER BY tanggal DESC LIMIT 10");

session_start();

// Cek apakah user belum login
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];  // jika mau dipakai



?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800"> class="bg-gray-100 text-gray-800">
  <!-- Navbar -->
  <header class="w-full bg-white shadow fixed top-0 left-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <div class="text-lg font-semibold">Dashboard Admin</div>
    </div>
  </header>

  <main class="pt-28 max-w-6xl mx-auto px-6">
    <!-- Laporan Terbaru -->
    <section class="mb-16">
      <h2 class="text-center text-lg font-semibold mb-6">Laporan Terbaru</h2>
      <div class="bg-gray-200 rounded-lg p-6 shadow">
        <div class="space-y-4">
          <?php while ($row = $laporan->fetch_assoc()): ?>
            <div class="flex items-center justify-between p-3 bg-white rounded shadow-sm">
              <div class="md:w-1/3">
                <span><?= date('d M Y H:i', strtotime($row['tanggal'])) ?></span>
              </div>
              <div class="md:w-1/3 w-20 h-20 bg-gray-300 flex items-center justify-center rounded">
                <img src="uploads/<?= $row['foto'] ?>" class="w-full h-full object-cover rounded" />
              </div>
              <div class="md:w-1/3 flex flex-col text-right">
                <span class="font-semibold"><?= htmlspecialchars($row['lokasi']) ?></span>
                <span class="text-gray-600 text-sm"><?= htmlspecialchars($row['deskripsi']) ?></span>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </section>

    <!-- Saran dari Pengguna -->
    <section>
      <h2 class="text-center text-lg font-semibold mb-6">Saran dari Pengguna</h2>
      <div class="space-y-8">
        <?php while ($row = $saran->fetch_assoc()): ?>
          <div class="bg-gray-200 rounded-2xl p-6 shadow">
            <div class="flex justify-between items-start">
              <h3 class="text-lg font-bold"><?= htmlspecialchars($row['nama']) ?></h3>
              <span class="text-sm"><?= htmlspecialchars($row['email']) ?></span>
            </div>
            <div class="text-xs text-gray-600 mb-3"><?= date('d M Y H:i', strtotime($row['tanggal'])) ?></div>
            <p class="text-sm"><?= htmlspecialchars($row['pesan']) ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    </section>
  </main>
</body>

</html>