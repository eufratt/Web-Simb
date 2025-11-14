<?php
include 'config.php';

// Ambil data artikel dari database
$sql = "SELECT * FROM articles ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Tanah Longsor - Pencegahan dan Edukasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Kustomisasi mirip template: Background gradien, font elegan */
        body { font-family: 'Arial', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #333; }
        .hero { background: url('https://source.unsplash.com/featured/?landslide') no-repeat center center; background-size: cover; height: 100vh; display: flex; align-items: center; justify-content: center; color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
        .section { padding: 60px 0; }
        .card { border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        footer { background: #343a40; color: white; padding: 20px 0; }
    </style>
</head>
<body>

    <!-- Header (Mirip template: Navigasi sticky) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-mountain"></i> Info Tanah Longsor</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#hero">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#articles">Artikel</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section (Mirip template: Full-screen dengan overlay) -->
    <section id="hero" class="hero">
        <div class="container text-center">
            <h1 class="display-4">Pahami dan Cegah Bencana Tanah Longsor</h1>
            <p class="lead">Edukasi, pencegahan, dan informasi terkini tentang tanah longsor untuk keselamatan bersama.</p>
            <a href="#articles" class="btn btn-primary btn-lg">Pelajari Lebih Lanjut</a>
        </div>
    </section>

    <!-- About Section (Mirip template: Grid layout) -->
    <section id="about" class="section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Tentang Tanah Longsor</h2>
                    <p>Tanah longsor adalah bencana alam yang sering terjadi di daerah berbukit. Kami menyediakan informasi untuk membantu masyarakat memahami dan mencegahnya.</p>
                </div>
                <div class="col-md-6">
                    <img src="https://source.unsplash.com/featured/?prevention" class="img-fluid rounded" alt="Pencegahan Tanah Longsor">
                </div>
            </div>
        </div>
    </section>

    <!-- Articles Section (Dinamis dari Database, Mirip template: Card grid) -->
    <section id="articles" class="section">
        <div class="container">
            <h2 class="text-center mb-4">Artikel Edukasi</h2>
            <div class="row">
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                    <p class="card-text"><?php echo substr($row['content'], 0, 100) . '...'; ?></p>
                                    <a href="#" class="btn btn-outline-primary">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">Tidak ada artikel tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section (Mirip template: Form sederhana) -->
    <section id="contact" class="section bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Hubungi Kami</h2>
            <form class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="col-12">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea class="form-control" id="message" rows="3"></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer (Mirip template: Links dan copyright) -->
    <footer>
        <div class="container text-center">
            <p>&copy; 2023 Info Tanah Longsor. Semua hak dilindungi.</p>
            <div>
                <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
