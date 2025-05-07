<?php
require_once 'db.php';

try {
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->query("SELECT username, message, created_at FROM messages ORDER BY created_at ASC");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as $msg) {
        // Formatowanie daty (nie zmieniamy strefy czasowej, bo czas jest lokalny)
        $datetime = new DateTime($msg['created_at']); // Czas już jest w lokalnej strefie użytkownika
        $local_time = $datetime->format('H:i'); // Formatowanie godziny i minut

        $user = htmlspecialchars($msg['username']);
        $text = htmlspecialchars($msg['message']);  // Zapewniamy bezpieczeństwo przed HTML w wiadomości

        echo "<div class='message'>";
        echo "<span class='user'>{$user}:</span> {$text} <span class='time'>{$local_time}</span>";
        echo "</div>";
    }
} catch (PDOException $e) {
    echo "<div class='error'>Błąd bazy danych: " . $e->getMessage() . "</div>";
}
?>