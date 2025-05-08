<?php
require_once 'db.php';

header('Content-Type: application/json');

try {
    $db = new Database();
    $conn = $db->getConnection();

    $username = $_GET['username'] ?? '';
    $channel = $_GET['channel'] ?? 'general';
    $limit = (int)($_GET['limit'] ?? 50);
    $offset = (int)($_GET['offset'] ?? 0);
    
    if (!$username) {
        http_response_code(400);
        echo json_encode(['error' => 'Brak nazwy użytkownika']);
        exit;
    }

    // Pobierz wiadomości odebrane przez określonego użytkownika
    $stmt = $conn->prepare("SELECT id, sender_username, message, created_at, channel, is_read 
                          FROM received_messages 
                          WHERE recipient_username = :username AND channel = :channel
                          ORDER BY created_at DESC 
                          LIMIT :limit OFFSET :offset");

    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':channel', $channel, PDO::PARAM_STR);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Zwróć wiadomości w formacie JSON
    echo json_encode([
        'success' => true,
        'messages' => $messages
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Błąd bazy danych: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>