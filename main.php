<?php
session_start();
include 'config/config.php';
include 'config/koneksi.php';
include 'function/helper.php';
is_login();
is_admin();


$page = isset($_GET['page']) ? $_GET['page'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'layouts/head.php'; ?>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <?php include 'layouts/navbar.php'; ?>

            <div class="main-sidebar">
                <?php include 'layouts/sidebar.php'; ?>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <?php
                switch ($page) {
                    case 'dashboard':
                        include 'pages/dashboard.php';
                        break;
                    case 'metode-pembayaran':
                        include 'pages/metode-pembayaran/index.php';
                        break;
                    case 'metode-pembayaran-create':
                        include 'pages/metode-pembayaran/create.php';
                        break;
                    case 'metode-pembayaran-edit':
                        include 'pages/metode-pembayaran/edit.php';
                        break;
                    case 'jenis-iuran':
                        include 'pages/jenis-iuran/index.php';
                        break;
                    case 'jenis-iuran-create':
                        include 'pages/jenis-iuran/create.php';
                        break;
                    case 'jenis-iuran-edit':
                        include 'pages/jenis-iuran/edit.php';
                        break;
                    case 'periode-iuran':
                        include 'pages/periode-iuran/index.php';
                        break;
                    case 'periode-iuran-create':
                        include 'pages/periode-iuran/create.php';
                        break;
                    case 'periode-iuran-edit':
                        include 'pages/periode-iuran/edit.php';
                        break;
                    case 'komplek':
                        include 'pages/komplek/index.php';
                        break;
                    case 'komplek-create':
                        include 'pages/komplek/create.php';
                        break;
                    case 'komplek-edit':
                        include 'pages/komplek/edit.php';
                        break;
                    case 'blok':
                        include 'pages/blok/index.php';
                        break;
                    case 'blok-create':
                        include 'pages/blok/create.php';
                        break;
                    case 'blok-edit':
                        include 'pages/blok/edit.php';
                        break;
                    case 'user':
                        include 'pages/user/index.php';
                        break;
                    case 'user-create':
                        include 'pages/user/create.php';
                        break;
                    case 'user-edit':
                        include 'pages/user/edit.php';
                        break;
                    case 'pembayaran':
                        include 'pages/pembayaran/index.php';
                        break;
                    case 'pembayaran-create':
                        include 'pages/pembayaran/create.php';
                        break;
                    case 'pembayaran-edit':
                        include 'pages/pembayaran/edit.php';
                        break;
                    case 'profile':
                        include 'pages/profile.php';
                        break;
                    case 'laporan':
                        include 'pages/laporan/index.php';
                        break;
                    default:
                        include 'pages/dashboard.php';
                        break;
                }
                ?>
            </div>
            <footer class="main-footer">
                <div class="text-center">
                    &copy; Copyright 2023
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>


    <script src="<?= BASE_URL ?>/assets/js/jquery.nicescroll.min.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/moment.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/popper.min.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/stisla.js"></script>
    <script src="<?= BASE_URL ?>/assets/bs/js/bootstrap.min.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="<?= BASE_URL ?>/assets/js/scripts.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/custom.js"></script>

    <script src="<?= BASE_URL . '/assets/datatables/jquery.dataTables.min.js' ?>"></script>
    <script src="<?= BASE_URL . '/assets/datatables-bs4/js/dataTables.bootstrap4.min.js' ?>"></script>
    <script src="<?= BASE_URL . '/assets/sweetalert2/sweetalert2.min.js' ?>"></script>
    <script>
        $(function() {
            $('#dTable').DataTable();
        })
    </script>
</body>

</html>