<?php 

$pdo = require 'connection.php';
$statement = $pdo->query('SELECT * FROM pegawai');
print_r($statement->fetchAll());
?>