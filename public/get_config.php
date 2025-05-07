<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$config = [
    'PUSHER_APP_KEY' => $_ENV['PUSHER_APP_KEY'],
    'PUSHER_APP_SECRET' => $_ENV['PUSHER_APP_SECRET'],
    'PUSHER_APP_ID' => $_ENV['PUSHER_APP_ID'],
    'PUSHER_APP_CLUSTER' => $_ENV['PUSHER_APP_CLUSTER'],
];

echo json_encode($config);