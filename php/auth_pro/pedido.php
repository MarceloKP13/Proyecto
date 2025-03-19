<?php
session_start();
include '../auth/conexion_be.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login_registro_global.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Obtener información del usuario
$query_usuario = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($query_usuario);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();

// Obtener todos los pedidos del usuario
$query_pedidos = "SELECT * FROM pedidos WHERE usuario_id = ? ORDER BY fecha_pedido DESC";
$stmt = $conexion->prepare($query_pedidos);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$pedidos = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAVCANA - Mis Pedidos</title>
    <link rel="icon" href="../../anexos/imagenes/havcanalogo.png">
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
                            <a href="../perfil.php">
                                <span>Hola, <?php echo $_SESSION['usuario']; ?></span>
                            </a>
                            <?php if(isset($_SESSION['es_admin']) && $_SESSION['es_admin']): ?>
                                <span class="admin-badge">Admin</span>
                            <?php endif; ?>
                            <a href="../auth/salir.php">|  |   Cerrar Sesión</a>
                        </li>
                    <?php else: ?>
                        <li><a href="../auth/login_registro_global.php">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <div class="pedidos-container">
        <h1>Mis Pedidos</h1>
        
        <?php if ($pedidos->num_rows > 0): ?>
            <?php while ($pedido = $pedidos->fetch_assoc()): ?>
                <div class="pedido-card">
                    <div class="pedido-header">
                        <h2>Pedido <?php echo htmlspecialchars($pedido['numero_pedido']); ?></h2>
                        <span class="estado-<?php echo strtolower($pedido['estado']); ?>">
                            <?php echo ucfirst(htmlspecialchars($pedido['estado'])); ?>
                        </span>
                    </div>
                    <p>Fecha: <?php echo date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])); ?></p>
                    <p>Subtotal: $<?php echo number_format($pedido['subtotal'], 2); ?></p>
                    <p>Envío: $<?php echo number_format($pedido['envio'], 2); ?></p>
                    <p>Total: $<?php echo number_format($pedido['total'], 2); ?></p>
                    
                    <a href="https://wa.me/593968403024?text=Hola, quisiera consultar sobre mi pedido <?php echo urlencode($pedido['numero_pedido']); ?>" 
                       class="whatsapp-button" 
                       target="_blank">
                        <i class="fab fa-whatsapp"></i> Consultar por WhatsApp
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="sin-pedidos">
                <h2>No tienes pedidos realizados</h2>
                <p>¡Explora nuestro catálogo y realiza tu primer pedido!</p>
                <a href="../catalogo.php" style="color: #660030;">Ver Catálogo</a>
            </div>
        <?php endif; ?>
    </div>

    <script src="../../anexos/js/menu.js"></script>
</body>
</html>