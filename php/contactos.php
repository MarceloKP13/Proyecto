<?php
session_start();

// En una implementación real, estos datos vendrían de la base de datos
$team = [
    [
        'nombre' => 'Juan Pérez',
        'rol' => 'Fundador',
        'descripcion' => 'Apasionado de la vinicultura con más de 10 años de experiencia. Su visión dio origen a HAVCANA con el objetivo de crear vinos artesanales únicos y accesibles.',
        'imagen' => '../anexos/imagenes/fundador.jpg',
        'redes' => [
            'twitter' => 'https://twitter.com/juanperez',
            'instagram' => 'https://instagram.com/juanperez',
            'linkedin' => 'https://linkedin.com/in/juanperez'
        ]
    ],
    [
        'nombre' => 'María Gómez',
        'rol' => 'Diseñadora Web',
        'descripcion' => 'Creativa y perfeccionista, María ha dado vida a la experiencia digital de HAVCANA. Su pasión por el diseño y la usabilidad se refleja en cada elemento de nuestra web.',
        'imagen' => '../anexos/imagenes/disenadora.jpg',
        'redes' => [
            'twitter' => 'https://twitter.com/mariagomez',
            'instagram' => 'https://instagram.com/mariagomez',
            'behance' => 'https://behance.net/mariagomez'
        ]
    ]
];

// FAQs
$faqs = [
    [
        'pregunta' => '¿Cómo puedo realizar un pedido?',
        'respuesta' => 'Puedes realizar tu pedido directamente a través de nuestra tienda en línea. Simplemente navega por nuestro catálogo, selecciona los productos que deseas y añádelos al carrito. Una vez en el carrito, procede al pago siguiendo los pasos indicados.'
    ],
    [
        'pregunta' => '¿Cuáles son los métodos de pago aceptados?',
        'respuesta' => 'Aceptamos pagos con tarjetas de crédito/débito (Visa, MasterCard, American Express), PayPal y transferencia bancaria. Todos los pagos se procesan de manera segura.'
    ],
    [
        'pregunta' => '¿Cuánto tiempo tarda en llegar mi pedido?',
        'respuesta' => 'El tiempo de entrega varía según tu ubicación. Generalmente, los envíos nacionales tardan entre 3-5 días hábiles. Para envíos internacionales, el tiempo estimado es de 7-14 días hábiles.'
    ],
    [
        'pregunta' => '¿Ofrecen envíos internacionales?',
        'respuesta' => 'Sí, realizamos envíos a varios países. Los costos y tiempos de entrega varían según el destino. Puedes verificar la disponibilidad durante el proceso de compra.'
    ],
    [
        'pregunta' => '¿Cuál es la política de devoluciones?',
        'respuesta' => 'Aceptamos devoluciones dentro de los 14 días siguientes a la recepción del producto. El producto debe estar sin abrir y en perfectas condiciones. Contacta con nuestro servicio de atención al cliente para iniciar el proceso.'
    ],
    [
        'pregunta' => '¿Tienen tienda física?',
        'respuesta' => 'Actualmente operamos exclusivamente online, aunque ocasionalmente participamos en ferias y eventos. Sigue nuestras redes sociales para estar al tanto de dónde puedes encontrarnos.'
    ],
    [
        'pregunta' => '¿Los vinos contienen alérgenos?',
        'respuesta' => 'Nuestros vinos contienen sulfitos, que son necesarios para la conservación. En la descripción de cada producto encontrarás información detallada sobre posibles alérgenos.'
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
$comentario_enviado = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comentario'])) {
    // En una implementación real, aquí procesarías y guardarías el comentario en la base de datos
    // Por ahora, simplemente mostraremos un mensaje de éxito
    $comentario_enviado = true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAVCANA - Contacto</title>
    <link rel="icon" href="../anexos/imagenes/havcanalogo.png">
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
                <p>+593 96 840 3024</p>
                <p>+593 98 765 4321</p>
            </div>
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>Dirección</h3>
                <p>Av. Principal 123</p>
                <p>Quito, Ecuador</p>
            </div>
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Horario</h3>
                <p>Lunes a Viernes: 9am - 6pm</p>
                <p>Fines de semana: 10am - 4pm</p>
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
            <div class="form-container">
                <h2>Envíanos un Mensaje</h2>
                <?php if ($mensaje_enviado): ?>
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i>
                        <p>¡Tu mensaje ha sido enviado con éxito! Nos pondremos en contacto contigo lo antes posible.</p>
                    </div>
                <?php else: ?>
                <form action="contactos.php" method="POST" class="contact-form">
                    <div class="form-group">
                        <label for="nombre">Nombre completo</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono (opcional)</label>
                        <input type="tel" id="telefono" name="telefono">
                    </div>
                    <div class="form-group">
                        <label for="asunto">Asunto</label>
                        <input type="text" id="asunto" name="asunto" required>
                    </div>
                    <div class="form-group">
                        <label for="mensaje">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" rows="6" required></textarea>
                    </div>
                    <button type="submit" name="submit_contacto" class="submit-btn">
                        Enviar Mensaje <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
                <?php endif; ?>
            </div>
            
            <div class="map-container">
                <h2>Nuestra Ubicación</h2>
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247959.12089384528!2d-78.5660211!3d-0.1865938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d59a4002427c9f%3A0x44b991e158ef5572!2sQuito%2C%20Ecuador!5e0!3m2!1ses!2sec!4v1624304037290!5m2!1ses!2sec" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
            <form action="contactos.php" method="POST" class="comments-form">
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

    <footer>
        <div class="whatsapp-button">
            <a href="https://wa.me/593968403024" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
                <span class="contact-text">Contacto Directo</span>
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </footer>

    <script src="../anexos/js/menu.js"></script>
    <script>
        function toggleFaq(index) {
            const answer = document.getElementById(`faq-answer-${index}`);
            const questions = document.querySelectorAll('.faq-question');
            const answers = document.querySelectorAll('.faq-answer');
            
            // Cerrar todas las respuestas excepto la actual
            for (let i = 0; i < answers.length; i++) {
                if (i !== index) {
                    answers[i].classList.remove('active');
                    questions[i].classList.remove('active');
                }
            }
            
            // Toggle la respuesta actual
            answer.classList.toggle('active');
            questions[index].classList.toggle('active');
        }
    </script>
</body>
</html>