<?php
require_once __DIR__ . '/../models/anggota.php';
require_once __DIR__ . '/../models/pegawai.php';
require_once __DIR__ . '/../models/kartu_diskon.php';

use models\Anggota;
use models\Pegawai;
use models\KartuDiskon;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => null,
        'status_aktif' => $_POST['status_aktif'] ?? null,
        'pegawai_id' => $_POST['pegawai_id'] ?? null,
        'kartu_diskon_id' => $_POST['kartu_diskon_id'] ?? null,
    ];

    if (models\Anggota::create($data)) {
        header('Location: list-anggota.php');
        exit();
    } else {
        echo "Gagal menyimpan data anggota.";
    }
}



$pegawais = Pegawai::get();
$kartuDiskons = KartuDiskon::get();
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Manajemen Anggota</title>
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
                            <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
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
                    <h1 class="mt-4">Anggota</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-anggota.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Anggota</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Add Anggota
                        </div>
                        <div class="card-body">
                            <form action="create-anggota.php" method="POST">
                                <div class="mb-3">
                                    <label for="id" class="form-label">ID</label>
                                    <input type="text" class="form-control" id="id" name="id" disabled>

                                </div>

                                <div class="mb-3">
                                    <label for="status_aktif" class="form-label">Status Aktif</label>
                                    <select class="form-control" id="status_aktif" name="status_aktif" required>
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pegawai_id" class="form-label">Pegawai ID</label>
                                    <select class="form-control" id="pegawai_id" name="pegawai_id" required>
                                        <option value="">-- Pilih ID Pegawai --</option>
                                        <?php foreach ($pegawais as $pegawai): ?>
                                            <option value="<?= $pegawai['id'] ?>"><?= htmlspecialchars($pegawai['id']) ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="kartu_diskon_id" class="form-label">Kartu Diskon</label>
                                    <select class="form-control" id="kartu_diskon_id" name="kartu_diskon_id" required>
                                        <option value="">-- Pilih Kartu Diskon --</option>
                                        <?php foreach ($kartuDiskons as $kartu): ?>
                                            <option value="<?= $kartu['id'] ?>"><?= htmlspecialchars($kartu['id']) ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>

                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; PW2 <?= date('Y') ?></div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../public/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../public/js/datatables-simple-demo.js"></script>
</body>

</html>