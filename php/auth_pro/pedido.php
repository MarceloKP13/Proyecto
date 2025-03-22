<?php
session_start();
require_once 'auth/conexion.php';

// Función para actualizar estado
function actualizarEstado($pedido_id) {
    global $conn;
    $sql = "UPDATE pedidos SET estado = 'realizado' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$pedido_id]);
}

// Manejar actualización de estado
if (isset($_POST['actualizar_estado'])) {
    $pedido_id = $_POST['pedido_id'];
    actualizarEstado($pedido_id);
}

// Búsqueda
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$where = "";
if ($busqueda) {
    $where = "WHERE numero_pedido LIKE ? OR fecha LIKE ?";
}

$sql = "SELECT p.*, u.nombre_completo, u.email, u.username 
        FROM pedidos p 
        JOIN usuarios u ON p.usuario_id = u.id " . $where . 
        " ORDER BY p.fecha DESC";

$stmt = $conn->prepare($sql);
if ($busqueda) {
    $param = "%$busqueda%";
    $stmt->execute([$param, $param]);
} else {
    $stmt->execute();
}
$pedidos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pedidos - HAVCANA</title>
    <link rel="stylesheet" href="../anexos/css/pedido.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main class="pedidos-container">
        <h1>Gestión de Pedidos</h1>
        
        <div class="search-box">
            <form action="" method="GET">
                <input type="text" name="busqueda" placeholder="Buscar por número de pedido o fecha..." 
                       value="<?php echo htmlspecialchars($busqueda); ?>">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="pedidos-list">
            <?php foreach ($pedidos as $pedido): ?>
                <div class="pedido-card">
                    <div class="pedido-header">
                        <h2>Pedido: <?php echo htmlspecialchars($pedido['numero_pedido']); ?></h2>
                        <span class="estado <?php echo $pedido['estado']; ?>">
                            <?php echo ucfirst($pedido['estado']); ?>
                        </span>
                    </div>
                    
                    <div class="pedido-details">
                        <p><strong>Cliente:</strong> <?php echo htmlspecialchars($pedido['nombre_completo']); ?></p>
                        <p><strong>Usuario:</strong> <?php echo htmlspecialchars($pedido['username']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($pedido['email']); ?></p>
                        <p><strong>Fecha:</strong> <?php echo date('d/m/Y H:i', strtotime($pedido['fecha'])); ?></p>
                        <p><strong>Total:</strong> €<?php echo number_format($pedido['total'], 2); ?></p>
                    </div>

                    <?php if ($pedido['estado'] == 'pendiente'): ?>
                        <form method="POST" class="estado-form">
                            <input type="hidden" name="pedido_id" value="<?php echo $pedido['id']; ?>">
                            <button type="submit" name="actualizar_estado" class="btn-actualizar">
                                <i class="fas fa-check"></i> Marcar como Realizado
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>