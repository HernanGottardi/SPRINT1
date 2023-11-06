-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2023 a las 20:55:49
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `descripcion`) VALUES
(9, 'Cocina'),
(10, 'Barra tragos'),
(11, 'Barra chopera'),
(12, 'Candy Bar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `Id` int(11) NOT NULL,
  `Id_area` int(11) DEFAULT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Fecha_inicio` date NOT NULL,
  `Fecha_fin` date DEFAULT NULL,
  `Id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`Id`, `Id_area`, `Nombre`, `Fecha_inicio`, `Fecha_fin`, `Id_usuario`) VALUES
(21, 1, 'Athena', '2021-11-27', '0000-00-00', 10),
(22, 1, 'Persefone', '2021-11-27', '0000-00-00', 11),
(23, 1, 'Hera', '2021-11-27', '0000-00-00', 12),
(24, 2, 'Hades', '2021-11-27', '0000-00-00', 13),
(25, 2, 'Zeus', '2021-11-27', '0000-00-00', 14),
(26, 2, 'Odin', '2021-11-27', '0000-00-00', 15),
(27, 3, 'Poseidon', '2021-11-27', '0000-00-00', 16),
(28, 3, 'Wukong', '2021-11-27', '0000-00-00', 17),
(29, 4, 'Facu Falcone', '2021-11-27', '0000-00-00', 18),
(30, 3, 'Lilith', '2021-11-28', '0000-00-00', 19),
(31, 9, 'Hernan', '2023-12-31', NULL, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id` int(11) NOT NULL,
  `codigo_mesa` varchar(5) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id`, `codigo_mesa`, `id_empleado`, `estado`) VALUES
(64, 'ME002', 21, 'Con Cliente Esperando Pedido'),
(65, 'ME003', 22, 'Con Cliente Pagando'),
(66, 'ME004', 23, 'Cerrada'),
(67, 'ME005', NULL, 'Cerrada'),
(68, 'ME006', NULL, 'Cerrada'),
(69, 'ME008', NULL, 'Cerrada'),
(70, 'ME009', NULL, 'Cerrada'),
(71, 'ME010', NULL, 'Cerrada'),
(72, 'ME011', NULL, 'Cerrada'),
(73, 'ME012', 22, 'Con Cliente Esperando Pedido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `id_mesa` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(50) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `costo` float NOT NULL DEFAULT 0,
  `estado` varchar(50) NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `id_mesa`, `nombre_cliente`, `imagen`, `costo`, `estado`) VALUES
(1, 64, 'Fulano_01', './OrderImages/8.png', 3100, 'En Preparacion'),
(2, 64, 'Fulano_02', './OrderImages/9.png', 600, 'En Preparacion'),
(3, 64, 'Fulano_03', './OrderImages/10.png', 1150, 'Listo Para Servir'),
(4, 68, 'Fulano_04', './OrderImages/11.png', 1550, 'Listo Para Servir'),
(5, 69, 'Fulano_05', './OrderImages/Order_12.png', 0, 'Pendiente'),
(6, 65, 'Alfredito', './OrderImages/8.png', 45345, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Id` int(11) NOT NULL,
  `area_producto` int(20) NOT NULL,
  `pedido_asociado` int(20) DEFAULT NULL,
  `estado` varchar(30) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `costo` float NOT NULL,
  `tiempo_desde` datetime NOT NULL,
  `tiempo_hasta` datetime DEFAULT NULL,
  `duracion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Id`, `area_producto`, `pedido_asociado`, `estado`, `descripcion`, `costo`, `tiempo_desde`, `tiempo_hasta`, `duracion`) VALUES
(10, 2, 1, 'Listo Para Servir', 'Pollo Al Champignon', 550, '2021-11-27 02:50:33', '2021-11-27 03:20:33', '0000-00-00 00:00:00'),
(11, 3, 1, 'Listo Para Servir', 'Gaseosa Linea Pepsi 2lt.', 300, '2021-11-27 02:51:24', '2021-11-27 02:56:24', '0000-00-00 00:00:00'),
(12, 3, 1, 'Listo Para Servir', 'Gaseosa Linea Pepsi 2lt.', 300, '2021-11-27 03:05:14', '2021-11-27 03:10:14', '0000-00-00 00:00:00'),
(13, 3, 1, 'Listo Para Servir', 'Gaseosa Linea Pepsi 2lt.', 300, '2021-11-27 03:05:51', '2021-11-27 03:10:51', '0000-00-00 00:00:00'),
(14, 2, 1, 'Listo Para Servir', 'Hamburguesa con Bacon', 550, '2021-11-27 03:06:59', '2021-11-27 03:26:59', '0000-00-00 00:00:00'),
(15, 2, 1, 'Listo Para Servir', 'Hamburguesa con Cheddar y Guarnicion', 550, '2021-11-27 03:09:14', '2021-11-27 03:27:14', '0000-00-00 00:00:00'),
(16, 2, 1, 'Listo Para Servir', 'Ensalada Waldorf', 550, '2021-11-27 03:10:27', '2021-11-27 03:17:27', '0000-00-00 00:00:00'),
(17, 2, 2, 'Listo Para Servir', 'Ensalada Waldorf', 350, '2021-11-27 11:54:41', '2021-11-27 12:01:41', '0000-00-00 00:00:00'),
(18, 2, 2, 'Listo Para Servir', 'Ensalada Rusa', 250, '2021-11-27 11:55:24', '2021-11-27 12:03:24', '0000-00-00 00:00:00'),
(19, 2, 3, 'Listo Para Servir', 'Pollo al Champignon', 450, '2021-11-28 00:16:04', '2021-11-28 00:36:04', '0000-00-00 00:00:00'),
(20, 2, 3, 'Listo Para Servir', 'Pollo al Verdeo', 400, '2021-11-28 00:16:29', '2021-11-28 00:38:29', '0000-00-00 00:00:00'),
(21, 3, 3, 'Listo Para Servir', 'Cerveza Stella Artois 1lt.', 300, '2021-11-28 00:17:06', '2021-11-28 00:22:06', '0000-00-00 00:00:00'),
(22, 3, 4, 'Listo Para Servir', 'Cerveza Stella Artois 1lt.', 300, '2021-11-28 20:01:14', '2021-11-28 20:06:14', '0000-00-00 00:00:00'),
(23, 3, 4, 'Listo Para Servir', 'Cerveza Rabieta Irish Ale 750ml.', 300, '2021-11-28 20:01:46', '2021-11-28 20:08:46', '0000-00-00 00:00:00'),
(24, 2, 4, 'Listo Para Servir', 'Papas bravas', 450, '2021-11-28 20:02:07', '2021-11-28 20:27:07', '0000-00-00 00:00:00'),
(25, 2, 4, 'Listo Para Servir', 'Papas con Cheddar & Bacon', 500, '2021-11-28 20:02:29', '2021-11-28 20:32:29', '0000-00-00 00:00:00'),
(26, 9, 1, 'Listo Para Servir', 'Pollo Al Champignon', 12345700, '2021-11-27 03:20:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre_usuario` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `esAdmin` int(11) NOT NULL,
  `tipo_usuario` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `fecha_inicio` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `fecha_fin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre_usuario`, `contraseña`, `esAdmin`, `tipo_usuario`, `estado`, `fecha_inicio`, `id`, `fecha_fin`) VALUES
