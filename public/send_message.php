<?php
require_once 'db.php'; // Wczytanie pliku z połączeniem z bazą danych
require __DIR__ . '/../vendor/autoload.php'; // Pusher autoloader

use Dotenv\Dotenv;
use Pusher\Pusher;

try {
    // Wczytanie zmiennych środowiskowych z pliku .env
    $dotenv = Dotenv::createImmutable(__DIR__ . '/..'); // Ścieżka do katalogu z plikiem .env
    $dotenv->load();

    // Odczyt danych z formularza POST
    $username = $_POST['username'] ?? '';
    $message = $_POST['message'] ?? '';
    $created_at = $_POST['created_at'] ?? date('Y-m-d H:i:s');
    $channel = $_POST['channel'] ?? 'general';

    // Jeśli data jest w formacie ISO 8601, przekonwertuj ją
    if (strpos($created_at, 'T') !== false) {
        $dt = new DateTime($created_at);
        $created_at = $dt->format('Y-m-d H:i:s');
    }

    // Sprawdzanie, czy wymagane dane są dostępne
    if (!$username || !$message) {
        http_response_code(400);
        echo json_encode(['error' => 'Brak wymaganych danych (username lub message)']);
        exit;
    }

    // Sprawdzanie czy wszystkie wymagane zmienne środowiskowe są dostępne
    if (!isset($_ENV['PUSHER_APP_KEY']) || !isset($_ENV['PUSHER_APP_SECRET']) || 
        !isset($_ENV['PUSHER_APP_ID']) || !isset($_ENV['PUSHER_APP_CLUSTER'])) {
        throw new Exception('Brak wymaganych zmiennych środowiskowych dla Pushera');
    }

    // Konfiguracja Pusher z zmiennymi środowiskowymi
    $pusher = new Pusher(
        $_ENV['PUSHER_APP_KEY'],       // Klucz aplikacji Pusher
        $_ENV['PUSHER_APP_SECRET'],    // Sekret aplikacji Pusher
        $_ENV['PUSHER_APP_ID'],        // ID aplikacji Pusher
        [
            'cluster' => $_ENV['PUSHER_APP_CLUSTER'], // Cluster Pusher
            'useTLS' => true
        ]
    );

    // Wysłanie wiadomości do Pushera
    $result = $pusher->trigger('chat', 'new-message', [
        'username' => $username,
        'message' => $message,
        'created_at' => $created_at
    ]);

    if (!$result) {
        throw new Exception('Błąd przy wysyłaniu wiadomości przez Pusher');
    }

    // Połączenie z bazą danych
    $db = new Database();
    $conn = $db->getConnection();

    // Wstawienie wiadomości do bazy danych
    $stmt = $conn->prepare("INSERT INTO messages (username, message, created_at, channel) 
                        VALUES (:username, :message, :created_at, :channel)");
    $stmt->execute([
        ':username' => $username,
        ':message' => $message,
        ':created_at' => $created_at,
        ':channel' => $channel
    ]);


    // Zwrócenie odpowiedzi o sukcesie
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    // Obsługa błędu bazy danych
    http_response_code(500);
    echo json_encode(['error' => 'Błąd bazy danych: ' . $e->getMessage()]);
} catch (Exception $e) {
    // Obsługa innych błędów
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>