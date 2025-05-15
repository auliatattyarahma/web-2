<?php

namespace models;

require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use PDO;

class DetailPesanan
{
    private static function connect()
    {
        return Connection::make();
    }

    public static function get()
    {
        $pdo = self::connect();
        $sql = "
            SELECT detail_pesanan.*, produk.nama AS nama_produk, pesanan.tanggal AS tanggal_pesanan
            FROM detail_pesanan
            JOIN produk ON detail_pesanan.produk_id = produk.id
            JOIN pesanan ON detail_pesanan.pesanan_id = pesanan.id
        ";
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = self::connect();
        $sql = "INSERT INTO detail_pesanan (pesanan_id, produk_id, jumlah)
                VALUES (:pesanan_id, :produk_id, :jumlah)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':pesanan_id', $data['pesanan_id']);
        $statement->bindParam(':produk_id', $data['produk_id']);
        $statement->bindParam(':jumlah', $data['jumlah']);

        return $statement->execute();
    }

    public static function find($id)
    {
        $pdo = self::connect();
        $sql = "SELECT * FROM detail_pesanan WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($data)
    {
        $pdo = self::connect();
        $sql = "UPDATE detail_pesanan
                SET pesanan_id = :pesanan_id, produk_id = :produk_id, jumlah = :jumlah
                WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':pesanan_id', $data['pesanan_id']);
        $statement->bindParam(':produk_id', $data['produk_id']);
        $statement->bindParam(':jumlah', $data['jumlah']);
        $statement->bindParam(':id', $data['id']);

        return $statement->execute();
    }

    public static function delete($id)
    {
        $pdo = self::connect();
        $sql = "DELETE FROM detail_pesanan WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}
