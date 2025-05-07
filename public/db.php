<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

class Database {
    private $conn;

    public function __construct() {
        // Wczytaj zmienne środowiskowe z pliku .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // Ścieżka do katalogu z plikiem .env
        $dotenv->load();

        // Sprawdzenie, czy zmienne środowiskowe są ustawione
        if (!isset($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'])) {
            die('Brak wymaganych zmiennych środowiskowych w pliku .env');
        }

        // Pobierz dane z .env
        $servername = $_ENV['DB_HOST'];
        $dbname     = $_ENV['DB_NAME'];
        $username   = $_ENV['DB_USER'];
        $password   = $_ENV['DB_PASSWORD'];

        try {
            // Połączenie z bazą danych
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Ustawienie strefy czasowej
            $this->conn->exec("SET time_zone = 'Europe/Warsaw'");
        } catch(PDOException $e) {
            echo json_encode(['error' => 'Błąd połączenia: ' . $e->getMessage()]);
            exit;
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>