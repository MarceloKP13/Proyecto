<?php
$conexion = mysqli_connect("localhost", "root", "", "havcana_bd");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>