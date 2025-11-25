<?php
// Koneksi database
$koneksi = new mysqli("localhost", "root", "", "tanah_longsor_db");

// Query laporan
$laporan = $koneksi->query("SELECT * FROM laporan ORDER BY tanggal DESC LIMIT 10");

// Query saran
$saran = $koneksi->query("SELECT * FROM saran ORDER BY tanggal DESC LIMIT 5");

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

<body class="bg-[#FAF3E8] text-[#3B2F23] min-h-screen">

  <!-- Navbar -->
  <header class="w-full fixed top-0 left-0 z-50 bg-[#FFF8EF]/80 backdrop-blur-xl border-b border-[#C8A27A]/40 shadow">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <div class="text-xl font-semibold text-[#7A4F2A]">Dashboard Admin</div>

      <a href="logout.php"
        class="bg-[#D86B32] hover:bg-[#E57F42] text-white px-5 py-2.5 rounded-lg text-sm font-medium shadow-md transition">
        Logout
      </a>
    </div>
  </header>


  <!-- MAIN CONTENT -->
  <main class="pt-32 max-w-6xl mx-auto px-6 mb-6">

    <!-- Laporan Terbaru -->
    <section class="mb-16">
      <h2 class="text-center text-xl font-semibold mb-8 text-[#7A4F2A]">Laporan Terbaru</h2>

      <?php while ($row = $laporan->fetch_assoc()): ?>
        <div class="flex justify-between items-start p-4 bg-white rounded-xl border border-[#DCC2A4]/60 shadow-sm hover:shadow-lg transition">

          <!-- Bagian Kiri -->
          <div class="flex-1 pr-4">

            <!-- Tanggal -->
            <div class="text-sm text-[#B69E89] mb-1">
              <?= date('d M Y H:i', strtotime($row['tanggal'])) ?>
            </div>

            <!-- Nama -->
            <div class="font-bold text-[#7A4F2A] text-lg">
              <?= htmlspecialchars($row['nama']) ?>
            </div>

            <!-- Lokasi -->
            <div class="text-[#5A4637] text-sm italic mb-2">
              <?= htmlspecialchars($row['lokasi']) ?>
            </div>

            <!-- Deskripsi -->
            <p class="text-[#6F604F] text-sm leading-snug">
              <?= htmlspecialchars($row['deskripsi']) ?>
            </p>
          </div>

          <!-- Foto di kanan -->
          <?php if ($row['foto']): ?>
            <div class="ml-4">
              <img src="uploads/<?= $row['foto'] ?>"
                class="w-24 h-24 rounded-lg shadow cursor-pointer object-cover hover:scale-105 transition"
                onclick="openImage('uploads/<?= $row['foto'] ?>')">
            </div>
          <?php endif; ?>

        </div>
      <?php endwhile; ?>

    </section>


    <!-- Saran Pengguna -->
    <section class="mb-14">
      <h2 class="text-center text-xl font-semibold mb-8 text-[#7A4F2A]">Saran dari Pengguna</h2>

      <div class="space-y-8">
        <?php while ($row = $saran->fetch_assoc()): ?>
          <div class="bg-white rounded-2xl p-6 border border-[#DCC2A4] shadow-md">

            <div class="flex justify-between items-start mb-2">
              <h3 class="text-lg font-bold text-[#7A4F2A]"><?= htmlspecialchars($row['nama']) ?></h3>
              <span class="text-sm text-[#8A7865]"><?= htmlspecialchars($row['email']) ?></span>
            </div>

            <div class="text-xs text-[#B69E89] mb-3">
              <?= date('d M Y H:i', strtotime($row['tanggal'])) ?>
            </div>

            <p class="text-[#5A4637] text-sm">
              <?= htmlspecialchars($row['pesan']) ?>
            </p>

          </div>
        <?php endwhile; ?>
      </div>

    </section>
  </main>


  <!-- Modal Preview -->
  <div id="imgModal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-50">
    <div class="relative">
      <img id="modalImage"
        src=""
        class="max-h-[90vh] max-w-[90vw] rounded-2xl shadow-xl border border-[#C8A27A]">

      <button onclick="closeImage()"
        class="absolute top-3 right-3 bg-[#D86B32] hover:bg-[#E57F42] 
                       text-white px-4 py-1.5 rounded-full shadow">
        ✕
      </button>
    </div>
  </div>


</body>

<script>
  function openImage(src) {
    document.getElementById("modalImage").src = src;
    document.getElementById("imgModal").classList.remove("hidden");
  }

  function closeImage() {
    document.getElementById("imgModal").classList.add("hidden");
  }
</script>




</html>