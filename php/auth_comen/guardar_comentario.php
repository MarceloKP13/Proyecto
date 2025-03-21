<?php
include 'conexion_com.php';

// Suponemos que el usuario está autenticado y el id del usuario está almacenado en la sesión
session_start();

// Verifica si el usuario está logueado (deberás agregar tu propio sistema de autenticación)
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si el campo "comentario" no es enviado o está vacío, mostramos un mensaje de error
    if (empty($_POST['comentario'])) {
        echo "<script>alert('El comentario no puede estar vacío.'); window.location.href='contactos.php';</script>";
        exit;
    }

    // Si el usuario no está logueado, asignamos null al usuario_id
    if (!$usuario_id) {
        echo "<script>alert('Debes iniciar sesión para comentar.'); window.location.href='../auth/login_registro_global.php';</script>";
        exit;
    }

    // Recibir el comentario
    $comentario = mysqli_real_escape_string($conexion, $_POST['comentario']);

    // Consulta para insertar el comentario en la base de datos
    $sql = "INSERT INTO comentarios (usuario_id, comentario) VALUES ('$usuario_id', '$comentario')";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('Gracias por tu comentario, será tomado en cuenta.'); window.location.href='../contactos.php';</script>";
    } else {
        echo "Error al guardar el comentario: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
<?php
require_once 'conexion_com.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = !empty($_POST['nombre_comentario']) ? $_POST['nombre_comentario'] : 'Anónimo';
    $tipo = $_POST['tipo_comentario'];
    $comentario = $_POST['comentario'];

    try {
        $stmt = $pdo->prepare("INSERT INTO comentarios (nombre, tipo_comentario, comentario) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $tipo, $comentario]);
        
        header('Location: ../contactos.php?comentario_enviado=true');
        exit();
    } catch(PDOException $e) {
        die("Error al guardar el comentario: " . $e->getMessage());
    }
}
?>