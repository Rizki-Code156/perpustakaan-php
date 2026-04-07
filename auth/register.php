<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $captcha  = $_POST['captcha'];

    if ($captcha != $_SESSION['captcha']) {
        $notif = "captcha_salah";
    } else {

        $cek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

        if (mysqli_num_rows($cek) > 0) {
            $notif = "username_ada";
        } else {
            mysqli_query($conn, "INSERT INTO user (username,password,role) VALUES ('$username','$password','admin')");
            $notif = "sukses";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4">

        <div class="card">
            <div class="card-header text-center">
                <h4>Register</h4>
            </div>

            <div class="card-body">
                <form method="POST">

                    <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
                    <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

                    <!-- CAPTCHA -->
                    <div class="mb-2">
                        <img src="../captcha/captcha.php" id="captchaImg">
                        <button type="button" onclick="refreshCaptcha()" class="btn btn-sm btn-secondary">↻</button>
                    </div>

                    <input type="text" name="captcha" class="form-control mb-3" placeholder="Masukkan captcha" required>

                    <button type="submit" name="register" class="btn btn-primary w-100">Daftar</button>

                </form>
            </div>
        </div>

    </div>
</div>

<script>
function refreshCaptcha() {
    document.getElementById('captchaImg').src = 'captcha.php?' + Date.now();
}

<?php if (isset($notif)) { ?>
<?php if ($notif === 'sukses') { ?>
Swal.fire({
    title: 'Registrasi Berhasil!',
    html: 'Akun kamu berhasil dibuat.<br>Mengalihkan ke halaman login...',
    icon: 'success',
    timer: 2000,
    timerProgressBar: true,
    showConfirmButton: false,
    allowOutsideClick: false
}).then(() => {
    window.location = 'login.php';
});
<?php } elseif ($notif === 'username_ada') { ?>
Swal.fire({
    title: 'Username Sudah Dipakai!',
    text: 'Coba gunakan username yang berbeda.',
    icon: 'error',
    confirmButtonColor: '#e3342f',
    confirmButtonText: 'Coba Lagi'
});
<?php } elseif ($notif === 'captcha_salah') { ?>
Swal.fire({
    title: 'Captcha Salah!',
    text: 'Kode captcha yang kamu masukkan tidak sesuai.',
    icon: 'warning',
    confirmButtonColor: '#f6993f',
    confirmButtonText: 'OK'
});
<?php } ?>
<?php } ?>
</script>

</body>
</html>