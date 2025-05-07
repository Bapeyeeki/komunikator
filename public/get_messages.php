<?php
require_once 'db.php'; // Ładujemy klasę połączenia z bazą danych

// Tworzymy instancję klasy Database
$db = new Database();
$conn = $db->getConnection();

// Zapytanie SQL do pobrania wiadomości
$sql = "SELECT username, message, created_at FROM messages ORDER BY created_at ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Wyświetlanie wiadomości
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='message'>";
    echo "<span class='user'>" . htmlspecialchars($row['username']) . ":</span> ";
    echo htmlspecialchars($row['message']);
    echo " <span class='timestamp'>[" . $row['created_at'] . "]</span>";
    echo "</div>";
}
?>