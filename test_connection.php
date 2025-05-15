<?php
// Fehlerausgabe aktivieren
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Datenbank-Verbindungstest</h2>";

try {
    // Datenbankverbindung einbinden
    require_once 'config/database.php';
    
    // Wenn wir bis hierher kommen, war die Verbindung erfolgreich
    echo "<p style='color: green;'>✓ Verbindung zur Datenbank erfolgreich hergestellt!</p>";
    
    // Serverinformationen ausgeben
    echo "<h3>Datenbank-Informationen:</h3>";
    echo "<ul>";
    echo "<li>Server-Version: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "</li>";
    echo "<li>Verbindungsstatus: " . $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "</li>";
    echo "<li>Server-Info: " . $pdo->getAttribute(PDO::ATTR_SERVER_INFO) . "</li>";
    echo "</ul>";
    
    // Verfügbare Datenbanken anzeigen
    $stmt = $pdo->query("SHOW DATABASES");
    echo "<h3>Verfügbare Datenbanken:</h3>";
    echo "<ul>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>" . htmlspecialchars($row['Database']) . "</li>";
    }
    echo "</ul>";
    
    // Wenn eine Datenbank ausgewählt wurde, zeige die Tabellen an
    if (DB_NAME != '') {
        $stmt = $pdo->query("SHOW TABLES");
        echo "<h3>Tabellen in der Datenbank '" . htmlspecialchars(DB_NAME) . "':</h3>";
        echo "<ul>";
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo "<li>" . htmlspecialchars($row[0]) . "</li>";
        }
        echo "</ul>";
    }
    
} catch(PDOException $e) {
    echo "<p style='color: red;'>✗ Fehler bei der Datenbankverbindung:</p>";
    echo "<pre style='background-color: #ffebee; padding: 10px; border-radius: 5px;'>";
    echo htmlspecialchars($e->getMessage());
    echo "</pre>";
    
    echo "<h3>Mögliche Lösungen:</h3>";
    echo "<ul>";
    echo "<li>Überprüfen Sie, ob der MySQL-Server läuft</li>";
    echo "<li>Kontrollieren Sie die Zugangsdaten in config/database.php</li>";
    echo "<li>Stellen Sie sicher, dass der Benutzer die notwendigen Rechte hat</li>";
    echo "<li>Prüfen Sie, ob die angegebene Datenbank existiert</li>";
    echo "</ul>";
}
?>