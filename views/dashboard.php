<?php
require_once __DIR__ . '/../models/anggota.php';
require_once __DIR__ . '/../models/pegawai.php';
require_once __DIR__ . '/../models/produk.php';
require_once __DIR__ . '/../models/pesanan.php';
require_once __DIR__ . '/../models/pembayaran.php';
require_once __DIR__ . '/../models/kartu_diskon.php';

use models\Anggota;
use models\Pegawai;
use models\Produk;
use models\Pesanan;
use models\Pembayaran;
use models\KartuDiskon;

$totalAnggota     = count(Anggota::get());
$totalPegawai     = count(Pegawai::get());
$totalProduk      = count(Produk::get());
$totalPesanan   = count(Pesanan::get());
$totalPembayaran   = count(Pembayaran::get());
$totalKartuDiskon = count(KartuDiskon::get());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Koperasi Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
    <link href="../public/css/dashboard.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="dashboard.php">Koperasi Pegawai</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main Menu</div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAnggota" aria-expanded="false" aria-controls="collapseAnggota">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                            Manajemen Anggota
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseAnggota" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="list-anggota.php">Data Anggota</a>
                                <a class="nav-link" href="list-pegawai.php">Data Pegawai</a>
                                <a class="nav-link" href="list-kartu_diskon.php">Kartu Diskon</a>
                            </nav>
                        </div>

                        <a class="nav-link" href="list-produk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Produk
                        </a>
                        <a class="nav-link" href="list-pesanan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div>
                            Pesanan
                        </a>
                        <a class="nav-link" href="list-pembayaran.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                            Transaksi
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Aulia Tattya Rahma
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
                    <div class="row mt-4">

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <a href="list-anggota.php" class="text-white text-decoration-none">
                                    <div class="card-body">Total Anggota: <?= $totalAnggota ?></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <a href="list-pegawai.php" class="text-white text-decoration-none">
                                    <div class="card-body">Total Pegawai: <?= $totalPegawai ?></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <a href="list-produk.php" class="text-white text-decoration-none">
                                    <div class="card-body">Total Produk: <?= $totalProduk ?></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <a href="list-pesanan.php" class="text-white text-decoration-none">
                                    <div class="card-body">Total Pesanan: <?= $totalPesanan ?></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-info text-white mb-4">
                                <a href="list-pembayaran.php" class="text-white text-decoration-none">
                                    <div class="card-body">Total Pembayaran: <?= $totalPembayaran ?></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-secondary text-white mb-4">
                                <a href="list-kartu_diskon.php" class="text-white text-decoration-none">
                                    <div class="card-body">Kartu Diskon: <?= $totalKartuDiskon ?></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; PW2 <?= date('Y') ?></div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../public/js/scripts.js"></script>
</body>

</html>