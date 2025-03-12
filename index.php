<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAVCANA - Vinos Artesanales</title>
    <link rel="icon" href="anexos/imagenes/havcanalogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="anexos/css/header.css">
    <link rel="stylesheet" href="anexos/css/boton.css">
    <link rel="stylesheet" href="anexos/css/inicio.css">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo-container">
                <img src="anexos/imagenes/havcanalogo.png" alt="HAVCANA Logo">
                <a href="php/info.php" class="brand-name">HAVCANA</a>
            </div>

            <button class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav>
                <ul class="nav-menu">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="php/catalogo.php">Catálogo</a></li>
                    <li><a href="php/carrito.php">Carrito</a></li>
                    <li><a href="php/info.php">Sobre Nosotros</a></li>
                    <li><a href="php/contactos.php">Contacto</a></li>
                    <?php if(isset($_SESSION['usuario'])): ?>
                        <li class="user-info">
                            <span>Hola, <?php echo $_SESSION['usuario']; ?></span>
                            <?php if(isset($_SESSION['es_admin']) && $_SESSION['es_admin']): ?>
                                <span class="admin-badge">Admin</span>
                            <?php endif; ?>
                            <a href="php/auth/salir.php">|  |   Cerrar Sesión</a>
                        </li>
                    <?php else: ?>
                        <li><a href="php/auth/login_registro_global.php">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    
    <main class="hero">
        <div class="hero-content">
            <h1>Descubre HAVCANA</h1>
            <p class="tagline">Vinos artesanales con sabores únicos</p>
            <p class="description">Nuestra pasión por los vinos artesanales nos lleva a crear sabores excepcionales que deleitarán tus sentidos. Elaborados con los mejores ingredientes y un proceso cuidadoso.</p>
            <a href="php/catalogo.php" class="cta-button">Explorar Colección</a>
        </div>
    </main>
    
    <section class="featured-products">
        <h2>Nuestros Vinos</h2>
        <div class="products-grid">
            <div class="product-card">
                <img src="anexos/imagenes/pepiche.jpg" alt="Vino de Pepiche">
                <h3>Vino de Pepiche</h3>
                <p>Sabor exótico y refrescante</p>
            </div>
            <div class="product-card">
                <img src="anexos/imagenes/manzana.jpg" alt="Vino de Manzana">
                <h3>Vino de Manzana</h3>
                <p>Dulce y aromático con notas frutales</p>
            </div>
            <div class="product-card">
                <img src="anexos/imagenes/uvacaimorona.jpg" alt="Vino de Uva Caimorona">
                <h3>Vino de Uva Caimorona</h3>
                <p>Sabor intenso y aterciopelado</p>
            </div>
            <div class="product-card">
                <img src="anexos/imagenes/uvilla.jpg" alt="Vino de Uvilla">
                <h3>Vino de Uvilla</h3>
                <p>Equilibrado y ligeramente ácido</p>
            </div>
            <div class="product-card">
                <img src="anexos/imagenes/floryuva.jpg" alt="Vino Flor y Uva">
                <h3>Vino Flor y Uva</h3>
                <p>Delicado bouquet floral y frutal</p>
            </div>
        </div>
    </section>
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>HAVCANA</h3>
                <p>Vinos artesanales con sabores únicos elaborados con pasión y tradición.</p>
            </div>
            <div class="footer-section">
                <h3>Enlaces</h3>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="php/catalogo.php">Catálogo</a></li>
                    <li><a href="php/info.php">Sobre Nosotros</a></li>
                    <li><a href="php/contactos.php">Contacto</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contacto</h3>
                <p><i class="fas fa-map-marker-alt"></i> Nueva Loja, Sucumbios, Ecuador</p>
                <p><i class="fas fa-phone"></i> +593 968 403 024</p>
                <p><i class="fas fa-envelope"></i> info@havcana.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2023 HAVCANA. Todos los derechos reservados.</p>
            <div class="social-icons">
                <a href="#"><img src="anexos/imagenes/facebook.png" alt="Facebook"></a>
                <a href="#"><img src="anexos/imagenes/instagram.png" alt="Instagram"></a>
                <a href="#"><img src="anexos/imagenes/twitter.png" alt="Twitter"></a>
            </div>
        </div>
        <div class="whatsapp-button">
            <a href="https://wa.me/593968403024" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
                <span class="contact-text">Contacto Directo</span>
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </footer>
    <script src="anexos/js/menu.js"></script>
</body>
</html>