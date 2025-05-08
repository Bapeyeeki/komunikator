<?php
require_once 'db.php';

header('Content-Type: application/json');

try {
    $messageId = $_POST['message_id'] ?? null;
    $username = $_POST['username'] ?? '';

    if (!$messageId || !$username) {
        http_response_code(400);
        echo json_encode(['error' => 'Brak wymaganych parametrów (message_id lub username)']);
        exit;
    }

    $db = new Database();
    $conn = $db->getConnection();

    // Upewnij się, że użytkownik jest właścicielem tej wiadomości
    $stmt = $conn->prepare("UPDATE received_messages 
                          SET is_read = 1 
                          WHERE id = :message_id AND recipient_username = :username");
    
    $stmt->bindParam(':message_id', $messageId, PDO::PARAM_INT);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    // Sprawdź, czy wiadomość została zaktualizowana
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Wiadomość nie została znaleziona lub użytkownik nie ma uprawnień do jej aktualizacji']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Błąd bazy danych: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>