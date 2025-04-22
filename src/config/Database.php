<?php
namespace Src\Config;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database {
    private static $pdo = null;

    public static function getConnection() {
        if (self::$pdo === null) {
            $dotenv = Dotenv::createImmutable(__DIR__. "/../../");
            $dotenv->load();

            $host = 'localhost';
            $dbname = $_ENV["MYSQL_DB"];
            $username = $_ENV["MYSQL_USERNAME"];
            $password = $_ENV["MYSQL_PASSWORD"];

            if (!$dbname || !$username || !$password) {
                die("Erro: As variáveis de ambiente do banco de dados não estão configuradas corretamente.");
            }

            try {
                self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  // Garantir fetch associativo
            } catch (PDOException $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        
        return self::$pdo;
    }
}
