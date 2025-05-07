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
    'd48989b62b3e217f5781',
    '41eeb8c31088c1c65a25"',
    '1987996',
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