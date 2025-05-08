<?php
require_once 'db.php';

try {
    $db = new Database();
    $conn = $db->getConnection();

    $channel = $_GET['channel'] ?? 'general';
    $currentUser = $_GET['user'] ?? ''; // Pobieramy nazwę aktualnego użytkownika

    // Najpierw pobieramy regularne wiadomości z tabeli messages
    $stmt = $conn->prepare("SELECT username AS sender_username, message, created_at FROM messages 
                            WHERE channel = :channel");
    $stmt->execute(['channel' => $channel]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Pobieramy wiadomości odebrane dla bieżącego użytkownika
    if ($currentUser) {
        $stmt = $conn->prepare("SELECT sender_username, message, created_at FROM received_messages 
                                WHERE recipient_username = :username AND channel = :channel");
        $stmt->execute([
            'username' => $currentUser,
            'channel' => $channel
        ]);
        $receivedMessages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Łączymy obie tablice
        $messages = array_merge($messages, $receivedMessages);
        
        // Sortujemy wiadomości według czasu utworzenia
        usort($messages, function($a, $b) {
            return strtotime($a['created_at']) - strtotime($b['created_at']);
        });
    }

    foreach ($messages as $msg) {
        $datetime = new DateTime($msg['created_at']);
        $local_time = $datetime->format('H:i');  // Formatowanie godziny

        $user = htmlspecialchars($msg['sender_username']);
        $text = $msg['message']; // Treść nie HTML-escaped, bo może zawierać np. emoji i formatowanie

        // Sprawdzenie, czy wiadomość należy do aktualnego użytkownika
        $class = ($msg['sender_username'] === $currentUser) ? 'sent' : 'received';

        echo "<div class='message {$class}'>";
        echo "<span class='user'>{$user}:</span> {$text} <span class='time'>{$local_time}</span>";
        echo "</div>";
    }
} catch (PDOException $e) {
    echo "<div class='error'>Błąd bazy danych: " . $e->getMessage() . "</div>";
}
?>