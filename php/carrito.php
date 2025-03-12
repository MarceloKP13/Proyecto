<?php
session_start();

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Procesar acciones del carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    // Buscar info del producto (en un sistema real, esto vendría de la base de datos)
    $productos = [
        1 => ['id' => 1, 'nombre' => 'Vino Tinto Reserva', 'precio' => 15.99],
        2 => ['id' => 2, 'nombre' => 'Vino Blanco Chardonnay', 'precio' => 12.99],
        3 => ['id' => 3, 'nombre' => 'Vino Rosado', 'precio' => 13.50],
        4 => ['id' => 4, 'nombre' => 'Vino Espumoso', 'precio' => 18.75],
        5 => ['id' => 5, 'nombre' => 'Vino Dulce Moscatel', 'precio' => 14.25]
    ];

    $accion = $_POST['accion'];

    if ($accion === 'agregar' && isset($_POST['producto_id']) && isset($_POST['cantidad'])) {
        $producto_id = (int)$_POST['producto_id'];
        $cantidad = (int)$_POST['cantidad'];

        if (isset($productos[$producto_id])) {
            $producto = $productos[$producto_id];

            // Verificar si ya existe en el carrito y actualizar cantidad
            $existe = false;
            foreach ($_SESSION['carrito'] as $index => $item) {
                if ($item['id'] === $producto_id) {
                    $_SESSION['carrito'][$index]['cantidad'] += $cantidad;
                    $existe = true;
                    break;
                }
            }

            // Si no existe, añadir al carrito
            if (!$existe) {
                $_SESSION['carrito'][] = [
                    'id' => $producto_id,
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'cantidad' => $cantidad
                ];
            }
        }
    } elseif ($accion === 'actualizar' && isset($_POST['item_index']) && isset($_POST['cantidad'])) {
        $index = (int)$_POST['item_index'];
        $cantidad = (int)$_POST['cantidad'];

        if (isset($_SESSION['carrito'][$index])) {
            if ($cantidad > 0) {
                $_SESSION['carrito'][$index]['cantidad'] = $cantidad;
            } else {
                // Eliminar si cantidad es 0
                array_splice($_SESSION['carrito'], $index, 1);
            }
        }
    } elseif ($accion === 'eliminar' && isset($_POST['item_index'])) {
        $index = (int)$_POST['item_index'];
        if (isset($_SESSION['carrito'][$index])) {
            array_splice($_SESSION['carrito'], $index, 1);
        }
    } elseif ($accion === 'vaciar') {
        $_SESSION['carrito'] = [];
    }

    // Redirigir para evitar reenvío de formulario
    header('Location: carrito.php');
    exit;
}

// Calcular totales
$subtotal = 0;
$envio = 5.00; // Costo fijo de envío
$total = 0;

foreach ($_SESSION['carrito'] as $item) {
    $subtotal += $item['precio'] * $item['cantidad'];
}

$total = $subtotal + $envio;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAVCANA - Carrito de Compras</title>
    <link rel="icon" href="../anexos/imagenes/havcanalogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../anexos/css/header.css">
    <link rel="stylesheet" href="../anexos/css/boton.css">
    <link rel="stylesheet" href="../anexos/css/carrito.css">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo-container">
                <img src="../anexos/imagenes/havcanalogo.png" alt="HAVCANA Logo">
                <a href="info.php" class="brand-name">HAVCANA</a>
            </div>

            <button class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav>
                <ul class="nav-menu">
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="catalogo.php">Catálogo</a></li>
                    <li><a href="carrito.php">Carrito</a></li>
                    <li><a href="info.php">Sobre Nosotros</a></li>
                    <li><a href="contactos.php">Contacto</a></li>
                    <?php if(isset($_SESSION['usuario'])): ?>
                        <li class="user-info">
                            <span>Hola, <?php echo $_SESSION['usuario']; ?></span>
                            <?php if(isset($_SESSION['es_admin']) && $_SESSION['es_admin']): ?>
                                <span class="admin-badge">Admin</span>
                            <?php endif; ?>
                            <a href="auth/salir.php">|  |   Cerrar Sesión</a>
                        </li>
                    <?php else: ?>
                        <li><a href="auth/login_registro_global.php">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="cart-container">
        <h1>Tu Carrito de Compras</h1>
        
        <?php if (empty($_SESSION['carrito'])): ?>
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <p>Tu carrito está vacío</p>
            <a href="catalogo.php" class="continue-shopping">Ir al catálogo</a>
        </div>
        <?php else: ?>
        <div class="cart-grid">
            <div class="cart-items">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['carrito'] as $index => $item): ?>
                        <tr>
                            <td class="product-name"><?php echo $item['nombre']; ?></td>
                            <td class="product-price">$<?php echo number_format($item['precio'], 2); ?></td>
                            <td class="product-quantity">
                                <form action="carrito.php" method="POST" class="quantity-form">
                                    <input type="hidden" name="accion" value="actualizar">
                                    <input type="hidden" name="item_index" value="<?php echo $index; ?>">
                                    <select name="cantidad" onchange="this.form.submit()">
                                        <?php for($i = 1; $i <= 10; $i++): ?>
                                            <option value="<?php echo $i; ?>" <?php echo ($i == $item['cantidad']) ? 'selected' : ''; ?>>
                                                <?php echo $i; ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </form>
                            </td>
                            <td class="product-subtotal">$<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></td>
                            <td class="product-actions">
                                <form action="carrito.php" method="POST">
                                    <input type="hidden" name="accion" value="eliminar">
                                    <input type="hidden" name="item_index" value="<?php echo $index; ?>">
                                    <button type="submit" class="remove-btn">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="cart-actions">
                    <a href="catalogo.php" class="continue-shopping">
                        <i class="fas fa-arrow-left"></i> Seguir comprando
                    </a>
                    <form action="carrito.php" method="POST">
                        <input type="hidden" name="accion" value="vaciar">
                        <button type="submit" class="empty-cart-btn">
                            <i class="fas fa-trash"></i> Vaciar carrito
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="cart-summary">
                <h2>Resumen del pedido</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>$<?php echo number_format($subtotal, 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Envío</span>
                    <span>$<?php echo number_format($envio, 2); ?></span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>$<?php echo number_format($total, 2); ?></span>
                </div>
                <button class="checkout-btn">
                    Proceder al pago <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <footer>
        <div class="whatsapp-button">
            <a href="https://wa.me/593968403024" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
                <span class="contact-text">Contacto Directo</span>
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </footer>

    <script src="../anexos/js/menu.js"></script>
</body>
</html>