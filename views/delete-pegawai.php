<?php
require_once __DIR__ . '/../models/pegawai.php';
use models\Pegawai;

if(!isset($_GET['id'])) {
    header("Location: list-pegawai.php");
    exit;
}

$user = pegawai::find($_GET['id']);

if(!$user) {
    header("Location: list-pegawai.php");
    exit;
}

pegawai::delete($user['id']);
header("Location: list-pegawai.php");

?>