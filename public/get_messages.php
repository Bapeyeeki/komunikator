<?php
require_once 'db.php';

try {
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->query("SELECT username, message, created_at FROM messages ORDER BY created_at ASC");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as $msg) {
        $datetime = new DateTime($msg['created_at']);
        $local_time = $datetime->format('H:i');  // Formatowanie godziny

        $user = htmlspecialchars($msg['username']);
        $text = $msg['message'];

        echo "<div class='message'>";
        echo "<span class='user'>{$user}:</span> {$text} <span class='time'>{$local_time}</span>";
        echo "</div>";
    }
} catch (PDOException $e) {
    echo "<div class='error'>Błąd bazy danych: " . $e->getMessage() . "</div>";
}


?>