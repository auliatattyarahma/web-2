<?php
require_once __DIR__ . '/../models/pesanan.php';
require_once __DIR__ . '/../models/anggota.php';

use models\Pesanan;
use models\Anggota;

if (!isset($_GET['id'])) {
    header("Location: list-pesanan.php");
    exit;
}

$pesanan = Pesanan::find($_GET['id']);

if (!$pesanan) {
    header("Location: list-pesanan.php");
    exit;
}

$anggotaList = Anggota::get();

if (isset($_POST['submit'])) {
    $data = [
        'id' => $_GET['id'],
        'tanggal' => $_POST['tanggal'],
        'diskon' => $_POST['diskon'],
        'status_bayar' => $_POST['status_bayar'],
        'anggota_id' => $_POST['anggota_id'],
    ];

    Pesanan::update($data);
    header("Location: list-pesanan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Pemesanan - Manajemen Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
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
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Manajemen Anggota
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseAnggota" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="list-anggota.php">Data Anggota</a>
                                <a class="nav-link" href="list-pegawai.php">Data Pegawai</a>
                                <a class="nav-link" href="list-kartuDiskon.php">Kartu Diskon</a>
                            </nav>
                        </div>

                        <a class="nav-link" href="list-produk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Produk
                        </a>
                        <a class="nav-link" href="list-pesanan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div>
                            Pemesanan
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
                    <h1 class="mt-4">Edit Pemesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-pesanan.php">Pemesanan</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-edit me-1"></i> Form Edit Pemesanan
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required
                                        value="<?= htmlspecialchars($pesanan['tanggal']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="diskon" class="form-label">Diskon (%)</label>
                                    <input type="number" class="form-control" id="diskon" name="diskon" min="0" required
                                        value="<?= htmlspecialchars($pesanan['diskon']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="status_bayar" class="form-label">Status Bayar</label>
                                    <select class="form-control" id="status_bayar" name="status_bayar" required>
                                        <option value="Belum Bayar" <?= $pesanan['status_bayar'] == 'Belum Bayar' ? 'selected' : '' ?>>Belum Bayar</option>
                                        <option value="Sudah Bayar" <?= $pesanan['status_bayar'] == 'Sudah Bayar' ? 'selected' : '' ?>>Sudah Bayar</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="anggota_id" class="form-label">Anggota</label>
                                    <select class="form-control" id="anggota_id" name="anggota_id" required>
                                        <option value="">-- Pilih Anggota --</option>
                                        <?php foreach ($anggotaList as $anggota): ?>
                                            <option value="<?= $anggota['id'] ?>" <?= $pesanan['anggota_id'] == $anggota['id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($anggota['id'] . ' - ' . ($anggota['nama'] ?? '')) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                                <a href="list-pesanan.php" class="btn btn-secondary">Batal</a>
                            </form>
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