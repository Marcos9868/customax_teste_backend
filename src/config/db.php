<?php
namespace Src\Config;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database {
    private static $pdo = null;

    public static function getConnection() {
        if (self::$pdo === null) {
            $dotenv = Dotenv::createImmutable(__DIR__, "/../");
            $dotenv->load();

            $host = 'localhost';
            $dbname = getenv("MYSQL_DB");
            $username = getenv("MYSQL_USERNAME");
            $password = getenv("MYSQL_PASSWORD");

            try {
                // Criar a instância PDO
                self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  // Garantir fetch associativo
            } catch (PDOException $e) {
                // Em caso de erro, exibe a mensagem
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        
        return self::$pdo;
    }
}
?>
