<?php

namespace models;

require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use PDO;

class Produk
{
    private static function connect()
    {
        return Connection::make();
    }

    public static function get()
    {
        $pdo = self::connect();
        $sql = "SELECT produk.*, jenis_produk.nama AS jenis_produk_nama 
                FROM produk 
                LEFT JOIN jenis_produk ON produk.jenis_produk_id = jenis_produk.id";
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = self::connect();
        $sql = "INSERT INTO produk (kode, nama, deskripsi, harga, stok, jenis_produk_id) 
                VALUES (:kode, :nama, :deskripsi, :harga, :stok, :jenis_produk_id)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':kode', $data['kode']);
        $statement->bindParam(':nama', $data['nama']);
        $statement->bindParam(':deskripsi', $data['deskripsi']);
        $statement->bindParam(':harga', $data['harga']);
        $statement->bindParam(':stok', $data['stok']);
        $statement->bindParam(':jenis_produk_id', $data['jenis_produk_id']);
        
        return $statement->execute();
    }

    public static function find($id)
    {
        $pdo = self::connect();
        $sql = "SELECT produk.*, jenis_produk.nama AS jenis_produk_nama 
                FROM produk 
                LEFT JOIN jenis_produk ON produk.jenis_produk_id = jenis_produk.id 
                WHERE produk.id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($data)
    {
        $pdo = self::connect();
        $sql = "UPDATE produk SET 
                    kode = :kode, 
                    nama = :nama, 
                    deskripsi = :deskripsi, 
                    harga = :harga, 
                    stok = :stok, 
                    jenis_produk_id = :jenis_produk_id 
                WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $data['id']);
        $statement->bindParam(':kode', $data['kode']);
        $statement->bindParam(':nama', $data['nama']);
        $statement->bindParam(':deskripsi', $data['deskripsi']);
        $statement->bindParam(':harga', $data['harga']);
        $statement->bindParam(':stok', $data['stok']);
        $statement->bindParam(':jenis_produk_id', $data['jenis_produk_id']);
        
        return $statement->execute();
    }

    public static function delete($id)
    {
        $pdo = self::connect();
        $sql = "DELETE FROM produk WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}
