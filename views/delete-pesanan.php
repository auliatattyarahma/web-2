<?php
require_once __DIR__ . '/../models/pesanan.php';

use models\Pesanan;

if(!isset($_GET['id'])) {
    header("Location: list-pesanan.php");
    exit;
}

$user = Pesanan::find($_GET['id']);

if(!$user) {
    header("Location: list-pesanan.php");
    exit;
}

Pesanan::delete($user['id']);
header("Location: list-pesanan.php");

?>