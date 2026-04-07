<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM buku");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<div class="container mt-4">
    <h3>📚 Data Buku</h3>

    <a href="tambah_buku.php" class="btn btn-primary mb-3">+ Tambah Buku</a>
    <a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>

    <table id="tabelku" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['judul']) ?></td>
                <td><?= htmlspecialchars($row['penulis']) ?></td>
                <td><?= htmlspecialchars($row['penerbit']) ?></td>
                <td><?= $row['tahun'] ?></td>
                <td><?= $row['stok'] ?></td>
                <td>
                    <a href="hapus_buku.php?id=<?= $row['id_buku'] ?>" 
                       onclick="return konfirmasiHapus(this, '<?= htmlspecialchars($row['judul']) ?>')" 
                       class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function () {
    $('#tabelku').DataTable();
});

function konfirmasiHapus(el, judul) {
    Swal.fire({
        title: 'Hapus Buku?',
        html: `Buku <b>"${judul}"</b> akan dihapus secara permanen.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '🗑️ Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = el.href;
        }
    });
    return false;
}
</script>

</body>
</html>