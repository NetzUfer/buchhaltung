<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';

echo "<h2>Datenbank-Setup</h2>";

try {
    // SQL-Datei einlesen
    $sql = file_get_contents('database_setup.sql');
    
    // SQL-Befehle aufteilen und ausführen
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            $pdo->exec($statement);
            echo "<p style='color: green;'>✓ SQL-Befehl erfolgreich ausgeführt:</p>";
            echo "<pre style='background-color: #e8f5e9; padding: 10px; border-radius: 5px;'>";
            echo htmlspecialchars(substr($statement, 0, 100)) . "...";
            echo "</pre>";
        }
    }
    
    // Überprüfen der eingefügten Daten
    echo "<h3>Überprüfung der Daten:</h3>";
    
    $tables = ['users', 'products', 'categories', 'orders', 'order_items', 'product_categories'];
    
    foreach ($tables as $table) {
        $count = $pdo->query("SELECT COUNT(*) as count FROM $table")->fetch()['count'];
        echo "<p>Tabelle '$table': $count Einträge</p>";
    }
    
    echo "<p style='color: green; font-weight: bold;'>✓ Datenbank-Setup erfolgreich abgeschlossen!</p>";
    
} catch(PDOException $e) {
    echo "<p style='color: red;'>✗ Fehler beim Setup der Datenbank:</p>";
    echo "<pre style='background-color: #ffebee; padding: 10px; border-radius: 5px;'>";
    echo htmlspecialchars($e->getMessage());
    echo "</pre>";
}
?>