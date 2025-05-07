<?php
require_once 'db.php';

try {
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->query("SELECT username, message, created_at FROM messages ORDER BY created_at ASC");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as $msg) {
        $time = date('H:i', strtotime($msg['created_at']));
        $user = htmlspecialchars($msg['username']);
        $text = $msg['message'];  // Zakładając, że wiadomości mogą zawierać HTML

        echo "<div class='message'>";
        echo "<span class='user'>{$user}:</span> {$text} <span class='time'>{$time}</span>";
        echo "</div>";
    }
} catch (PDOException $e) {
    echo "<div class='error'>Błąd bazy danych: " . $e->getMessage() . "</div>";
}