<?php
require_once 'db.php'; // Wczytanie pliku z połączeniem z bazą danych

header('Content-Type: application/json');

try {
    // Odczyt danych z formularza POST
    $sender_username = $_POST['sender_username'] ?? '';
    $recipient_username = $_POST['recipient_username'] ?? '';
    $message = $_POST['message'] ?? '';
    $created_at = $_POST['created_at'] ?? date('Y-m-d H:i:s');
    $channel = $_POST['channel'] ?? 'general';

    // Jeśli data jest w formacie ISO 8601, przekonwertuj ją
    if (strpos($created_at, 'T') !== false) {
        $dt = new DateTime($created_at);
        $created_at = $dt->format('Y-m-d H:i:s');
    }

    // Sprawdzanie, czy wymagane dane są dostępne
    if (!$sender_username || !$recipient_username || !$message) {
        http_response_code(400);
        echo json_encode(['error' => 'Brak wymaganych danych (sender_username, recipient_username lub message)']);
        exit;
    }

    // Połączenie z bazą danych
    $db = new Database();
    $conn = $db->getConnection();

    // Wstawienie wiadomości do tabeli received_messages
    $stmt = $conn->prepare("INSERT INTO received_messages (sender_username, recipient_username, message, created_at, channel) 
                        VALUES (:sender_username, :recipient_username, :message, :created_at, :channel)");
    $stmt->execute([
        ':sender_username' => $sender_username,
        ':recipient_username' => $recipient_username,
        ':message' => $message,
        ':created_at' => $created_at,
        ':channel' => $channel
    ]);

    // Zwrócenie odpowiedzi o sukcesie
    echo json_encode(['success' => true, 'message_id' => $conn->lastInsertId()]);
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