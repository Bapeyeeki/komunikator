<?php
require_once 'db.php'; // Ładujemy klasę połączenia z bazą danych

// Tworzymy instancję klasy Database
$db = new Database();
$conn = $db->getConnection();

// Pobieranie danych z formularza
$username = $_POST['username'];
$message = $_POST['message'];

// Zapytanie SQL do wstawienia wiadomości
$sql = "INSERT INTO messages (username, message) VALUES (:username, :message)";
$stmt = $conn->prepare($sql);

// Bindowanie wartości
$stmt->bindParam(':username', $username);
$stmt->bindParam(':message', $message);

// Wykonanie zapytania
if ($stmt->execute()) {
    echo "Wiadomość została wysłana!";
} else {
    echo "Wystąpił błąd podczas wysyłania wiadomości.";
}
?>