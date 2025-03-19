<?php
session_start();
include '../auth/conexion_be.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    echo '<script>
        alert("Debe iniciar sesión para generar un pedido");
        window.location = "../auth/login_registro_global.php";
    </script>';
    exit;
}

// Verificar si hay productos en el carrito
if (empty($_SESSION['carrito'])) {
    echo '<script>
        alert("No hay productos en el carrito");
        window.location = "../carrito.php";
    </script>';
    exit;
}

// Obtener información del usuario
$usuario = $_SESSION['usuario'];
$query_usuario = "SELECT id, nombre_completo, correo FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($query_usuario);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if (!$resultado || $resultado->num_rows === 0) {
    echo '<script>
        alert("Error al obtener datos del usuario");
        window.location = "../carrito.php";
    </script>';
    exit;
}

$usuario_data = $resultado->fetch_assoc();

// Generar número de pedido
$fecha = date('dmY');
$query_ultimo_id = "SELECT MAX(id) as ultimo_id FROM pedidos";
$resultado_id = mysqli_query($conexion, $query_ultimo_id);
$ultimo_id = mysqli_fetch_assoc($resultado_id)['ultimo_id'];
$siguiente_id = str_pad(($ultimo_id + 1), 3, '0', STR_PAD_LEFT);
$numero_pedido = "#" . $fecha . $siguiente_id;

// Calcular totales
$subtotal = 0;
$envio = 5.00;

foreach ($_SESSION['carrito'] as $item) {
    $precio_unitario = $item['cantidad'] >= 12 ? 
        (strpos($item['nombre'], 'Manzana') !== false ? 3.85 : 7.75) : 
        (strpos($item['nombre'], 'Manzana') !== false ? 4.99 : 9.99);
    $subtotal += $precio_unitario * $item['cantidad'];
}

$total = $subtotal + $envio;

// Insertar pedido
$query_pedido = "INSERT INTO pedidos (numero_pedido, usuario_id, subtotal, envio, total) VALUES (?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($query_pedido);
$stmt->bind_param("siddd", $numero_pedido, $usuario_data['id'], $subtotal, $envio, $total);

if (!$stmt->execute()) {
    echo '<script>
        alert("Error al generar el pedido");
        window.location = "../carrito.php";
    </script>';
    exit;
}

$pedido_id = $conexion->insert_id;

// Insertar detalles del pedido
foreach ($_SESSION['carrito'] as $item) {
    $precio_unitario = $item['cantidad'] >= 12 ? 
        (strpos($item['nombre'], 'Manzana') !== false ? 3.85 : 7.75) : 
        (strpos($item['nombre'], 'Manzana') !== false ? 4.99 : 9.99);
    $subtotal_item = $precio_unitario * $item['cantidad'];
    
    $query_detalle = "INSERT INTO detalles_pedido (pedido_id, producto_id, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query_detalle);
    $stmt->bind_param("iiidd", $pedido_id, $item['id'], $item['cantidad'], $precio_unitario, $subtotal_item);
    $stmt->execute();
}

// Limpiar carrito
unset($_SESSION['carrito']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Generado - HAVCANA</title>
    <link rel="stylesheet" href="../../anexos/css/header.css">
    <link rel="stylesheet" href="../../anexos/css/pedido.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo-container">
                <img src="../../anexos/imagenes/havcanalogo.png" alt="HAVCANA Logo">
                <a href="../info.php" class="brand-name">HAVCANA</a>
            </div>
            <button class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav>
                <ul class="nav-menu">
                    <li><a href="../../index.php">Inicio</a></li>
                    <li><a href="../catalogo.php">Catálogo</a></li>
                    <li><a href="../carrito.php">Carrito</a></li>
                    <li><a href="../info.php">Sobre Nosotros</a></li>
                    <li><a href="../contactos.php">Contacto</a></li>
                    <?php if(isset($_SESSION['usuario'])): ?>
                        <li class="user-info">
                            <span>Hola, <?php echo $_SESSION['usuario']; ?></span>
                            <a href="../auth/salir.php">|  |   Cerrar Sesión</a>
                        </li>
                    <?php else: ?>
                        <li><a href="../auth/login_registro_global.php">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <div class="pedido-container">
        <div class="pedido-header">
            <img src="../../anexos/imagenes/havcanalogo.png" alt="HAVCANA Logo" class="logo">
            <h1>Pedido Generado</h1>
        </div>
        <div class="pedido-info">
            <p><strong>Número de Pedido:</strong> <?php echo $numero_pedido; ?></p>
            <p><strong>Cliente:</strong> <?php echo $usuario_data['nombre_completo']; ?></p>
            <p><strong>Correo:</strong> <?php echo $usuario_data['correo']; ?></p>
            <p><strong>Fecha:</strong> <?php echo date('d/m/Y'); ?></p>
        </div>
        <div class="pedido-total">
            <p><strong>Subtotal:</strong> $<?php echo number_format($subtotal, 2); ?></p>
            <p><strong>Envío:</strong> $<?php echo number_format($envio, 2); ?></p>
            <p class="total"><strong>Total:</strong> $<?php echo number_format($total, 2); ?></p>
        </div>
        <div class="pedido-footer">
            <p>Para finalizar su compra, por favor contáctenos por WhatsApp:</p>
            <a href="https://wa.me/593968403024" class="whatsapp-button">
                <i class="fab fa-whatsapp"></i>
                Contactar por WhatsApp
            </a>
            <a href="../catalogo.php" class="return-button">Volver al Catálogo</a>
        </div>
    </div>
    <script src="../../anexos/js/menu.js"></script>
</body>
</html>
