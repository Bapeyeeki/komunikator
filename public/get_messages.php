<?php
require_once 'db.php';
 // Ładujemy klasę połączenia z bazą danych

// Tworzymy instancję klasy Database
$db = new Database();
$conn = $db->getConnection();

// Zapytanie SQL do pobrania wiadomości
$sql = "SELECT username, message, created_at FROM messages ORDER BY created_at ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Wyświetlanie wiadomości
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $isoTime = date('c', strtotime($row['created_at'])); // np. 2024-05-07T10:30:00+00:00
    echo "<div class='message'><span class='user'>{$row['username']}:</span> {$row['message']} <span class='time' data-time='{$isoTime}'></span></div>";
}
?>