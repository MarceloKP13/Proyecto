-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-03-2025 a las 07:16:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `havcana_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `comentario` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `numero_pedido` varchar(50) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `subtotal` decimal(10,2) NOT NULL,
  `envio` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` varchar(20) DEFAULT 'pendiente' CHECK (`estado` in ('pendiente','completado','eliminado'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `numero_pedido`, `usuario_id`, `fecha_pedido`, `subtotal`, `envio`, `total`, `estado`) VALUES
(1, '#19032025001', 2, '2025-03-19 04:31:08', 14.98, 5.00, 19.98, 'realizado'),
(2, '#19032025002', 2, '2025-03-19 04:31:13', 14.98, 5.00, 19.98, 'realizado'),
(3, '#19032025003', 2, '2025-03-19 04:34:41', 14.98, 5.00, 19.98, 'pendiente'),
(4, '#19032025004', 2, '2025-03-19 04:36:49', 4.99, 5.00, 9.99, 'pendiente'),
(5, '#19032025005', 2, '2025-03-19 04:40:43', 9.99, 5.00, 14.99, 'realizado'),
(6, '#19032025006', 2, '2025-03-19 04:41:10', 9.99, 5.00, 14.99, 'pendiente'),
(7, '#19032025007', 2, '2025-03-19 04:42:00', 14.98, 5.00, 19.98, 'realizado'),
(8, '#19032025008', 3, '2025-03-19 04:44:29', 4.99, 5.00, 9.99, 'realizado'),
(9, '#19032025009', 2, '2025-03-19 04:44:58', 9.99, 5.00, 14.99, 'realizado'),
(10, '#19032025010', 2, '2025-03-19 05:38:57', 29.97, 5.00, 34.97, 'pendiente'),
(11, '#19032025011', 2, '2025-03-19 05:43:12', 39.94, 5.00, 44.94, 'pendiente'),
(12, '#19032025012', 2, '2025-03-19 06:05:33', 19.98, 5.00, 24.98, 'pendiente'),
(13, '#19032025013', 2, '2025-03-19 06:06:45', 9.99, 5.00, 14.99, 'pendiente'),
(14, '#19032025014', 2, '2025-03-19 06:11:14', 9.99, 5.00, 14.99, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `maridaje` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `maridaje`, `precio`, `imagen`) VALUES
(1, 'Vino de Pepiche', 'Sabor exótico y refrescante\r\n¡Recuerda! Por compra de 12 unidades (1 caja), el precio por unidad baja a $7,75 ', 'Marida bien con mariscos y ensaladas', 9.99, '../anexos/imagenes/pepiche.jpg'),
(2, 'Vino de Manzana', 'Dulce y aromático con notas frutales\r\n¡Recuerda! Por compra de 12 unidades (1 caja), el precio por unidad baja a $3,85 ', 'Ideal para postres y quesos suaves', 4.99, '../anexos/imagenes/manzana.jpg'),
(3, 'Vino de Uva Caimorona', 'Sabor intenso y aterciopelado\r\n¡Recuerda! Por compra de 12 unidades (1 caja), el precio por unidad baja a $7,75 ', 'Perfecto para carnes rojas y quesos curados', 9.99, '../anexos/imagenes/uvacaimorona.jpg'),
(4, 'Vino de Uvilla', 'Equilibrado y ligeramente ácido/dulce\r\n¡Recuerda! Por compra de 12 unidades (1 caja), el precio por unidad baja a $7,75 ', 'Acompaña bien pescados y comidas ligeras', 9.99, '../anexos/imagenes/uvilla.jpg'),
(5, 'Vino Flor y Uva', 'Delicado bouquet floral y frutal\r\n¡Recuerda! Por compra de 12 unidades (1 caja), el precio por unidad baja a $7,75 ', 'Marida con platos frescos y postres', 9.99, '../anexos/imagenes/floryuva.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(150) NOT NULL,
  `es_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `correo`, `usuario`, `contrasena`, `es_admin`) VALUES
(1, 'Kevin ', 'kevin@gmail.com', 'Kevin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 0),
(2, 'Marcelo Torres', 'kevin.torres85@outlook.es', 'MarceloKP13', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 0),
(3, 'Jhoel Mariño', 'jhoel@admin.com', 'Jhoel', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1),
(4, 'Marcelo', 'marce@admin.com', 'Marce', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1),
(5, 'Prueba85', 'prueba85@gmail.com', 'Prueba85', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
