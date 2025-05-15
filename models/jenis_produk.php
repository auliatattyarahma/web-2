<?php

namespace models;

require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use PDO;

class JenisProduk
{
    
    private static function connect()
    {
        return Connection::make();
    }

   
    public static function get()
    {
        $pdo = self::connect();
        $sql = "SELECT * FROM jenis_produk";
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public static function create($data)
    {
        $pdo = self::connect();
        $sql = "INSERT INTO jenis_produk (nama, deskripsi) VALUES (:nama, :deskripsi)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':nama', $data['nama']);
        $statement->bindParam(':deskripsi', $data['deskripsi']);
        
        return $statement->execute();
    }

   
    public static function find($id)
    {
        $pdo = self::connect();
        $sql = "SELECT * FROM jenis_produk WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

   
    public static function update($data)
    {
        $pdo = self::connect();
        $sql = "UPDATE jenis_produk SET nama = :nama, deskripsi = :deskripsi WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $data['id']);
        $statement->bindParam(':nama', $data['nama']);
        $statement->bindParam(':deskripsi', $data['deskripsi']);
        
        return $statement->execute();
    }

   
    public static function delete($id)
    {
        $pdo = self::connect();
        $sql = "DELETE FROM jenis_produk WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}
