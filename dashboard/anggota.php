<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM anggota");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container mt-4">
    <h3>👤 Data Anggota</h3>

    <a href="tambah_anggota.php" class="btn btn-primary mb-3">+ Tambah Anggota</a>
    <a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>

    <table id="tabelku" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>NIM</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?></td>
            <td><?= htmlspecialchars($row['no_hp']) ?></td>
            <td><?= htmlspecialchars($row['nim']) ?></td>
            <td>
                <a href="hapus_anggota.php?id=<?= $row['id_anggota'] ?>" 
                   onclick="return konfirmasiHapus(this, '<?= htmlspecialchars($row['nama']) ?>')" 
                   class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#tabelku').DataTable({
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "paginate": {
                "next": "Next",
                "previous": "Prev"
            }
        }
    });
});

function konfirmasiHapus(el, nama) {
    Swal.fire({
        title: 'Hapus Anggota?',
        html: `Anggota <b>"${nama}"</b> akan dihapus secara permanen.`,
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

<!-- CSS belang -->
<style>
#tabelku tbody tr.odd {
    background-color: #f9f9f9 !important;
}

#tabelku tbody tr.even {
    background-color: #e9ecef !important;
}

#tabelku tbody tr:hover {
    background-color: #d6e4ff !important;
}
</style>

</body>
</html>