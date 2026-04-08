<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

// filter tanggal
$where = "";
if (isset($_GET['dari']) && isset($_GET['sampai'])) {
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];
    $where = "WHERE tanggal_pinjam BETWEEN '$dari' AND '$sampai'";
}

// data tabel
$data = mysqli_query($conn, "
    SELECT transaksi.*, anggota.nama, buku.judul 
    FROM transaksi
    JOIN anggota ON transaksi.id_anggota = anggota.id_anggota
    JOIN buku ON transaksi.id_buku = buku.id_buku
    $where
");

// data grafik
$grafik = mysqli_query($conn, "
    SELECT MONTH(tanggal_pinjam) as bulan, COUNT(*) as total 
    FROM transaksi
    $where
    GROUP BY MONTH(tanggal_pinjam)
");

$bulan = [];
$total = [];

while($g = mysqli_fetch_assoc($grafik)){
    $bulan[] = $g['bulan'];
    $total[] = $g['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    @media print {
        body * { visibility: hidden; }
        #tabelPrint, #tabelPrint * { visibility: visible; }
        #tabelPrint { position: absolute; top: 0; left: 0; width: 100%; }
    }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>📊 Laporan Transaksi</h3>

    <!-- FILTER -->
    <form method="GET" class="row mb-3">
        <div class="col-md-3">
            <input type="date" name="dari" class="form-control">
        </div>
        <div class="col-md-3">
            <input type="date" name="sampai" class="form-control">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="laporan.php" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <!-- ✅ TABEL -->
    <table id="tabelPrint" class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Denda</th>
        </tr>

        <?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['tanggal_pinjam'] ?></td>
            <td><?= $row['tanggal_kembali'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>Rp <?= number_format($row['denda']) ?></td>
        </tr>
        <?php } ?>
    </table>

    <button onclick="window.print()" class="btn btn-success mb-4">🖨️ Print</button>
    <a href="dashboard.php" class="btn btn-secondary mb-4">Kembali</a>

    <!-- GRAFIK -->
    <div class="card mt-4">
        <div class="card-body">
            <h5>Grafik Peminjaman Buku</h5>
            <canvas id="myChart"></canvas>
        </div>
    </div>

</div>

<script>
const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($bulan) ?>,
        datasets: [{
            label: 'Jumlah Peminjaman',
            data: <?= json_encode($total) ?>,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>
<?php include 'footer.php'; ?>