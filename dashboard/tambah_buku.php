<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "INSERT INTO buku VALUES ('','$judul','$penulis','$penerbit','$tahun','$stok')");

    header("Location: buku.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Tambah Buku</h3>

    <form method="POST">
        <input type="text" name="judul" class="form-control mb-2" placeholder="Judul" required>
        <input type="text" name="penulis" class="form-control mb-2" placeholder="Penulis" required>
        <input type="text" name="penerbit" class="form-control mb-2" placeholder="Penerbit" required>
        <input type="number" name="tahun" class="form-control mb-2" placeholder="Tahun" required>
        <input type="number" name="stok" class="form-control mb-2" placeholder="Stok" required>

        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="buku.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
<?php include 'footer.php'; ?>