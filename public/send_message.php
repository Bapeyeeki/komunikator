<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'db.php';
    $db = new Database();
    $conn = $db->getConnection();

    $username = htmlspecialchars($_POST['username']);
    $message = htmlspecialchars($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO Messages (username, message) VALUES (:username, :message)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':message', $message);
    $stmt->execute();
}
?>