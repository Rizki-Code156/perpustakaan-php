<?php if (!isset($_SESSION['login'])) { header("Location: ../auth/login.php"); exit; } ?>
<style>
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length {
        margin-bottom: 12px;
    }
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        margin-left: 6px;
    }
    div.dataTables_wrapper {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 16px;
        background: #fff;
        margin-top: 16px;
    }
    div.dataTables_wrapper .dataTables_filter {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 12px;
    }
    div.dataTables_wrapper .dataTables_length {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 12px;
    }
    div.dataTables_wrapper table.dataTable {
        margin-top: 12px !important;
        margin-bottom: 12px !important;
    }
    div.dataTables_wrapper .dataTables_info,
    div.dataTables_wrapper .dataTables_paginate {
        border-top: 1px solid #dee2e6;
        padding-top: 12px;
        margin-top: 4px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a href="dashboard.php" class="navbar-brand d-flex align-items-center text-white">
            <img src="../img/uinssc.png" style="width:36px;" class="me-2">
            Perpustakaan UINSSC
        </a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-white small">👋 <?php echo $_SESSION['user']; ?></span>
            <a href="#" onclick="konfirmasiLogout()" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>
