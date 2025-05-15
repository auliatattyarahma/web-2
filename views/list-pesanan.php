<?php
require_once __DIR__ . '/../models/pesanan.php';

use models\Pesanan;

$pesananList = Pesanan::get();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Data Pesanan - Koperasi Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <!-- Top Navigation -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="dashboard.php">Koperasi Pegawai</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
    </nav>

    <div id="layoutSidenav">
        <!-- Sidebar -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main Menu</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAnggota" aria-expanded="false" aria-controls="collapseAnggota">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
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
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div> Produk
                        </a>
                        <a class="nav-link" href="list-pesanan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div> Pesanan
                        </a>
                        <a class="nav-link" href="list-transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div> Transaksi
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Aulia Tattya Rahma
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Pesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pesanan</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Data Pesanan
                        </div>
                        <div class="card-body">
                            <div class="mb-3 text-end">
                                <a href="create-pesanan.php" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Tambah Pesanan
                                </a>
                            </div>

                            <table id="datatableSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>Diskon</th>
                                        <th>Status Bayar</th>
                                        <th>Anggota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pesananList as $pesanan): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($pesanan['id']) ?></td>
                                            <td><?= htmlspecialchars($pesanan['tanggal']) ?></td>
                                            <td><?= number_format($pesanan['diskon'], 2) ?>%</td>
                                            <td><?= $pesanan['status_bayar'] == 1 ? 'Sudah Bayar' : 'Belum Bayar' ?></td>
                                            <td><?= htmlspecialchars($pesanan['nama_anggota']) ?></td>
                                            <td>
                                                <a href="detail-pesanan.php?id=<?= urlencode($pesanan['id']) ?>" class="btn btn-primary btn-sm" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                                <a href="edit-pesanan.php?id=<?= urlencode($pesanan['id']) ?>" class="btn btn-warning btn-sm" title="Edit Pesanan">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="delete-pesanan.php?id=<?= urlencode($pesanan['id']) ?>" class="btn btn-danger btn-sm" title="Hapus Pesanan" onclick="return confirm('Yakin ingin menghapus pesanan ini?');">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; PW2 <?= date('Y') ?></div>
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