<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $captcha  = $_POST['captcha'];

    if ($captcha != $_SESSION['captcha']) {
        echo "<script>alert('Captcha salah!');</script>";
    } else {

        $cek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

        if (mysqli_num_rows($cek) > 0) {
            echo "<script>alert('Username sudah ada!');</script>";
        } else {

            mysqli_query($conn, "INSERT INTO user (username,password,role) VALUES ('$username','$password','admin')");
            echo "<script>alert('Register berhasil!'); window.location='login.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
</script>

</body>
</html>