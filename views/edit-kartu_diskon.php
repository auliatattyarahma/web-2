<?php
require_once __DIR__ . '/../models/kartu_diskon.php';

use models\KartuDiskon;


if (!isset($_GET['id'])) {
    header("Location: list-kartu_diskon.php");
    exit;
}

$user = KartuDiskon::find($_GET['id']);

if (!$user) {
    header("Location: list-kartu_diskon.php");
    exit;
}

if (isset($_POST['submit'])) {
    $data = [
        'id' => $_GET['id'],
        'nama' => $_POST['nama'],
        'deskripsi' => $_POST['deskripsi'],
        'persen_diskon' => $_POST['persen_diskon'],
    ];

    KartuDiskon::update($data);
    header("Location: list-kartu_diskon.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Data Member</title>
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
                        <a class="nav-link" href="list-anggota.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Manajemen Anggota
                        </a>
                        <a class="nav-link" href="list-pegawai.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                            Pegawai
                        </a>
                        <a class="nav-link" href="list-produk.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-box"></i></div>
                            Produk
                        </a>
                        <a class="nav-link" href="list-pesanan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                            Pemesanan
                        </a>
                        <a class="nav-link" href="list-pembayaran.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill"></i></div>
                            Transaksi
                        </a>
                        <a class="nav-link" href="list-kartu_diskon.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-credit-card"></i></div>
                            Kartu Diskon
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
                    <h1 class="mt-4">Edit Data Member</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-kartu_diskon.php">Member</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Form Edit Data Member
                        </div>
                        <div class="card-body">
                            <form action="edit-kartu_diskon.php?id=<?= $user['id'] ?>" method="POST">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'] ?>" required>
                                </div>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $user['deskripsi'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="PersenDiskon" class="form-label">Persen Diskon</label>
                            <input type="text" class="form-control" id="PersenDiskon" name="PersenDiskon" value="<?= $user['PersenDiskon'] ?>" required>
                        </div>
                        <a href="list-kartu_diskon.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button type="submit" class="btn btn-warning" name="submit"><i class="fas fa-save"></i> Update</button>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2