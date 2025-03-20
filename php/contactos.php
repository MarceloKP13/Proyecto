<?php
session_start();

// En una implementación real, estos datos vendrían de la base de datos
$team = [
    [
        'nombre' => 'Marcos Mariño',
        'rol' => 'Fundador',
        'descripcion' => 'Apasionado de la vinicultura con más de 10 años de experiencia. Su visión dio origen a HAVCANA con el objetivo de crear vinos artesanales únicos y accesibles.',
        'imagen' => '../anexos/imagenes/marcos.png',
        'redes' => [
            'whatsapp' => '+593 98 936 7154',
            'tiktok' => '@emprenderdesde0',
            'instagram' => '@havcana8'
        ]
    ],
    [
        'nombre' => 'Marcelo Torres',
        'rol' => 'Diseñador Web',
        'descripcion' => 'Creativo y perfeccionista, Marcelo ha dado vida a la experiencia digital de HAVCANA. Su pasión por el diseño y la usabilidad se refleja en cada elemento de nuestra web.',
        'imagen' => '../anexos/imagenes/marce.jpg',
        'redes' => [
            'facebook' => '@MarceloKP13',
            'instagram' => '@marce_kp13',
            'tiktok' => '@marcelokp13',
            'github' => 'MarceloKP13',
            'whatsapp' => '+593 96 840 3024'
        ]
    ]
];

$faqs = [
    [
        'pregunta' => '¿Cómo puedo realizar un pedido?',
        'respuesta' => 'Para realizar un pedido es necesario registrarse o iniciar sesión, ya que esto nos permite tener la información necesaria para generar el número de pedido. Una vez generada la orden, deberás contactar directamente por WhatsApp con el distribuidor para finalizar la transacción, esto con el fin de salvaguardar tu información personal y financiera.'
    ],
    [
        'pregunta' => '¿Cuáles son los métodos de pago aceptados?',
        'respuesta' => 'Al ser una transacción directa y acordada a través de WhatsApp, la forma de pago más factible es por transferencia o depósito. Trabajamos con Banco Pichincha y Bolivariano. En un futuro cercano, implementaremos métodos de pago adicionales.'
    ],
    [
        'pregunta' => '¿Cuánto tiempo tarda en llegar mi pedido?',
        'respuesta' => 'Los tiempos de entrega varían según el tamaño del pedido. Para pedidos pequeños, el tiempo de entrega es de 2 a 3 días. Para pedidos grandes, el tiempo máximo de entrega es de 7 a 10 días.'
    ],
    [
        'pregunta' => '¿Ofrecen envíos internacionales?',
        'respuesta' => 'Al ser una empresa emergente, actualmente solo realizamos envíos a nivel nacional a través de Servientrega, Tramaco Express y Correos del Ecuador.'
    ],
    [
        'pregunta' => '¿Cuál es la política de devoluciones?',
        'respuesta' => 'Aceptamos devoluciones dentro de los 14 días siguientes a la recepción del producto. El producto debe estar sin abrir y en perfectas condiciones. Contacta con nuestro distribuidor para iniciar el proceso.'
    ],
    [
        'pregunta' => '¿Tienen tienda física?',
        'respuesta' => 'Actualmente operamos exclusivamente online, aunque ocasionalmente participamos en ferias y eventos. Sigue nuestras redes sociales para estar al tanto de dónde puedes encontrarnos.'
    ]
];

// Procesar el formulario si se ha enviado
$mensaje_enviado = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contacto'])) {
    // En una implementación real, aquí procesarías y guardarías el mensaje en la base de datos
    // Por ahora, simplemente mostraremos un mensaje de éxito
    $mensaje_enviado = true;
}

