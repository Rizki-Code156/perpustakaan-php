<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .logo {
            width: 50px;
        }
        .carousel img {
            height: 400px;
            object-fit: cover;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <!-- LOGO -->
        <a href="index.php">
            <img src="img/uinssc.png" class="logo me-2">
        </a>

        <!-- JUDUL -->
        <a class="navbar-brand" href="index.php">Perpustakaan Kampus</a>

        <div class="ms-auto">
            <a href="auth/login.php" class="btn btn-light btn-sm me-2">Login</a>
            <a href="auth/register.php" class="btn btn-warning btn-sm">Register</a>
        </div>
    </div>
</nav>

<!-- CAROUSEL -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="img/perpus1.jpg" class="d-block w-100">
        </div>

        <div class="carousel-item">
            <img src="img/perpus2.jpg" class="d-block w-100">
        </div>

        <div class="carousel-item">
            <img src="img/perpus3.jpg" class="d-block w-100">
        </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- SECTION INFO -->
<div class="container mt-5">
    <div class="text-center">
        <h2>Selamat Datang di Perpustakaan UINSSC</h2>
        <p>Temukan berbagai buku terbaik untuk menunjang pembelajaran Anda</p>
    </div>
</div>

<!-- BUKU TERPOPULER -->
<div class="container mt-5">
    <h3 class="mb-4">📚 Buku Terpopuler</h3>

    <div class="row">

        <div class="col-md-3">
            <div class="card">
                <img src="img/php.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Pemrograman PHP</h5>
                    <p class="card-text">Buku dasar belajar PHP</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <img src="img/bbasdat.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Basis Data</h5>
                    <p class="card-text">Konsep database modern</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <img src="img/bjarkom.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Jaringan Komputer</h5>
                    <p class="card-text">Belajar networking</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <img src="img/alpro.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Algoritma</h5>
                    <p class="card-text">Logika pemrograman</p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- SECTION FITUR -->
<div class="container mt-5">
    <h3 class="mb-4">✨ Fitur Sistem</h3>

    <div class="row text-center">
        <div class="col-md-3">
            <h5>📖 Data Buku</h5>
            <p>Kelola semua buku dengan mudah</p>
        </div>
        <div class="col-md-3">
            <h5>👤 Anggota</h5>
            <p>Manajemen data anggota</p>
        </div>
        <div class="col-md-3">
            <h5>🔄 Transaksi</h5>
            <p>Peminjaman & pengembalian</p>
        </div>
        <div class="col-md-3">
            <h5>📊 Laporan</h5>
            <p>Rekap data lengkap</p>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center p-3 mt-5">
    <p>© 2026 Perpustakaan Kampus</p>
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AUTO SLIDE -->
<script>
    var myCarousel = document.querySelector('#carouselExample');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 3000,
        ride: 'carousel'
    });
</script>

</body>
</html>