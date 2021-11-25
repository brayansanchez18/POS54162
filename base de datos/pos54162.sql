-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2021 a las 01:39:40
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
(1, 'Equipos Electromecanicos', '2021-03-27 19:42:24'),
(2, 'Taladros', '2021-03-27 19:23:47'),
(3, 'Andamios', '2021-03-27 19:24:07'),
(4, 'Generadores de energía', '2021-03-27 19:24:23'),
(5, 'Equipos para construcción', '2021-03-27 19:24:45'),
(7, 'Martillos mecánicos', '2021-03-27 19:48:02'),
(8, 'Herreria', '2021-04-16 03:14:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `compras` int(11) NOT NULL,
  `ultimaCompra` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `documento`, `email`, `telefono`, `direccion`, `fechaNacimiento`, `compras`, `ultimaCompra`, `fecha`) VALUES
(1, 'Juan Villegas', 2147483647, 'juan@hotmail.com', '(300) 341-2345', 'Calle 23 # 45 - 56', '1980-11-02', 7, '2021-04-14 17:39:19', '2021-04-14 22:39:19'),
(3, 'Miguel Murillo Prez', 325235235, 'miguel@gmail.com', '(+52) 722-126-5399', 'calle 34 # 34 - 23', '1998-09-05', 10, '2021-04-15 15:30:17', '2021-04-16 03:18:35'),
(4, 'Victor Gabriel', 1234567, 'vg@gmail.com', '(+52) 722-123-5699', 'AV. chapultepec #10', '2001-10-12', 3, '2021-04-15 16:57:24', '2021-04-15 21:57:24'),
(5, 'Michelle Sandoval', 2147483647, 'michelle@cliente.com', '(+52) 722-883-8661', 'AV. chapultepec #10', '2001-12-10', 0, '0000-00-00 00:00:00', '2021-04-16 03:16:47');

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
(1, 1, '101', 'Aspiradora Industrial 2', 'vistas/img/productos/101/660.png', 18, 90000, 126000, 6, '2021-04-16 03:18:34'),
(2, 1, '102', 'Plato Flotante para Allanadora', 'vistas/img/productos/102/489.jpg', 17, 4500, 6300, 2, '2021-04-16 03:18:34'),
(3, 1, '103', 'Compresor de Aire para pintura', 'vistas/img/productos/103/642.jpg', 24, 3000, 4200, -3, '2021-04-16 03:18:34'),
(4, 1, '104', 'Cortadora de Adobe sin Disco ', 'vistas/img/productos/104/274.jpg', 25, 4000, 5600, -5, '2021-04-14 22:39:19'),
(5, 1, '105', 'Cortadora de Piso sin Disco ', 'vistas/img/productos/105/363.jpg', 9, 1540, 2156, 11, '2021-04-15 21:57:24'),
(6, 1, '106', 'Disco Punta Diamante ', 'vistas/img/productos/106/686.jpg', 19, 1100, 1540, 1, '2021-04-14 22:39:19'),
(7, 1, '107', 'Extractor de Aire ', 'vistas/img/productos/107/133.jpg', 20, 1540, 2156, 2, '2021-04-15 20:30:17'),
(8, 1, '108', 'Guadañadora ', 'vistas/img/productos/108/882.jpg', 19, 1540, 2156, 1, '2021-04-15 20:30:17'),
(9, 1, '109', 'Hidrolavadora Eléctrica ', 'vistas/img/productos/109/467.jpg', 20, 2600, 3640, 0, '2021-03-29 00:58:24'),
(10, 1, '110', 'Hidrolavadora Gasolina', 'vistas/img/productos/110/566.jpg', 22, 2210, 3094, -2, '2021-04-14 21:38:53'),
(11, 1, '111', 'Motobomba a Gasolina', 'vistas/img/productos/111/724.jpg', 20, 2860, 4004, 0, '2021-03-29 01:02:26'),
(12, 1, '112', 'Motobomba El?ctrica', '', 20, 2400, 3360, 0, '2021-03-27 23:32:02'),
(13, 1, '113', 'Sierra Circular ', '', 20, 1100, 1540, 0, '2021-03-27 23:32:02'),
(14, 1, '114', 'Disco de tugsteno para Sierra circular', '', 20, 4500, 6300, 0, '2021-03-27 23:32:02'),
(15, 1, '115', 'Soldador Electrico ', '', 20, 1980, 2772, 0, '2021-03-27 23:32:02'),
(16, 1, '116', 'Careta para Soldador', '', 20, 4200, 5880, 0, '2021-03-27 23:32:02'),
(17, 1, '117', 'Torre de iluminacion ', '', 20, 1800, 2520, 0, '2021-03-27 23:32:02'),
(18, 2, '201', 'Martillo Demoledor de Piso 110V', '', 20, 5600, 7840, 0, '2021-03-27 23:32:02'),
(19, 2, '202', 'Muela o cincel martillo demoledor piso', '', 20, 9600, 13440, 0, '2021-03-27 23:32:02'),
(20, 2, '203', 'Taladro Demoledor de muro 110V', '', 20, 3850, 5390, 0, '2021-03-27 23:32:02'),
(21, 2, '204', 'Muela o cincel martillo demoledor muro', '', 20, 9600, 13440, 0, '2021-03-27 23:32:02'),
(22, 2, '205', 'Taladro Percutor de 1/2 Madera y Metal', '', 20, 8000, 11200, 0, '2021-03-28 04:33:20'),
(23, 2, '206', 'Taladro Percutor SDS Plus 110V', '', 20, 3900, 5460, 0, '2021-03-27 23:32:02'),
(24, 2, '207', 'Taladro Percutor SDS Max 110V (Mineria)', '', 20, 4600, 6440, 0, '2021-03-27 23:32:02'),
(25, 3, '301', 'Andamio colgante', '', 20, 1440, 2016, 0, '2021-03-27 23:32:02'),
(26, 3, '302', 'Distanciador andamio colgante', '', 20, 1600, 2240, 0, '2021-03-27 23:32:02'),
(27, 3, '303', 'Marco andamio modular ', '', 20, 900, 1260, 0, '2021-03-27 23:32:02'),
(28, 3, '304', 'Marco andamio tijera', '', 20, 100, 140, 0, '2021-03-27 23:32:02'),
(29, 3, '305', 'Tijera para andamio', '', 20, 162, 226, 0, '2021-03-27 23:32:02'),
(30, 3, '306', 'Escalera interna para andamio', '', 20, 270, 378, 0, '2021-03-27 23:32:02'),
(31, 3, '307', 'Pasamanos de seguridad', '', 20, 75, 105, 0, '2021-03-27 23:32:02'),
(32, 3, '308', 'Rueda giratoria para andamio', '', 20, 168, 235, 0, '2021-03-27 23:32:02'),
(33, 3, '309', 'Arnes de seguridad', '', 20, 1750, 2450, 0, '2021-03-27 23:32:02'),
(34, 3, '310', 'Eslinga para arnes', '', 20, 175, 245, 0, '2021-03-27 23:32:02'),
(35, 3, '311', 'Plataforma Met?lica', '', 20, 420, 588, 0, '2021-03-27 23:32:02'),
(36, 4, '401', 'Planta Electrica Diesel 6 Kva', '', 20, 3500, 4900, 0, '2021-03-27 23:32:02'),
(37, 4, '402', 'Planta Electrica Diesel 10 Kva', '', 20, 3550, 4970, 0, '2021-03-27 23:32:02'),
(38, 4, '403', 'Planta Electrica Diesel 20 Kva', '', 20, 3600, 5040, 0, '2021-03-27 23:32:02'),
(39, 4, '404', 'Planta Electrica Diesel 30 Kva', '', 20, 3650, 5110, 0, '2021-03-27 23:32:02'),
(40, 4, '405', 'Planta Electrica Diesel 60 Kva', '', 20, 3700, 5180, 0, '2021-03-27 23:32:02'),
(41, 4, '406', 'Planta Electrica Diesel 75 Kva', '', 20, 3750, 5250, 0, '2021-03-27 23:32:02'),
(42, 4, '407', 'Planta Electrica Diesel 100 Kva', '', 20, 3800, 5320, 0, '2021-03-27 23:32:02'),
(43, 4, '408', 'Planta Electrica Diesel 120 Kva', '', 20, 3850, 5390, 0, '2021-03-27 23:32:02'),
(44, 5, '501', 'Escalera de Tijera Aluminio ', '', 20, 350, 490, 0, '2021-03-27 23:32:02'),
(45, 5, '502', 'Extension Electrica ', '', 20, 370, 518, 0, '2021-03-27 23:32:02'),
(46, 5, '503', 'Gato tensor', '', 20, 380, 532, 0, '2021-03-27 23:32:02'),
(47, 5, '504', 'Lamina Cubre Brecha ', '', 20, 380, 532, 0, '2021-03-27 23:32:02'),
(48, 5, '505', 'Llave de Tubo', '', 20, 480, 672, 0, '2021-03-27 23:32:02'),
(49, 5, '506', 'Manila por Metro', '', 20, 600, 840, 0, '2021-03-27 23:32:02'),
(50, 5, '507', 'Polea 2 canales', '', 20, 900, 1260, 0, '2021-03-27 23:32:02'),
(51, 5, '508', 'Tensor', '', 20, 100, 140, 0, '2021-03-27 23:32:02'),
(52, 5, '509', 'Bascula ', '', 20, 130, 182, 0, '2021-03-27 23:32:02'),
(53, 5, '510', 'Bomba Hidrostatica', '', 20, 770, 1078, 0, '2021-03-27 23:32:02'),
(54, 5, '511', 'Chapeta', '', 20, 660, 924, 0, '2021-03-27 23:32:02'),
(55, 5, '512', 'Cilindro muestra de concreto', '', 20, 400, 560, 0, '2021-03-27 23:32:02'),
(56, 5, '513', 'Cizalla de Palanca', '', 20, 450, 630, 0, '2021-03-27 23:32:02'),
(57, 5, '514', 'Cizalla de Tijera', '', 20, 580, 812, 0, '2021-03-27 23:32:02'),
(58, 5, '515', 'Coche llanta neumatica', '', 20, 420, 588, 0, '2021-03-27 23:32:02'),
(59, 5, '516', 'Cono slump', '', 20, 140, 196, 0, '2021-03-27 23:32:02'),
(60, 5, '517', 'Cortadora de Baldosin', '', 20, 930, 1302, 0, '2021-03-27 23:32:02'),
(61, 2, '208', 'taladro truper', '', 400, 500, 845, 0, '2021-03-28 21:58:18'),
(63, 2, '209', 'taladro de piso', 'vistas/img/productos/209/245.jpg', 234, 1450, 2175, 0, '2021-04-16 03:17:41');

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
(1, 'Brayan Sánchez', 'admin', '$2a$07$asxx54ahjppf45sd87a5auBxWKi32TyN7LTmhz0ONBYdcwSQJ0lWO', 'Administrador', 'vistas/img/usuarios/admin/303.png', 1, '2021-11-24 18:36:58', '2021-11-25 00:36:58'),
(8, 'Sandra Gomez', 'sandra_gomez@tuempresa.com', '$2a$07$asxx54ahjppf45sd87a5auBxWKi32TyN7LTmhz0ONBYdcwSQJ0lWO', 'Vendedor', 'vistas/img/usuarios/sandra_gomez@tuempresa.com/615.jpg', 1, '2021-04-09 16:15:26', '2021-04-09 21:15:26'),
(9, 'Pedro Faro', 'pedro@tuempresa.com', '$2a$07$asxx54ahjppf45sd87a5auBxWKi32TyN7LTmhz0ONBYdcwSQJ0lWO', 'Especial', 'vistas/img/usuarios/pedro@tuempresa.com/625.png', 1, '2021-04-15 16:51:38', '2021-04-16 03:14:51'),
(11, 'Diana Alvarez', 'diana@tuempresa.com', '$2a$07$asxx54ahjppf45sd87a5auBxWKi32TyN7LTmhz0ONBYdcwSQJ0lWO', 'Vendedor', 'vistas/img/usuarios/diana@tuempresa.com/668.jpg', 1, '0000-00-00 00:00:00', '2021-04-16 03:13:37'),
(17, 'prueba1', 'prueba1', '$2a$07$asxx54ahjppf45sd87a5au6PuqDRoOBLeXILXpnaEE70C01YRVVRG', 'Administrador', '', 0, '0000-00-00 00:00:00', '2021-11-24 21:56:15'),
(18, 'jasdfasdfj', 'jasdfjajsdf', '$2a$07$asxx54ahjppf45sd87a5au/MQ47ARjlq30LFCJZtxw7D0aAbAhe1e', 'Administrador', 'vistas/img/usuarios/jasdfjajsdf/681.png', 0, '0000-00-00 00:00:00', '2021-11-24 22:05:38'),
(19, 'prueba2', 'prueba2', '$2a$07$asxx54ahjppf45sd87a5auHZPYySdWSMpJQy0/17lrojl4DUlQYIi', 'Vendedor', 'vistas/img/usuarios/prueba2/431.jpg', 0, '0000-00-00 00:00:00', '2021-11-24 22:48:08'),
(20, 'prueba3', 'prueba3', '$2a$07$asxx54ahjppf45sd87a5auVUDFPOy15axdxpDQ0Kv0SDEzrcPrv.i', 'Especial', 'vistas/img/usuarios/prueba3/886.jpg', 0, '0000-00-00 00:00:00', '2021-11-24 23:06:16');

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
(2, 10002, 3, 1, '[{\"id\":\"1\",\"descripcion\":\"Aspiradora Industrial 2\",\"cantidad\":\"4\",\"stock\":\"18\",\"precio\":\"126000\",\"total\":\"504000\"},{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"2\",\"stock\":\"24\",\"precio\":\"4200\",\"total\":\"8400\"},{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"2\",\"stock\":\"17\",\"precio\":\"6300\",\"total\":\"12600\"}]', 0, 520800, 677040, 'TC-1234567', '2021-04-16 03:18:51'),
(3, 10002, 3, 1, '[{\"id\":\"1\",\"descripcion\":\"Aspiradora Industrial 2\",\"cantidad\":\"4\",\"stock\":\"18\",\"precio\":\"126000\",\"total\":\"504000\"},{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"2\",\"stock\":\"24\",\"precio\":\"4200\",\"total\":\"8400\"},{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"2\",\"stock\":\"17\",\"precio\":\"6300\",\"total\":\"12600\"}]', 0, 520800, 677040, 'TC-1234567', '2021-04-16 03:18:51'),
(4, 10003, 4, 1, '[{\"id\":\"7\",\"descripcion\":\"Extractor de Aire \",\"cantidad\":\"2\",\"stock\":\"17\",\"precio\":\"2156\",\"total\":\"4312\"},{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"4200\",\"total\":\"4200\"},{\"id\":\"4\",\"descripcion\":\"Cortadora de Adobe sin Disco \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"5600\",\"total\":\"5600\"}]', 4233.6, 14112, 18345.6, 'Efectivo', '2021-02-09 22:14:14'),
(6, 10004, 1, 8, '[{\"id\":\"1\",\"descripcion\":\"Aspiradora Industrial 2\",\"cantidad\":\"1\",\"stock\":\"21\",\"precio\":\"126000\",\"total\":\"126000\"},{\"id\":\"6\",\"descripcion\":\"Disco Punta Diamante \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"1540\",\"total\":\"1540\"},{\"id\":\"5\",\"descripcion\":\"Cortadora de Piso sin Disco \",\"cantidad\":\"1\",\"stock\":\"33\",\"precio\":\"2156\",\"total\":\"2156\"},{\"id\":\"4\",\"descripcion\":\"Cortadora de Adobe sin Disco \",\"cantidad\":\"1\",\"stock\":\"25\",\"precio\":\"5600\",\"total\":\"5600\"}]', 46000.6, 135296, 181297, 'TC-123456789', '2021-02-14 23:39:19'),
(7, 10005, 3, 8, '[{\"id\":\"8\",\"descripcion\":\"Guadañadora \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"2156\",\"total\":\"2156\"},{\"id\":\"7\",\"descripcion\":\"Extractor de Aire \",\"cantidad\":\"1\",\"stock\":\"20\",\"precio\":\"2156\",\"total\":\"2156\"}]', 1293.6, 4312, 5605.6, 'Efectivo', '2021-03-15 21:30:17'),
(8, 10006, 4, 1, '[{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"1\",\"stock\":\"25\",\"precio\":\"4200\",\"total\":\"4200\"},{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"1\",\"stock\":\"22\",\"precio\":\"6300\",\"total\":\"6300\"},{\"id\":\"1\",\"descripcion\":\"Aspiradora Industrial 2\",\"cantidad\":\"1\",\"stock\":\"20\",\"precio\":\"126000\",\"total\":\"126000\"}]', 54600, 136500, 191100, 'TC-123456789', '2021-04-15 21:56:43'),
(9, 10007, 4, 1, '[{\"id\":\"5\",\"descripcion\":\"Cortadora de Piso sin Disco \",\"cantidad\":\"24\",\"stock\":\"9\",\"precio\":\"2156\",\"total\":\"51744\"}]', 15523.2, 51744, 67267.2, 'TD-1234567890', '2021-04-15 21:57:24');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
