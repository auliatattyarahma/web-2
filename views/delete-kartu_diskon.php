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

KartuDiskon::delete($user['id']);
header("Location: list-kartu_dikon.php");
