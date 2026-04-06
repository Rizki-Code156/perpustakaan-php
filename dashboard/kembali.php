<?php
include '../config/koneksi.php';

$id = $_GET['id'];

// ambil data transaksi
$data = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi='$id'");
$row = mysqli_fetch_assoc($data);

$tgl_pinjam = $row['tanggal_pinjam'];
$tgl_kembali = date('Y-m-d');

// hitung selisih hari
$pinjam = strtotime($tgl_pinjam);
$kembali = strtotime($tgl_kembali);

$selisih = ($kembali - $pinjam) / (60 * 60 * 24);

// aturan: max 7 hari
$terlambat = max(0, $selisih - 1);

// denda 1000/hari
$denda = $terlambat * 15000;

// update transaksi
mysqli_query($conn, "UPDATE transaksi SET
    tanggal_kembali='$tgl_kembali',
    status='kembali',
    denda='$denda'
    WHERE id_transaksi='$id'
");

header("Location: transaksi.php");