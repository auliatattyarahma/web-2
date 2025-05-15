<?php
require_once __DIR__ . '/../models/anggota.php';
use models\Anggota;

if(!isset($_GET['id'])) {
    header("Location: list-anggota.php");
    exit;
}

$user = Anggota::find($_GET['id']);

if(!$user) {
    header("Location: list-anggota.php");
    exit;
}

Anggota::delete($user['id']);
header("Location: list-anggota.php");

?>