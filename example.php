<?php
// Datenbankverbindung einbinden
require_once 'config/database.php';

// Beispiel für eine SELECT-Abfrage
function getAllUsers() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM users");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        die("Fehler bei der Abfrage: " . $e->getMessage());
    }
}

// Beispiel für eine INSERT-Abfrage mit prepared statement
function addUser($username, $email, $password) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);
        return $pdo->lastInsertId();
    } catch(PDOException $e) {
        die("Fehler beim Einfügen: " . $e->getMessage());
    }
}

// Beispiel für eine UPDATE-Abfrage
function updateUser($userId, $newEmail) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
        return $stmt->execute([$newEmail, $userId]);
    } catch(PDOException $e) {
        die("Fehler beim Aktualisieren: " . $e->getMessage());
    }
}

// Beispiel für eine DELETE-Abfrage
function deleteUser($userId) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$userId]);
    } catch(PDOException $e) {
        die("Fehler beim Löschen: " . $e->getMessage());
    }
}

// Beispiel für die Verwendung:
/*
// Alle Benutzer abrufen
$users = getAllUsers();
foreach($users as $user) {
    echo $user['username'] . " - " . $user['email'] . "<br>";
}

// Neuen Benutzer hinzufügen
$newUserId = addUser("max", "max@example.com", "sicheres_passwort");

// Benutzer aktualisieren
updateUser($newUserId, "neuemail@example.com");

// Benutzer löschen
deleteUser($newUserId);
*/
?>