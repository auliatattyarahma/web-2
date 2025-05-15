<?php
require_once __DIR__ . '/../models/pesanan.php';

use models\Pesanan;

// Ambil ID dari URL
$id = $_GET['id'] ?? null;

// Redirect jika tidak ada ID
if (!$id) {
    header('Location: list-pesanan.php');
    exit;
}

$pesanan = Pesanan::find($id);
if (!$pesanan) {
    header('Location: list-pesanan.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Detail Pemesanan - Koperasi Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="dashboard.php">Koperasi Pegawai</a>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <!-- Sidebar menu (disamakan dengan halaman lain) -->
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main Menu</div>
                        <a class="nav-link" href="list-anggota.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>Anggota
                        </a>
                        <a class="nav-link" href="list-produk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>Produk
                        </a>
                        <a class="nav-link" href="list-pesanan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div>Pemesanan
                        </a>
                        <a class="nav-link" href="list-pembayaran.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>Transaksi
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
                    <h1 class="mt-4">Detail Pemesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-pesanan.php">Pemesanan</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-info-circle me-1"></i> Informasi Pemesanan
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <td><?= htmlspecialchars($pesanan['id']) ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td><?= htmlspecialchars($pesanan['tanggal']) ?></td>
                                </tr>
                                <tr>
                                    <th>Diskon</th>
                                    <td><?= htmlspecialchars($pesanan['diskon']) ?>%</td>
                                </tr>
                                <tr>
                                    <th>Status Bayar</th>
                                    <td><?= $pesanan['status_bayar'] == 1 ? 'Sudah Bayar' : 'Belum Bayar' ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Anggota</th>
                                    <td><?= htmlspecialchars($pesanan['nama_anggota']) ?></td>
                                </tr>

                            </table>
                            <a href="list-pesanan.php" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; PW2 <?= date('Y') ?></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../public/js/scripts.js"></script>
</body>

</html>