<?php
require_once 'db.php';

try {
    $db = new Database();
    $conn = $db->getConnection();

    $channel = $_GET['channel'] ?? 'general';
    $currentUser = $_GET['user'] ?? ''; // Pobieramy nazwę aktualnego użytkownika

    $stmt = $conn->prepare("SELECT username, message, created_at FROM messages WHERE channel = :channel ORDER BY created_at ASC");
    $stmt->execute(['channel' => $channel]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as $msg) {
        $datetime = new DateTime($msg['created_at']);
        $local_time = $datetime->format('H:i');  // Formatowanie godziny

        $user = htmlspecialchars($msg['username']);
        $text = $msg['message']; // Treść nie HTML-escaped, bo może zawierać np. emoji i formatowanie

        // Sprawdzenie, czy wiadomość należy do aktualnego użytkownika
        $class = ($msg['username'] === $currentUser) ? 'sent' : 'received';

        echo "<div class='message {$class}'>";
        echo "<span class='user'>{$user}:</span> {$text} <span class='time'>{$local_time}</span>";
        echo "</div>";
    }
} catch (PDOException $e) {
    echo "<div class='error'>Błąd bazy danych: " . $e->getMessage() . "</div>";
}
?>
