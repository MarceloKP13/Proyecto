<?php
$conexion = mysqli_connect("localhost", "root", "", "havcana_db");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
<?php
$host = 'localhost';
$dbname = 'havcana_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>