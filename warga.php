<?php
session_start();
include 'config/config.php';
include 'config/koneksi.php';
include 'function/helper.php';
is_login();
is_warga();


$page = isset($_GET['page']) ? $_GET['page'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard | User</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/fontawesome-free/css/all.min.css">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/components.css">

    <link rel="stylesheet" href="<?= BASE_URL . '/assets/datatables-bs4/css/dataTables.bootstrap4.min.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . '/assets/datatables-responsive/css/responsive.bootstrap4.min.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . '/assets/sweetalert2/sweetalert2.all.min.js' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . '/assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css' ?>">
    <script src="<?= BASE_URL ?>/assets/js/jquery-3.6.1.min.js"></script>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                </ul>
                <ul class="navbar-nav navbar-right ml-auto">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= BASE_URL . '/assets/img/avatar/avatar-1.png' ?>" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?= $_SESSION['nama'] ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title"></div>
                            <a href="<?= BASE_URL . '/warga.php?page=profile' ?>" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= BASE_URL . '/logout.php' ?>" onclick="document.getElementById('formLogout').submit();" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="">PL</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="">PL</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL . '/warga.php?page=dashboard' ?>"><i class="fas fa-fire"></i>
                                <span>Dashboard</span></a>
                        </li>
                    </ul>
                    <ul class="sidebar-menu">
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL . '/warga.php?page=pembayaran' ?>"><i class="fas fa-fire"></i>
                                <span>Riwayat Pembayaran</span></a>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <?php
                switch ($page) {
                    case 'dashboard':
                        include 'warga/pages/dashboard.php';
                        break;
                    case 'pembayaran':
                        include 'warga/pages/pembayaran/index.php';
                        break;
                    case 'pembayaran-detail':
                        include 'warga/pages/pembayaran/detail.php';
                        break;
                    case 'profile':
                        include 'warga/pages/profile.php';
                        break;
                    default:
                        include 'warga/pages/dashboard.php';
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