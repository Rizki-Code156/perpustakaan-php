<?php
session_start();

// cek login
if (!isset($_SESSION['login'])) {
    header("Location: auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .logo {
            width: 50px;
        }

        .banner {
            position: relative;
        }

        .banner img {
            height: 350px;
            object-fit: cover;
        }

        .banner-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            background: rgba(0,0,0,0.5);
            padding: 20px 30px;
            border-radius: 10px;
        }

        .banner-text h1 {
            font-size: 35px;
            font-weight: bold;
        }

        .banner-text p {
            font-size: 18px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <a href="dashboard.php" class="navbar-brand d-flex align-items-center text-white">
            <img src="../img/uinssc.png" class="logo me-2">
            Dashboard Perpustakaan
        </a>

        <div class="ms-auto">
            <span class="text-white me-3">
                👋 <?php echo $_SESSION['user']; ?>
            </span>
            <a href="#" onclick="konfirmasiLogout()" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<!-- BANNER -->
<div class="banner">
    <img src="../img/buku2.jpg" class="w-100">

    <div class="banner-text">
        <h1>Selamat Datang, <?php echo $_SESSION['user']; ?>!</h1>
        <p>
            Ini adalah halaman administrasi perpustakaan. 
            Di sini kamu bisa mengelola data buku, mengatur anggota, 
            serta memantau transaksi peminjaman dan pengembalian.
        </p>
    </div>
</div>

<!-- MENU -->
<div class="container mt-5">

    <div class="row g-3">

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>📚 Buku</h5>
                    <p>Kelola data buku</p>
                    <a href="buku.php" class="btn btn-primary btn-sm">Masuk</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>👤 Anggota</h5>
                    <p>Kelola data anggota</p>
                    <a href="anggota.php" class="btn btn-primary btn-sm">Masuk</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>🔄 Transaksi</h5>
                    <p>Peminjaman & pengembalian</p>
                    <a href="transaksi.php" class="btn btn-primary btn-sm">Masuk</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>📊 Laporan</h5>
                    <p>Lihat laporan transaksi</p>
                    <a href="laporan.php" class="btn btn-primary btn-sm">Masuk</a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>

<script>
function konfirmasiLogout() {
    Swal.fire({
        title: 'Logout?',
        text: 'Kamu akan keluar dari sesi ini.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '🚪 Ya, Logout!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../logout.php';
        }
    });
}
</script>