<?php
require_once __DIR__ . '/../models/pembayaran.php';

use models\Pembayaran;


$pembayaranList = Pembayaran::get();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => $_POST['id'],
        'jumlah_bayar' => $_POST['jumlah_bayar'],
        'tanggal' => $_POST['tanggal'],
        'pesanan_id' => $_POST['pesanan_id']
    ];

    Pembayaran::create($data);
    header('Location: list-pembayaran.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Create Transaksi - Koperasi Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="dashboard.php">Koperasi Pegawai</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main Menu</div>
                        <a class="nav-link" href="list-anggota.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>Manajemen Anggota
                        </a>
                        <a class="nav-link" href="list-pegawai.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>Pegawai
                        </a>
                        <a class="nav-link" href="list-produk.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-box"></i></div>Produk
                        </a>
                        <a class="nav-link" href="list-pesanan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>Pemesanan
                        </a>
                        <a class="nav-link" href="list-pembayaran.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill"></i></div>Transaksi
                        </a>
                        <a class="nav-link" href="list-kartu_diskon.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-credit-card"></i></div>Kartu Diskon
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
                    <h1 class="mt-4">Tambah Pembayaran</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-pembayaran.php">Transaksi</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-plus me-1"></i> Form Tambah Pembayaran
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Jumlah Bayar</label>
                                    <input type="date" class="form-control" id="jumlah_bayar" name="jumlah_bayar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="total_bayar" class="form-label">Tanggal</label>
                                    <input type="number" class="form-control" id="tanggal" name="tanggal" min="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="metode_bayar" class="form-label">Pesanan ID</label>
                                    <select class="form-control" id="pesanan_id" name="pesanan_id" required>
                                        <option value="Cash">Cash</option>
                                        <option value="Transfer">Transfer</option>
                                        <option value="Debit">Debit</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pesanan_id" class="form-label">Pesanan</label>
                                    <select class="form-control" id="pesanan_id" name="pesanan_id" required>
                                        <option value="">-- Pilih Pesanan --</option>
                                        <?php foreach ($pesananList as $pesanan): ?>
                                            <option value="<?= $pesanan['id'] ?>">
                                                <?= $pesanan['id'] ?> - <?= $pesanan['tanggal'] ?> (<?= $pesanan['status_bayar'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                                <a href="list-pembayaran.php" class="btn btn-secondary">Kembali</a>
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