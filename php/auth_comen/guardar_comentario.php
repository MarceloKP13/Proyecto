<?php
include 'conexion_com.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si el campo "nombre" no es enviado o está vacío, se asigna "Anónimo"
    $nombre = isset($_POST['nombre']) && !empty($_POST['nombre']) ? $_POST['nombre'] : 'Anónimo';
    $comentario = $_POST['comentario'];

    $sql = "INSERT INTO comentarios (nombre, comentario) VALUES ('$nombre', '$comentario')";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('Gracias por tu comentario, será tomado en cuenta.'); window.location.href='contactos.php';</script>";
    } else {
        echo "Error al guardar el comentario: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
