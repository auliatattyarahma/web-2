<?php

namespace models;

require_once __DIR__ . '/../config/connection.php';

use config\Connection;
use PDO;
use PDOException;

class Pembayaran
{
    private static function connect()
    {
        return Connection::make();
    }

    public static function get($limit = 100, $offset = 0)
    {
        try {
            $pdo = self::connect();
            $sql = "
                SELECT pembayaran.*, pesanan.tanggal AS tanggal_pesanan
                FROM pembayaran
                JOIN pesanan ON pembayaran.pesanan_id = pesanan.id
                LIMIT :limit OFFSET :offset
            ";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
            $statement->execute();
            return [
                'success' => true,
                'data' => $statement->fetchAll(PDO::FETCH_ASSOC)
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error fetching data: ' . $e->getMessage()
            ];
        }
    }

    public static function create($data)
    {
        try {
            $pdo = self::connect();
            $sql = "INSERT INTO pembayaran (jumlah_bayar, tanggal, pesanan_id) 
                    VALUES (:jumlah_bayar, :tanggal, :pesanan_id)";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':jumlah_bayar', $data['jumlah_bayar']);
            $statement->bindValue(':tanggal', $data['tanggal']);
            $statement->bindValue(':pesanan_id', $data['pesanan_id']);

            $success = $statement->execute();
            return [
                'success' => $success,
                'message' => $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error inserting data: ' . $e->getMessage()
            ];
        }
    }

    public static function find($id)
    {
        try {
            $pdo = self::connect();
            $sql = 'SELECT * FROM pembayaran WHERE id = :id';
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return ['success' => true, 'data' => $result];
            } else {
                return ['success' => false, 'message' => 'Data tidak ditemukan.'];
            }
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error finding data: ' . $e->getMessage()
            ];
        }
    }

    public static function update($data)
    {
        try {
            $pdo = self::connect();
            $sql = "UPDATE pembayaran 
                    SET jumlah_bayar = :jumlah_bayar, tanggal = :tanggal, pesanan_id = :pesanan_id 
                    WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':jumlah_bayar', $data['jumlah_bayar']);
            $statement->bindValue(':tanggal', $data['tanggal']);
            $statement->bindValue(':pesanan_id', $data['pesanan_id']);
            $statement->bindValue(':id', $data['id'], PDO::PARAM_INT);

            $success = $statement->execute();
            return [
                'success' => $success,
                'message' => $success ? 'Data berhasil diperbarui.' : 'Gagal memperbarui data.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error updating data: ' . $e->getMessage()
            ];
        }
    }

    public static function delete($id)
    {
        try {
            $pdo = self::connect();
            $sql = 'DELETE FROM pembayaran WHERE id = :id';
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);

            $success = $statement->execute();
            return [
                'success' => $success,
                'message' => $success ? 'Data berhasil dihapus.' : 'Gagal menghapus data.'
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error deleting data: ' . $e->getMessage()
            ];
        }
    }
}
