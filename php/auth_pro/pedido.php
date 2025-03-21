
<?php
session_start();
include '../auth/conexion_be.php';

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

// Manejar la acción de ocultar pedido
if (isset($_POST['ocultar_pedido'])) {
    $pedido_id = $_POST['pedido_id'];
    $query_ocultar = "UPDATE pedidos SET estado = 'eliminado' WHERE id = ? AND usuario_id = ?";
    $stmt = $conexion->prepare($query_ocultar);
    $stmt->bind_param("ii", $pedido_id, $usuario_id);
    $stmt->execute();
}

// Obtener todos los pedidos del usuario actual que no estén eliminados
$query_pedidos = "SELECT * FROM pedidos WHERE usuario_id = ? AND estado != 'eliminado' ORDER BY fecha_pedido DESC";
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
    <title>HAVCANA - Pedido Generado</title>
    <link rel="icon" href="../../anexos/imagenes/logominiatura.png">
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
            <nav>
                <ul class="nav-menu">
                    <li><a href="../../index.php">Inicio</a></li>
                    <li><a href="../catalogo.php">Catálogo</a></li>
                    <li><a href="../carrito.php">Carrito</a></li>
                    <li><a href="../info.php">Sobre Nosotros</a></li>
                    <li><a href="../contactos.php">Contacto</a></li>                    
                    <li><a href="pedido.php">Mis Compras</a></li>
                    <?php if(isset($_SESSION['usuario'])): ?>
                        <li class="user-info">
                            <a href="pedido.php"><span>Hola, <?php echo $_SESSION['usuario']; ?></span></a>
                            <?php if(isset($_SESSION['es_admin']) && $_SESSION['es_admin']): ?>
                                <span class="admin-badge">Admin</span>
                            <?php endif; ?>
                            <a href="../auth/salir.php">|  |   Cerrar Sesión</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <div class="pedido-container">
        <h1>Mis Pedidos</h1>
        
        <?php if ($pedidos->num_rows > 0): ?>
            <?php while ($pedido = $pedidos->fetch_assoc()): ?>
                <div class="pedido-card">
                    <div class="pedido-header">
                        <h2>Pedido <?php echo $pedido['numero_pedido']; ?></h2>
                        <span class="estado-<?php echo strtolower($pedido['estado']); ?>">
                            <?php echo ucfirst($pedido['estado']); ?>
                        </span>
                    </div>
                    <div class="detalles-pedido">
                        <p><strong>Fecha:</strong> <?php echo date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])); ?></p>
                        <p><strong>Total:</strong> $<?php echo number_format($pedido['total'], 2); ?></p>
                    </div>
                    
                    <?php if ($pedido['estado'] === 'completado' || $pedido['estado'] === 'realizado'): ?>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="pedido_id" value="<?php echo $pedido['id']; ?>">
                            <button type="submit" name="ocultar_pedido" class="remove-btn">
                                <i class="fas fa-trash"></i> Ocultar pedido
                            </button>
                        </form>
                    <?php endif; ?>
                    
                    <div class="mensaje-privacidad">
                        <p>Para proteger su información personal y financiera, por favor contacte directamente con nuestro distribuidor para coordinar el pago y la entrega de su pedido.</p>
                        <a href="https://wa.me/593968403024?text=Hola, quisiera consultar sobre mi pedido <?php echo urlencode($pedido['numero_pedido']); ?>" 
                           class="whatsapp-button" 
                           target="_blank">
                            <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="sin-pedidos">
                <p>No tienes pedidos activos.</p>
            </div>
        <?php endif; ?>
    </div>

    <script src="../../anexos/js/menu.js"></script>
</body>
</html>