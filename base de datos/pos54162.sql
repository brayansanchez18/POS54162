-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2021 a las 05:41:35
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pos54162`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(15, 'Adhesivo', '2021-12-01 03:30:25'),
(16, 'Reglas', '2021-12-01 03:30:51'),
(17, 'Hojas', '2021-12-01 03:31:04'),
(18, 'Libretas', '2021-12-01 03:31:15'),
(19, 'Cartulinas', '2021-12-01 03:31:24'),
(20, 'Lapices', '2021-12-01 03:31:41'),
(21, 'Boligrafos', '2021-12-01 03:32:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `compras` int(11) NOT NULL,
  `ultimaCompra` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `email`, `telefono`, `compras`, `ultimaCompra`, `fecha`) VALUES
(10, 'Emanuel Ramírez', 'bs6961204@gmail.com', '(+52) 729-592-4900', 4, '2021-11-30 22:11:25', '2021-12-01 04:11:25'),
(11, 'Brayan Sánchez', 'brayan.sanchez.contacto@gmail.om', '(+52) 729-592-4900', 4, '0000-00-00 00:00:00', '2021-12-01 04:39:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precioCompra` float NOT NULL,
  `precioVenta` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `idCategoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precioCompra`, `precioVenta`, `ventas`, `fecha`) VALUES
