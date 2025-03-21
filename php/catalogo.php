<?php
session_start();
include 'auth/conexion_be.php';
// Obtener la lista de productos de la base de datos
$result = mysqli_query($conexion, "SELECT * FROM productos");
$productos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAVCANA - Catálogo</title>
    <link rel="icon" href="../anexos/imagenes/logominiatura.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../anexos/css/header.css">
    <link rel="stylesheet" href="../anexos/css/boton.css">
    <link rel="stylesheet" href="../anexos/css/catalogo.css">
    <link rel="stylesheet" href="../anexos/css/admin.css">
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
                    <li><a href="auth_pro/pedido.php">Mis Compras</a></li>
                    <?php if(isset($_SESSION['usuario'])): ?>
                        <li class="user-info">
                            <a href="auth_pro/pedido.php"><span>Hola, <?php echo $_SESSION['usuario']; ?></span></a>
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
    <main class="catalog-container">
        <h1>Nuestros Vinos</h1>
        <p class="catalog-intro">Descubre nuestra selección de vinos artesanales elaborados con pasión y dedicación. Cada botella representa nuestra búsqueda por la excelencia y el sabor auténtico.</p>

        <div class="products-container">
            <?php foreach ($productos as $producto): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                </div>
                <div class="product-info">
                    <?php if(isset($_SESSION['es_admin']) && $_SESSION['es_admin']): ?>
                        <form action="auth_pro/actualizar_producto.php" method="POST" class="admin-edit-form" enctype="multipart/form-data">
                            <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                            <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>">
                            <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>">
                            <textarea name="descripcion"><?php echo $producto['descripcion']; ?></textarea>
                            <textarea name="maridaje"><?php echo $producto['maridaje']; ?></textarea>
                            <input type="file" name="nueva_imagen">
                            <button type="submit" class="admin-save-btn">Guardar Cambios</button>
                        </form>
                    <?php else: ?>
                        <h2><?php echo $producto['nombre']; ?></h2>
                        <p class="product-price">$<?php echo number_format($producto['precio'], 2); ?></p>
                        <p class="product-description"><?php echo $producto['descripcion']; ?></p>
                        <div class="product-details">
                            <h3>Maridaje recomendado:</h3>
                            <p><?php echo $producto['maridaje']; ?></p>
                        </div>
                    <?php endif; ?>
                    <form action="carrito.php" method="POST">
                        <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                        <input type="hidden" name="accion" value="agregar">
                        <div class="product-actions">
                            <div class="quantity-selector">
                                <label for="cantidad_<?php echo $producto['id']; ?>">Cantidad:</label>
                                <select name="cantidad" id="cantidad_<?php echo $producto['id']; ?>">
                                    <?php for($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php 
                                        echo $i;
                                        if($i == 12) {
                                            $precio_normal = strpos($producto['nombre'], 'Manzana') !== false ? 4.99 : 9.99;
                                            $precio_docena = strpos($producto['nombre'], 'Manzana') !== false ? 3.85 : 7.75;
                                            echo " (Precio especial: $" . $precio_docena . " c/u)";
                                        }
                                    ?></option>
                                <?php endfor; ?>
                                </select>
                            </div>
                            <button type="submit" class="add-to-cart-btn">Agregar al Carrito</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
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