<?php
session_start();

// Procesar el formulario si se ha enviado
$mensaje_enviado = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contacto'])) {
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
                    <li><a href="auth_pro/pedido.php">Mis Compras</a></li>
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
                <div class="team-card">
                    <div class="team-image">
                        <img src="../anexos/imagenes/marcos.png" alt="Marcos Mariño">
                    </div>
                    <div class="team-info">
                        <h3>Marcos Mariño</h3>
                        <p class="team-role">Fundador</p>
                        <p class="team-description">Apasionado de la vinicultura con más de 5 años de experiencia. Su visión dio origen a HAVCANA con el objetivo de crear vinos artesanales únicos y accesibles.</p>
                        <div class="social-links">
                            <a href="https://wa.me/+59398936715" target="_blank"><img src="../anexos/imagenes/whatsapp2.png" alt="WhatsApp"></a>
                            <a href="https://www.tiktok.com/@emprenderdesde0" target="_blank"><img src ="../anexos/imagenes/tiktok.png" alt="Tik tok"></a>
                            <a href="https://www.instagram.com/havcana8" target="_blank"><img src ="../anexos/imagenes/instagram.png" alt="Tik tok"></a>
                        </div>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-image">
                        <img src="../anexos/imagenes/marce.jpg" alt="Marcelo Torres">
                    </div>
                    <div class="team-info">
                        <h3>Marcelo Torres</h3>
                        <p class="team-role">Diseñador Web</p>
                        <p class="team-description">Creativo y perfeccionista, Marcelo ha dado vida a la experiencia digital de HAVCANA. Su pasión por el diseño y la usabilidad se refleja en cada elemento de nuestra web.</p>
                        <div class="social-links">
                            <a href="https://www.facebook.com/MarceloKP13" target="_blank"><img src="../anexos/imagenes/facebook.png" alt="Facebook"></a>
                            <a href="https://www.instagram.com/marce_kp13" target="_blank"><img src="../anexos/imagenes/instagram.png" alt="Instagram"></a>
                            <a href="https://www.tiktok.com/@marcelokp13" target="_blank"><img src="../anexos/imagenes/tiktok.png" alt="TikTok"></a>
                            <a href="https://github.com/MarceloKP13" target="_blank"><img src="../anexos/imagenes/github2.png" alt="GitHub"></a>
                            <a href="https://wa.me/+593968403024" target="_blank"><img src="../anexos/imagenes/whatsapp2.png" alt="WhatsApp"></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section">
            <h2>Preguntas Frecuentes</h2>
            <div class="faq-accordion">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(0)">
                        ¿Cómo puedo realizar un pedido?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer" id="faq-answer-0">
                        Para realizar un pedido es necesario registrarse o iniciar sesión, ya que esto nos permite tener la información necesaria para generar el número de pedido. Una vez generada la orden, deberás contactar directamente por WhatsApp con el distribuidor para finalizar la transacción, esto con el fin de salvaguardar tu información personal y financiera.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(1)">
                        ¿Cuáles son los métodos de pago aceptados?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer" id="faq-answer-1">
                        Al ser una transacción directa y acordada a través de WhatsApp, la forma de pago más factible es por transferencia o depósito. Trabajamos con Banco Pichincha y Bolivariano. En un futuro cercano, implementaremos métodos de pago adicionales.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(2)">
                        ¿Cuánto tiempo tarda en llegar mi pedido?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer" id="faq-answer-2">
                        Los tiempos de entrega varían según el tamaño del pedido. Para pedidos pequeños, el tiempo de entrega es de 2 a 3 días. Para pedidos grandes, el tiempo máximo de entrega es de 7 a 10 días.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(3)">
                        ¿Ofrecen envíos internacionales?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer" id="faq-answer-3">
                        Al ser una empresa emergente, actualmente solo realizamos envíos a nivel nacional a través de Servientrega, Tramaco Express y Correos del Ecuador.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(4)">
                        ¿Cuál es la política de devoluciones?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer" id="faq-answer-4">
                        Aceptamos devoluciones dentro de los 14 días siguientes a la recepción del producto. El producto debe estar sin abrir y en perfectas condiciones. Contacta con nuestro distribuidor para iniciar el proceso.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(5)">
                        ¿Tienen tienda física?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer" id="faq-answer-5">
                        Actualmente operamos exclusivamente online, aunque ocasionalmente participamos en ferias y eventos. Sigue nuestras redes sociales para estar al tanto de dónde puedes encontrarnos.
                    </div>
                </div>
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
    
        <section class="product-comments-section">
            <h2>Comentarios sobre Productos</h2>
            <div class="product-comments">
                <?php
                include 'auth_comen/conexion_com.php';
                $sql = "SELECT c.*, COALESCE(NULLIF(c.nombre, ''), 'Anónimo') as nombre_mostrado 
                        FROM comentarios c 
                        WHERE c.tipo_comentario = 'producto' 
                        ORDER BY c.fecha DESC";
                $result = $conexion->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($comentario = $result->fetch_assoc()) {
                        echo '<div class="product-comment">';
                        if (isset($_SESSION['es_admin']) && $_SESSION['es_admin']) {
                            echo '<button class="delete-comment" onclick="deleteComment(' . $comentario['id'] . ')" title="Eliminar comentario"><i class="fas fa-times"></i></button>';
                        }
                        echo '<div class="comment-header">';
                        echo '<span class="comment-author">' . htmlspecialchars($comentario['nombre_mostrado']) . '</span>';
                        echo '<span class="comment-date">' . date('d/m/Y H:i', strtotime($comentario['fecha'])) . '</span>';
                        echo '</div>';
                        echo '<div class="comment-content">' . htmlspecialchars($comentario['comentario']) . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="no-comments">Aún no hay comentarios sobre productos.</p>';
                }
                ?>
            </div>
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
                    <li><a href="../php/auth_pro/pedido.php">Mis Compras</a></li>
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