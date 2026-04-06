<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

// ambil data buku & anggota
$buku = mysqli_query($conn, "SELECT * FROM buku");
$anggota = mysqli_query($conn, "SELECT * FROM anggota");

// simpan transaksi
if (isset($_POST['simpan'])) {
    $id_buku = $_POST['id_buku'];
    $id_anggota = $_POST['id_anggota'];
    $tanggal_pinjam = date('Y-m-d');

    mysqli_query($conn, "INSERT INTO transaksi 
    VALUES ('','$id_buku','$id_anggota','$tanggal_pinjam',NULL,'dipinjam',0)");

    header("Location: transaksi.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>

<div class="container mt-4">
    <h3>🔄 Transaksi Peminjaman</h3>

    <!-- FORM -->
    <form method="POST" class="mb-4">

        <select name="id_anggota" class="form-control mb-2" required>
            <option value="">-- Pilih Anggota --</option>
            <?php while($a = mysqli_fetch_assoc($anggota)) { ?>
                <option value="<?= $a['id_anggota'] ?>">
                    <?= $a['nim'] ?> - <?= $a['nama'] ?>
                </option>
            <?php } ?>
        </select>

        <select name="id_buku" class="form-control mb-2" required>
            <option value="">-- Pilih Buku --</option>
            <?php while($b = mysqli_fetch_assoc($buku)) { ?>
                <option value="<?= $b['id_buku'] ?>">
                    <?= $b['judul'] ?> (Stok: <?= $b['stok'] ?>)
                </option>
            <?php } ?>
        </select>

        <button type="submit" name="simpan" class="btn btn-success">
            Simpan Peminjaman
        </button>
    </form>

    <!-- TABEL -->
    <table id="tabelku" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
                <th>Aksi</th>
                <th>Denda</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $no = 1;
        $data = mysqli_query($conn, "
            SELECT transaksi.*, anggota.nama, buku.judul 
            FROM transaksi
            JOIN anggota ON transaksi.id_anggota = anggota.id_anggota
            JOIN buku ON transaksi.id_buku = buku.id_buku
        ");

        while ($row = mysqli_fetch_assoc($data)) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['judul']) ?></td>
            <td><?= $row['tanggal_pinjam'] ?></td>
            <td><?= $row['status'] ?></td>

            <td>
                <?php if ($row['status'] == 'dipinjam') { ?>
                    <a href="kembali.php?id=<?= $row['id_transaksi'] ?>" 
                       class="btn btn-warning btn-sm">Kembalikan</a>
                <?php } else { ?>
                    -
                <?php } ?>
            </td>

            <td>Rp <?= $row['denda'] ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#tabelku').DataTable({
        "pageLength": 5,
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