// Procesar formulario de comentarios
$comentario_enviado = isset($_GET['comentario_enviado']) && $_GET['comentario_enviado'] == 'true';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAVCANA - Contacto</title>
    <link rel="icon" href="../anexos/imagenes/logominiatura.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../anexos/css/header.css">
    <link rel="stylesheet" href="../anexos/css/boton.css">
    <link rel="stylesheet" href="../anexos/css/contactos.css">
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

    <main class="contact-container">
        <section class="hero-section">
            <div class="hero-content">
                <h1>Contacta con Nosotros</h1>
                <p>Estamos aquí para ayudarte y responder a tus preguntas</p>
            </div>
        </section>
        
        <section class="contact-info-section">
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3>Email</h3>
                <p>info@havcana.com</p>
                <p>ventas@havcana.com</p>
            </div>
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3>Teléfono</h3>
                <p>+593 98 936 7154</p>
                <p>+593 96 840 3024</p>
            </div>
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>Dirección</h3>
                <p>Jambelí, Nueva Loja</p>
                <p>Sucumbios, Ecuador</p>
            </div>
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Horario</h3>
                <p>Lunes a Viernes: 9am - 9pm</p>
                <p>Fines de semana: 10am - 6pm</p>
            </div>
        </section>
        
        <section class="team-section">
            <h2>Nuestro Equipo</h2>
            <div class="team-cards">
                <?php foreach ($team as $miembro): ?>
                <div class="team-card">
                    <div class="team-image">
                        <img src="<?php echo $miembro['imagen']; ?>" alt="<?php echo $miembro['nombre']; ?>">
                    </div>
                    <div class="team-info">
                        <h3><?php echo $miembro['nombre']; ?></h3>
                        <p class="team-role"><?php echo $miembro['rol']; ?></p>
                        <p class="team-description"><?php echo $miembro['descripcion']; ?></p>
                        <div class="social-links">
                            <?php foreach ($miembro['redes'] as $red => $url): ?>
                                <a href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo $red; ?>">
                                    <i class="fab fa-<?php echo $red; ?>"></i>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        
        <section class="faq-section">
            <h2>Preguntas Frecuentes</h2>
            <div class="faq-accordion">
                <?php foreach ($faqs as $index => $faq): ?>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(<?php echo $index; ?>)">
                        <?php echo $faq['pregunta']; ?>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer" id="faq-answer-<?php echo $index; ?>">
                        <?php echo $faq['respuesta']; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        
        <section class="contact-form-section">            
            <div class="map-container">
                <h2>Nuestra Ubicación</h2>
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.817175371318!2d-76.88724082412895!3d0.08866449994247975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e28a82deaa93757%3A0x80bd34fb97e2f5ba!2sLAGO%20AGRIO%20MOTORS!5e0!3m2!1ses!2sec!4v1709771046099!5m2!1ses!2sec" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
        
        <section class="comments-section">
            <h2>Comentarios y Sugerencias</h2>
            <p class="comments-intro">Valoramos tu opinión y estamos siempre buscando mejorar. Comparte tus comentarios, sugerencias o ideas con nosotros.</p>
            
            <?php if ($comentario_enviado): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <p>¡Gracias por tu comentario! Lo tendremos en cuenta para seguir mejorando.</p>
                </div>
            <?php else: ?>
            <form action="auth_comen/guardar_comentario.php" method="POST" class="comments-form">
                <div class="form-group">
                    <label for="nombre_comentario">Nombre (opcional)</label>
                    <input type="text" id="nombre_comentario" name="nombre_comentario" placeholder="Anónimo">
                </div>
                <div class="form-group">
                    <label for="tipo_comentario">Tipo de comentario</label>
                    <select id="tipo_comentario" name="tipo_comentario" required>
                        <option value="">Selecciona una opción</option>
                        <option value="sugerencia">Sugerencia para el sitio web</option>
                        <option value="producto">Comentario sobre productos</option>
                        <option value="consulta">Consulta sobre compras</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comentario">Tu comentario</label>
                    <textarea id="comentario" name="comentario" rows="5" required></textarea>
                </div>
                <button type="submit" name="submit_comentario" class="submit-btn">
                    Enviar Comentario <i class="fas fa-comment"></i>
                </button>
            </form>
            <?php endif; ?>
        </section>
    </main>

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
                    <li><a href="../php/catalogo.php">Catálogo</a></li>
                    <li><a href="../php/carrito.php">Carrito</a></li>
                    <li><a href="../php/info.php">Sobre Nosotros</a></li>
                    <li><a href="../php/contactos.php">Contacto</a></li>
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
            <p>&copy; 2025 HAVCANA. Todos los derechos reservados.</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/Havcana" target="_blank"><img src="../anexos/imagenes/facebook.png" alt="Facebook"></a>
                <a href="https://www.instagram.com/Havcana" target="_blank"><img src="../anexos/imagenes/instagram.png" alt="Instagram"></a>
                <a href="https://www.x.com/Havcana" target="_blank"><img src="../anexos/imagenes/x.png" alt="Twitter"></a>
            </div>
        </div>
        <div class="whatsapp-button">
            <a href="https://wa.me/593968403024" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
                <span class="contact-text">Contacto Directo</span>
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </footer>

    <script src="../anexos/js/menu.js"></script>
    <script src="../anexos/js/comentario.js"></script>
</body>
</html>