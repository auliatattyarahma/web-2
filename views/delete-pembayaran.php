<?php
require_once __DIR__ . '/../models/pembayaran.php';
use models\Pembayaran;

if(!isset($_GET['id'])) {
    header("Location: list-pembayaran.php");
    exit;
}

$user = Pembayaran::find($_GET['id']);

if(!$user) {
    header("Location: list-pembayaran.php");
    exit;
}

Pembayaran::delete($user['id']);
header("Location: list-pembayaran.php");

?>