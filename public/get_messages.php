<?php
require 'db.php';
$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("SELECT username, message, timestamp FROM Messages ORDER BY timestamp ASC");
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($messages as $msg) {
    echo "<div class='message'><span class='user'>" . 
         htmlspecialchars($msg['username']) . 
         ":</span> " . htmlspecialchars($msg['message']) . "</div>";
}
?>