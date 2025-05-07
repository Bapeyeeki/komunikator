<?php
require_once 'db.php';

$username = $_POST['username'] ?? '';
$message = $_POST['message'] ?? '';

if (!$username || !$message) {
    echo json_encode(['error' => 'Brak danych']);
    exit;
}

// Zapis do bazy danych
$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("INSERT INTO messages (username, message) VALUES (:username, :message)");
$stmt->execute([
    ':username' => $username,
    ':message' => $message
]);

// Wywołujemy pusher osobno
$data = [
    'username' => $username,
    'message' => $message,
    'created_at' => date('Y-m-d H:i:s')
];

$ch = curl_init('notify_pusher.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);
curl_close($ch);

echo json_encode(['success' => true]);