('Facu', '$2y$10$YC33xVvmADBUIczUmSShY.hkCB7pLh5ksH.COU7loi2', 1, 'Admin', 'Active', '2021-11-27 00:32:31', 10, NULL),
('C1', '$2y$10$3bG3uAu2AJ7VnMcM08IBcu3kLehg9t6YjWBAQ/j6FeL', 0, 'Camarera', 'Active', '2021-11-27 01:31:07', 11, NULL),
('C2', '$2y$10$yT74CCOm7isBvu19UvpP.uXCyy3rTYqLw5mNH4AYb.u', 0, 'Camarera', 'Active', '2021-11-27 01:31:15', 12, NULL),
('C3', '$2y$10$izib3ooG60BV9VhfVWEpnuk67M3EzAz/yboSaGlq4tv', 0, 'Camarera', 'Active', '2021-11-27 01:31:19', 13, NULL),
('Co1', '$2y$10$CnSjF.0SF2FHYhxXKzjrsuZbWZzS4CrQ.kin1GhgDpH', 0, 'Cocinero', 'Active', '2021-11-27 01:31:32', 14, NULL),
('Co2', '$2y$10$QLr2gkRy4rB6rYkRT/lUye4WUv.iCkSr2Bm4gcDFrYF', 0, 'Cocinero', 'Active', '2021-11-27 01:31:41', 15, NULL),
('Co3', '$2y$10$JxpnNeff2MzRNzrX/LfoRu7U/A8GzU7CEdrF3E8KCFy', 0, 'Cocinero', 'Active', '2021-11-27 01:31:47', 16, NULL),
('Bar1', '$2y$10$/jvBeHcBsJXiVqno25eAx.kePekvRQrqDjTOmY8Yd3w', 0, 'Barman', 'Active', '2021-11-27 01:32:01', 17, NULL),
('Bar2', '$2y$10$M9DS08Vxs0MR2OdjL1OIxuYcDCOIOffGzdDk3AHS3cm', 0, 'Barman', 'Active', '2021-11-27 01:32:05', 18, NULL),
('Bar3', '$2y$10$6CYGTBDQ6a3migWWTYHqtuMWIIF7P4NHfOAddeaPvAl', 0, 'Barman', 'Active', '2021-11-28 19:36:36', 19, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_mesa` (`codigo_mesa`),
  ADD KEY `FK_id_empleado` (`id_empleado`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_mesa_pedido` (`id_mesa`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_pedido_asociado` (`pedido_asociado`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD CONSTRAINT `FK_id_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`Id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `FK_mesa_pedido` FOREIGN KEY (`id_mesa`) REFERENCES `mesa` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_pedido_asociado` FOREIGN KEY (`pedido_asociado`) REFERENCES `pedido` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
