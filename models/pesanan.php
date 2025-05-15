<?php

namespace models;

require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use PDO;

class Pesanan
{
    private static function connect()
    {
        return Connection::make();
    }

    public static function get()
    {
        $pdo = self::connect();
        $sql = "
            SELECT pesanan.*, 
                   pegawai.nama AS nama_anggota
            FROM pesanan
            JOIN anggota ON pesanan.anggota_id = anggota.id
            JOIN pegawai ON anggota.pegawai_id = pegawai.id
        ";
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = self::connect();
        $sql = "INSERT INTO pesanan (tanggal, diskon, status_bayar, anggota_id) 
                VALUES (:tanggal, :diskon, :status_bayar, :anggota_id)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':tanggal', $data['tanggal']);
        $statement->bindParam(':diskon', $data['diskon']);
        $statement->bindParam(':status_bayar', $data['status_bayar']);
        $statement->bindParam(':anggota_id', $data['anggota_id']);

        return $statement->execute();
    }


    public static function find($id)
    {
        $pdo = self::connect();
        $sql = 'SELECT * FROM pesanan WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($data)
    {
        $pdo = self::connect();
        $sql = "UPDATE pesanan SET tanggal = :tanggal, diskon = :diskon, status_bayar = :status_bayar, anggota_id = :anggota_id WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':tanggal', $data['tanggal']);
        $statement->bindParam(':diskon', $data['diskon']);
        $statement->bindParam(':status_bayar', $data['status_bayar']);
        $statement->bindParam(':anggota_id', $data['anggota_id']);
        $statement->bindParam(':id', $data['id']);

        return $statement->execute();
    }

    public static function delete($id)
    {
        $pdo = self::connect();
        $sql = 'DELETE FROM pesanan WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}
