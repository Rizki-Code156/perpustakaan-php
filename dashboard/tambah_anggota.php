<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
	$nim = $_POST['nim'];

    mysqli_query($conn, "INSERT INTO anggota VALUES ('','$nim','$nama','$alamat','$no_hp')");

    header("Location: anggota.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>Tambah Anggota</h3>

    <form method="POST">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required>
        <input type="text" name="alamat" class="form-control mb-2" placeholder="Alamat" required>
        <input type="text" name="no_hp" class="form-control mb-2" placeholder="No HP" required>
		<input type="text" name="nim" class="form-control mb-2" placeholder="NIM" required>

        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="anggota.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>