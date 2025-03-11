<?php
$conexion = mysqli_connect("localhost", "root", "", "login_register_db");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>