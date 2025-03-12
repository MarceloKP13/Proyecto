<?php
session_start();

// Aquí conectarías con tu base de datos para obtener productos
// Simularemos productos para este ejemplo
$productos = [
    [
        'id' => 1,
        'nombre' => 'Vino Tinto Reserva',
        'descripcion' => 'Vino tinto con notas de frutas rojas y un toque de roble. Ideal para acompañar carnes rojas y quesos maduros.',
        'precio' => 15.99,
        'imagen' => '../anexos/imagenes/vino1.jpg',
        'maridaje' => 'Carnes rojas, quesos maduros, chocolate negro'
    ],
    [
        'id' => 2,
        'nombre' => 'Vino Blanco Chardonnay',
        'descripcion' => 'Vino blanco fresco y afrutado con notas cítricas y de manzana verde. Perfecto para pescados y mariscos.',
        'precio' => 12.99,
        'imagen' => '../anexos/imagenes/vino2.jpg',
        'maridaje' => 'Pescados, mariscos, ensaladas, quesos suaves'
    ],
    [
        'id' => 3,
        'nombre' => 'Vino Rosado',
        'descripcion' => 'Rosado equilibrado con aromas de frutos rojos y flores. Versátil para diferentes platos.',
        'precio' => 13.50,
        'imagen' => '../anexos/imagenes/vino3.jpg',
        'maridaje' => 'Paella, pizza, pasta, tapas variadas'
    ],
    [
        'id' => 4,
        'nombre' => 'Vino Espumoso',
        'descripcion' => 'Espumoso elegante con burbujas finas y persistentes. Ideal para celebraciones y aperitivos.',
        'precio' => 18.75,
        'imagen' => '../anexos/imagenes/vino4.jpg',
        'maridaje' => 'Aperitivos, postres, mariscos'
    ],
    [
        'id' => 5,
        'nombre' => 'Vino Dulce Moscatel',
        'descripcion' => 'Vino dulce aromático con notas de miel y frutas pasas. Perfecto para postres.',
        'precio' => 14.25,
        'imagen' => '../anexos/imagenes/vino5.jpg',
        'maridaje' => 'Postres, quesos azules, foie gras'
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAVCANA - Catálogo</title>
    <link rel="icon" href="../anexos/imagenes/havcanalogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../anexos/css/header.css">
    <link rel="stylesheet" href="../anexos/css/boton.css">
    <link rel="stylesheet" href="../anexos/css/catalogo.css">
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
                    <h2><?php echo $producto['nombre']; ?></h2>
                    <p class="product-price">$<?php echo number_format($producto['precio'], 2); ?></p>
                    <p class="product-description"><?php echo $producto['descripcion']; ?></p>
                    <div class="product-details">
                        <h3>Maridaje recomendado:</h3>
                        <p><?php echo $producto['maridaje']; ?></p>
                    </div>
                    <form action="carrito.php" method="POST">
                        <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                        <input type="hidden" name="accion" value="agregar">
                        <div class="product-actions">
                            <div class="quantity-selector">
                                <label for="cantidad_<?php echo $producto['id']; ?>">Cantidad:</label>
                                <select name="cantidad" id="cantidad_<?php echo $producto['id']; ?>">
                                    <?php for($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <button type="submit" class="add-to-cart-btn">
                                <i class="fas fa-shopping-cart"></i> Añadir al carrito
                            </button>
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