(67, 15, '1501', 'Papel Autoadherible Para Etiquetas', 'vistas/img/productos/1501/847.jpg', 98, 220, 308, 2, '2021-12-01 04:34:07'),
(68, 15, '1502', 'Rotulos Adhesivos en Colores', 'vistas/img/productos/1502/651.jpg', 99, 10, 14, 1, '2021-12-01 04:34:08'),
(69, 16, '1601', 'Juego de reglas metalicas', 'vistas/img/productos/1601/809.jpg', 99, 30, 42, 1, '2021-12-01 04:34:07'),
(70, 15, '1503', 'Barra Pritt', 'vistas/img/productos/1503/932.jpg', 98, 15, 21, 2, '2021-12-01 04:12:34'),
(71, 15, '1504', 'Postit 10 Pz', 'vistas/img/productos/1504/195.jpg', 99, 30, 42, 1, '2021-12-01 04:10:48'),
(72, 15, '1505', 'Notas adecivas', 'vistas/img/productos/1505/547.jpg', 98, 59, 82.6, 2, '2021-12-01 04:11:25'),
(73, 18, '1801', 'Registrador Tipo carta', 'vistas/img/productos/1801/847.jpg', 99, 1600, 2000, 1, '2021-12-01 04:11:25'),
(74, 18, '1802', 'Libreta profecional scribe', 'vistas/img/productos/1802/942.png', 99, 20, 28, 1, '2021-12-01 04:11:25'),
(75, 17, '1701', 'Rollo de papel termico 80x80 blanco', 'vistas/img/productos/1701/386.jpg', 100, 50, 70, 0, '2021-12-01 03:56:31'),
(76, 18, '1803', 'Libreta tipo Moleskine de poliuretano', 'vistas/img/productos/1803/597.jpg', 100, 100, 140, 0, '2021-12-01 03:57:30'),
(77, 18, '1804', 'Carpeta planner A6', 'vistas/img/productos/1804/589.jpg', 100, 145, 203, 0, '2021-12-01 03:58:56'),
(78, 18, '1805', 'Cuaderno profecional de doble aro', 'vistas/img/productos/1805/400.jpg', 100, 33, 46.2, 0, '2021-12-01 03:59:56'),
(79, 18, '1806', 'Libreta de piel cuaderno de bolsillo', 'vistas/img/productos/1806/586.jpg', 100, 110, 154, 0, '2021-12-01 04:00:59'),
(80, 18, '1807', 'Cuaderno inteligente', 'vistas/img/productos/1807/601.jpg', 100, 300, 420, 0, '2021-12-01 04:02:11'),
(81, 18, '1808', 'Cuaderno de dibujo canson', 'vistas/img/productos/1808/330.jpg', 100, 150, 210, 0, '2021-12-01 04:03:40'),
(82, 21, '2101', 'Plumones punta pincel 48 colores', 'vistas/img/productos/2101/634.jpg', 100, 180, 252, 0, '2021-12-01 04:04:37'),
(83, 21, '2102', 'Boligrafo bic', 'vistas/img/productos/2102/354.jpg', 100, 8, 11.2, 0, '2021-12-01 04:05:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `pass` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimologin` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `pass`, `perfil`, `foto`, `estado`, `ultimologin`, `fecha`) VALUES
(1, 'Usuario Administrador', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 'vistas/img/usuarios/admin/303.png', 1, '2021-11-30 22:19:51', '2021-12-01 04:19:51'),
(22, 'Usuario especial', 'especial', '$2a$07$asxx54ahjppf45sd87a5auf9Eiqdn10E7o/jsGFivN12XE.wRwyp6', 'Especial', '', 1, '0000-00-00 00:00:00', '2021-12-01 03:21:20'),
(23, 'Usuario Vendedor', 'vendedor', '$2a$07$asxx54ahjppf45sd87a5auF3SxTPxKrykQWP2opioJ/PI/QjcniEW', 'Vendedor', '', 1, '0000-00-00 00:00:00', '2021-12-01 03:22:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idVendedor` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodoPago` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `idCliente`, `idVendedor`, `productos`, `impuesto`, `neto`, `total`, `metodoPago`, `fecha`) VALUES
(12, 10001, 11, 1, '[{\"id\":\"68\",\"descripcion\":\"Rotulos Adhesivos en Colores\",\"cantidad\":\"1\",\"stock\":\"99\",\"precio\":\"14\",\"total\":\"14\"},{\"id\":\"70\",\"descripcion\":\"Barra Pritt\",\"cantidad\":\"1\",\"stock\":\"99\",\"precio\":\"21\",\"total\":\"21\"},{\"id\":\"71\",\"descripcion\":\"Postit 10 Pz\",\"cantidad\":\"1\",\"stock\":\"99\",\"precio\":\"42\",\"total\":\"42\"}]', 15.4, 77, 92.4, 'Efectivo', '2021-08-31 03:35:48'),
(13, 10002, 10, 1, '[{\"id\":\"74\",\"descripcion\":\"Libreta profecional scribe\",\"cantidad\":\"1\",\"stock\":\"99\",\"precio\":\"28\",\"total\":\"28\"},{\"id\":\"73\",\"descripcion\":\"Registrador Tipo carta\",\"cantidad\":\"1\",\"stock\":\"99\",\"precio\":\"2000\",\"total\":\"2000\"},{\"id\":\"72\",\"descripcion\":\"Notas adecivas\",\"cantidad\":\"2\",\"stock\":\"98\",\"precio\":\"82.6\",\"total\":\"165.2\"}]', 438.64, 2193.2, 2631.84, 'TC-123456789', '2021-10-01 03:11:25'),
(14, 10003, 11, 1, '[{\"id\":\"69\",\"descripcion\":\"Juego de reglas metalicas\",\"cantidad\":\"1\",\"stock\":\"99\",\"precio\":\"42\",\"total\":\"42\"}]', 4.2, 42, 46.2, 'Efectivo', '2021-10-31 03:35:52'),
(15, 10004, 11, 1, '[{\"id\":\"67\",\"descripcion\":\"Papel Autoadherible Para Etiquetas\",\"cantidad\":\"2\",\"stock\":\"98\",\"precio\":\"308\",\"total\":\"616\"},{\"id\":\"70\",\"descripcion\":\"Barra Pritt\",\"cantidad\":\"1\",\"stock\":\"98\",\"precio\":\"21\",\"total\":\"21\"}]', 127.4, 637, 764.4, 'Efectivo', '2021-12-01 04:39:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
