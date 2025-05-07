<?php
require __DIR__ . '/vendor/autoload.php'; // Pusher autoloader
use Pusher\Pusher;

$username = $_POST['username'] ?? '';
$message = $_POST['message'] ?? '';
$created_at = $_POST['created_at'] ?? date('Y-m-d H:i:s');

if (!$username || !$message) {
    http_response_code(400);
    echo json_encode(['error' => 'Brak danych']);
    exit;
}

$pusher = new Pusher(
    'YOUR_APP_KEY',
    'YOUR_APP_SECRET',
    'YOUR_APP_ID',
    [
        'cluster' => 'eu',
        'useTLS' => true
    ]
);

$pusher->trigger('chat', 'new-message', [
    'username' => $username,
    'message' => $message,
    'created_at' => $created_at
]);

echo json_encode(['success' => true]);