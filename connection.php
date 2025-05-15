<?php 
require_once 'config.php'; 

class Connection {
    public static function make($host, $dbname, $user, $password) {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";

        try {
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            return new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

return Connection::make($host, $db, $user, $password);
?>
