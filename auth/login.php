<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $captcha  = $_POST['captcha'];

    if ($captcha != $_SESSION['captcha']) {
        $notif = "captcha_salah";
    } else {

        $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
        $data = mysqli_fetch_assoc($query);

        if ($data) {
            $_SESSION['login'] = true;
            $_SESSION['user'] = $data['username'];
            $notif = "sukses";
        } else {
            $notif = "gagal";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4">

        <div class="card">
            <div class="card-header text-center">
                <h4>Login</h4>
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

                    <button type="submit" name="login" class="btn btn-primary w-100 mb-2">Login</button>
                    <a href="../index.php" class="btn btn-outline-secondary w-100">← Kembali ke Beranda</a>

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
    title: 'Login Berhasil!',
    html: 'Selamat datang, <b><?= $_SESSION['user'] ?></b>!<br>Mengalihkan ke dashboard...',
    icon: 'success',
    timer: 2000,
    timerProgressBar: true,
    showConfirmButton: false,
    allowOutsideClick: false
}).then(() => {
    window.location = '../dashboard/dashboard.php';
});
<?php } elseif ($notif === 'gagal') { ?>
Swal.fire({
    title: 'Login Gagal!',
    text: 'Username atau password salah. Silakan coba lagi.',
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