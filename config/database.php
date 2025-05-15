<?php
// Datenbank Konfiguration
define('DB_HOST', 'database-5017847541.ud-webspace.de');     // Normalerweise localhost oder 127.0.0.1
define('DB_USER', 'dbu5411772');             // Tragen Sie hier Ihren MySQL Benutzernamen ein
define('DB_PASS', 'Schirema05042025!');             // Tragen Sie hier Ihr MySQL Passwort ein
define('DB_NAME', 'dbs14227674dbs');             // Tragen Sie hier den Namen Ihrer Datenbank ein

// Verbindung zur Datenbank herstellen
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch(PDOException $e) {
    die("Verbindungsfehler: " . $e->getMessage());
}
?>