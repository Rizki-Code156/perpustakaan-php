<footer class="bg-primary text-white text-center py-3 mt-5">
    <small>© 2026 Perpustakaan UINSSC — All Rights Reserved</small>
</footer>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function konfirmasiLogout() {
    Swal.fire({
        title: 'Logout?',
        text: 'Kamu akan keluar dari sesi ini.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '🚪 Ya, Logout!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../logout.php';
        }
    });
}
</script>
