<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAVCANA</title>
    <link rel="icon" href="anexos/imagenes/havcanalogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="anexos/css/header.css">
    <link rel="stylesheet" href="anexos/css/boton.css">
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
                    <li><a href="php/contacto.php">Contacto</a></li>
                    <?php if(isset($_SESSION['usuario'])): ?>
                        <li class="user-info">
                            <span>Hola, <?php echo $_SESSION['usuario']; ?></span>
                            <?php if(isset($_SESSION['es_admin']) && $_SESSION['es_admin']): ?>
                                <span class="admin-badge">Admin</span>
                            <?php endif; ?>
                            <a href="php/auth/salir.php">Cerrar Sesión</a>
                        </li>
                    <?php else: ?>
                        <li><a href="php/auth/login_registro_global.php">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <footer>
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