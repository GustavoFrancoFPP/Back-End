<?php
class Connection {
    private static $instance = null;
    
    public static function getInstance() {
        if (!self::$instance) {
            try {
                $host = 'localhost';
                $dbname = 'projeto_livros';
                $user = 'root';
                $pass = 'senaisp';
                
                //  Conecta sem especificar o banco para criá-lo
                $pdo = new PDO("mysql:host=$host", $user, $pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                //  CRIA O BANCO SE NÃO EXISTIR
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
                $pdo->exec("USE `$dbname`");
                
                self::$instance = $pdo;

            } catch (PDOException $e) {
                die("Erro ao conectar ao MySQL: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}