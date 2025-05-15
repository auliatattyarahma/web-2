<?php
namespace models;

require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use PDO;

class Anggota
{
    private static function connect()
    {
        return Connection::make(); 
    }

    public static function get()
    {
        $pdo = self::connect();
        $sql = "
            SELECT a.*, 
                   p.nama AS nama_pegawai, 
                   k.nama AS nama_diskon
            FROM anggota a
            JOIN pegawai p ON a.pegawai_id = p.id
            JOIN kartu_diskon k ON a.kartu_diskon_id = k.id
        ";
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = self::connect();
        $sql = "INSERT INTO anggota (id, status_aktif, pegawai_id, kartu_diskon_id) 
                VALUES (:id, :status_aktif, :pegawai_id, :kartu_diskon_id)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $data['id']);
        $statement->bindParam(':status_aktif', $data['status_aktif']);
        $statement->bindParam(':pegawai_id', $data['pegawai_id']);
        $statement->bindParam(':kartu_diskon_id', $data['kartu_diskon_id']);

        return $statement->execute();
    }

    public static function find($id)
    {
        $pdo = self::connect();
        $sql = 'SELECT * FROM anggota WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($data)
    {
        $pdo = self::connect();
        $sql = "UPDATE anggota 
                SET status_aktif = :status_aktif, 
                    pegawai_id = :pegawai_id, 
                    kartu_diskon_id = :kartu_diskon_id 
                WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $data['id']);
        $statement->bindParam(':status_aktif', $data['status_aktif']);
        $statement->bindParam(':pegawai_id', $data['pegawai_id']);
        $statement->bindParam(':kartu_diskon_id', $data['kartu_diskon_id']);

        return $statement->execute();
    }

    public static function delete($id)
    {
        $pdo = self::connect();
        $sql = 'DELETE FROM anggota WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}