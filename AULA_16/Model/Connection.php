<?php

class Connection {
    private static $instance = null;
    public static function getInstance() {
        if (!self::$instance) {
            try {
                $host = 'localhost';
                $dbname = 'projeto_bebidas';
                $user = 'root';
                $pass = 'senaisp';

                self::$instance = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8",
                    $user,
                    $pass
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->exec("USE $dbname");
            } catch (PDOException $e) {
                die("Erro ao conectar ao MySQL: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}