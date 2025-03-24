<?php
$host = 'sql108.epizy.com';
$dbname = 'if0_38584302_havcana_db';
$username = 'if0_38584302';
$password = 'u5x0DWHfc6l';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
