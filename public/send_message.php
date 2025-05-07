<?php
require_once 'db.php'; // połączenie z bazą

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? 'Anon');
    $message = trim($_POST['message'] ?? '');

    if ($message === '') exit;

    $db = new Database();
    $conn = $db->getConnection();

    // Zapisywanie wiadomości
    $stmt = $conn->prepare("INSERT INTO messages (username, message, created_at) VALUES (:username, :message, NOW())");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':message', $message);
    $stmt->execute();
}
?>