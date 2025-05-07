<?php
require_once 'db.php'; // połączenie z bazą

$db = new Database();
$conn = $db->getConnection();

// Pobieramy wszystkie wiadomości z bazy
$stmt = $conn->query("SELECT username, message, created_at FROM messages ORDER BY created_at ASC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Wyświetlanie wiadomości
foreach ($messages as $msg) {
    echo '<div class="message">';
    echo '<span class="user">' . htmlspecialchars($msg['username']) . ':</span> ';
    echo nl2br(htmlspecialchars($msg['message']));
    echo '</div>';
}
?>