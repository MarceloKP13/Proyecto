<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAVCANA - Sobre Nosotros</title>
    <link rel="icon" href="../anexos/imagenes/havcanalogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../anexos/css/header.css">
    <link rel="stylesheet" href="../anexos/css/boton.css">
    <link rel="stylesheet" href="../anexos/css/info.css">
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
                            <a href="perfil.php"><span>Hola, <?php echo $_SESSION['usuario']; ?></span></a>
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

    <main class="about-container">
        <section class="hero-section">
            <div class="hero-content">
                <h1>Nuestra Historia</h1>
                <p>Conoce más sobre HAVCANA y nuestra pasión por los vinos artesanales</p>
            </div>
        </section>
        
        <section class="story-section">
            <div class="story-content">
                <h2>Cómo Comenzó Todo</h2>
                <p>HAVCANA nació de la pasión por los sabores auténticos y el arte de la vinificación. Todo comenzó como un proyecto familiar en una pequeña bodega, donde experimentábamos con diferentes frutas y técnicas de fermentación, buscando crear algo único y especial.</p>
                <p>Lo que comenzó como un hobby pronto se convirtió en una misión: crear vinos artesanales de alta calidad que pudieran ser disfrutados por todos. Con cada botella elaborada, perfeccionamos nuestras técnicas y expandimos nuestra visión.</p>
                <p>Hoy, HAVCANA representa la culminación de años de pasión, dedicación y búsqueda constante de la excelencia. Cada uno de nuestros vinos cuenta una historia y lleva consigo el legado de nuestra tradición artesanal.</p>
            </div>
            <div class="story-image">
                <img src="../anexos/imagenes/historia.jpg" alt="Historia de HAVCANA">
            </div>
        </section>
        
        <section class="process-section">
            <h2>Nuestro Proceso Artesanal</h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>Selección</h3>
                    <p>Elegimos cuidadosamente cada ingrediente, priorizando la calidad y frescura para garantizar el mejor sabor en nuestros vinos.</p>
                </div>
                <div class="process-step">
                    <div class="step-icon">
                        <i class="fas fa-mortar-pestle"></i>
                    </div>
                    <h3>Preparación</h3>
                    <p>Procesamos los ingredientes de manera tradicional, respetando los métodos que han sido transmitidos a través de generaciones.</p>
                </div>
                <div class="process-step">
                    <div class="step-icon">
                        <i class="fas fa-wine-bottle"></i>
                    </div>
                    <h3>Fermentación</h3>
                    <p>Dejamos que la naturaleza haga su trabajo, controlando cuidadosamente cada etapa del proceso para garantizar resultados excepcionales.</p>
                </div>
                <div class="process-step">
                    <div class="step-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Control de Calidad</h3>
                    <p>Cada botella pasa por rigurosas pruebas para asegurar que solo lo mejor llegue a tu mesa.</p>
                </div>
            </div>
        </section>
        
        <section class="values-section">
            <div class="values-image">
                <img src="../anexos/imagenes/valores.jpg" alt="Nuestros Valores">
            </div>
            <div class="values-content">
                <h2>Nuestros Valores</h2>
                <div class="value-item">
                    <h3><i class="fas fa-heart"></i> Pasión</h3>
                    <p>Amamos lo que hacemos y ponemos nuestro corazón en cada botella que creamos.</p>
                </div>
                <div class="value-item">
                    <h3><i class="fas fa-leaf"></i> Sostenibilidad</h3>
                    <p>Nos comprometemos con prácticas responsables con el medio ambiente en todo nuestro proceso.</p>
                </div>
                <div class="value-item">
                    <h3><i class="fas fa-handshake"></i> Comunidad</h3>
                    <p>Valoramos las relaciones con nuestros clientes y proveedores, creando una comunidad alrededor de nuestra marca.</p>
                </div>
                <div class="value-item">
                    <h3><i class="fas fa-star"></i> Excelencia</h3>
                    <p>Buscamos la perfección en cada detalle, desde la selección de ingredientes hasta el embotellado final.</p>
                </div>
            </div>
        </section>
        
        <section class="future-section">
            <h2>Nuestra Visión de Futuro</h2>
            <p>En HAVCANA, miramos hacia el futuro con optimismo y grandes planes. Estamos constantemente investigando nuevos sabores y técnicas para ampliar nuestra colección de vinos. Nuestra meta es expandir nuestra presencia y llevar la experiencia HAVCANA a más personas, sin perder nunca la esencia artesanal que nos caracteriza.</p>
            <p>Actualmente contamos con cinco variedades excepcionales, pero estamos trabajando para desarrollar nuevos productos que sorprendan y deleiten a nuestros clientes. Cada nuevo sabor es una aventura que emprendemos con pasión y dedicación.</p>
            <p>Te invitamos a ser parte de nuestro viaje y crecer junto a nosotros en esta fascinante travesía del mundo de los vinos artesanales.</p>
        </section>
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