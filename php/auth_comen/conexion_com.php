<?php
$conexion = mysqli_connect("localhost", "root", "", "comentarios_bd");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>