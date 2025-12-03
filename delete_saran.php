<?php
session_start();

// Cek login admin
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Koneksi database
include "config.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // amankan integer

    // Hapus data
    $hapus = $conn->query("DELETE FROM saran WHERE id = $id");

    if ($hapus) {
        echo "<script>
            alert('Saran berhasil dihapus!');
            window.location.href = 'dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus!');
            window.location.href = 'dashboard.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ID tidak ditemukan!');
        window.location.href = 'dashboard.php';
    </script>";
}
