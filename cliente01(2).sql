-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2023 a las 21:09:57
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cliente01`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `rol` int(1) NOT NULL,
  `archivo_n` varchar(255) NOT NULL,
  `archivo` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `rol`, `archivo_n`, `archivo`, `status`, `eliminado`) VALUES
(6, 'cecilia', 'flores', 'ceci@gmail.com', 'c378985d629e99a4e86213db0cd5e70d', 1, '', '', 1, 0),
(7, 'uriel', 'estrada', 'uriel@gmail.com', '65f9fabdbce88dd0a4c08a55b4912b46', 2, '', '', 1, 1),
(8, 'Eduardo', 'Pérez', 'edu@gmail.com', 'c378985d629e99a4e86213db0cd5e70d', 1, 'good.jpg', '7c93dfc1e32716cda9fb4ba3161baaee.jpg', 1, 0),
(9, 'Luis', 'Robles', 'luisrob@gmail.com', 'd8a4596371c8da8b111bc17fb9f2065d', 2, '', '', 1, 0),
(10, 'Abraham', 'Flores', 'abraham@gmail.com', 'ece82d239f8125dbfd9b22d9f8e96b82', 1, '', '', 1, 0),
(11, 'Pablo', 'Flores', 'tonio@gmail.com', '011c09c5e898e93a2bab432971713cec', 1, 'good.jpg', '7c93dfc1e32716cda9fb4ba3161baaee.jpg', 1, 0),
(12, 'Karen', 'Topete', 'keila@gmail.com', '011c09c5e898e93a2bab432971713cec', 1, 'unnamed.jpg', '0c0985200ec734550770cc05be67c395.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `archivo` varchar(64) NOT NULL,
  `status` int(1) DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `banners`
--

INSERT INTO `banners` (`id`, `nombre`, `archivo`, `status`, `eliminado`) VALUES
(1, 'Oferta2', 'cc8d08c1920ee1f1feee0a8f805139b7.png', 1, 1),
(2, 'Oferta01', 'cc8d08c1920ee1f1feee0a8f805139b7.png', 1, 0),
(3, 'Banner02', 'bf5223af6fd40b99c2a07c594e552379.jpg', 1, 0),
(4, 'Banner03', '0f9cca2d5854fd68568ccfb75b29c759.png', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `id_cliente`, `status`) VALUES
(1, '2023-05-06 02:39:49', 1, 1),
(2, '2023-05-06 03:24:32', 3, 1),
(3, '2023-05-07 02:56:06', 1, 1),
(4, '2023-05-07 03:12:32', 1, 1),
(5, '2023-05-07 04:19:25', 2, 1),
(6, '2023-05-07 17:43:29', 1, 1),
(7, '2023-05-07 13:40:33', 3, 1),
(8, '2023-05-07 12:42:05', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`id`, `id_pedido`, `id_producto`, `cantidad`, `precio`) VALUES
(5, 2, 5, 15, 550),
(6, 2, 6, 12, 420),
(17, 1, 6, 10, 420),
(18, 1, 2, 10, 420),
(20, 3, 5, 1, 550),
(21, 3, 4, 1, 325),
(22, 3, 2, 1, 420),
(24, 4, 4, 1, 325),
(25, 4, 6, 15, 420),
(26, 4, 7, 10, 580),
(27, 5, 8, 1, 800),
(28, 5, 4, 1, 325),
(29, 5, 5, 1, 550),
(30, 5, 9, 15, 120),
(34, 6, 4, 15, 325),
(35, 6, 6, 10, 420),
(36, 6, 7, 5, 580),
(37, 7, 7, 15, 580),
(38, 7, 8, 10, 800),
(39, 7, 9, 2, 120),
(40, 8, 6, 2, 420),
(41, 8, 8, 3, 800),
(42, 8, 5, 1, 550);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `codigo` varchar(32) NOT NULL,
  `descripcion` text NOT NULL,
  `costo` double NOT NULL,
  `stock` int(11) NOT NULL,
  `archivo_n` varchar(255) NOT NULL,
  `archivo` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `descripcion`, `costo`, `stock`, `archivo_n`, `archivo`, `status`, `eliminado`) VALUES
(1, 'Divina Comedia', 'Comedia01', 'La Divina comedia, también conocida simplemente como Comedia, es un poema escrito por Dante Alighieri.', 420, 30, 'divinacomedia.jpg', 'af9c961db2ce44f8d2703301e56261d4.jpg', 1, 1),
(2, 'Divina Comedia', 'Comedia01', 'Poema de el infierno de Dante', 420, 30, 'divinacomedia.jpg', 'af9c961db2ce44f8d2703301e56261d4.jpg', 1, 0),
(3, 'Siega', 'Siega01', 'Primera parte del arco de los segadores', 350, 26, 'siega.jpg', 'ed313209a268a7efe4ed2b1a7b338fdd.jpg', 1, 1),
(4, 'Trueno', 'Trueno02', 'Trueno es la tercera parte del arco de la guadaña', 325, 30, 'trueno.jpg', '641082646543a0ca1741a82147d19790.jpg', 1, 0),
(5, 'Elantris', 'Elantris01', 'Elantris es un libro de fantasía escrito por Brandom Sanderson', 550, 50, 'elantrisoriginal.jpg', '20a462a6e6b99086e1a4b36969e66b13.jpg', 1, 0),
(6, 'Siega', 'Siega01', 'Primer libro del arco de los segadores', 420, 30, 'siega.jpg', 'ed313209a268a7efe4ed2b1a7b338fdd.jpg', 1, 0),
(7, 'Programacion en C for Dummies', 'Dummies01', 'Este texto pretende ser una introducción a la programación de ordenadores en lenguaje C.', 580, 23, 'cfordummies.jpg', '274d5717f10ad6731b1f77f568cceb03.jpg', 1, 0),
(8, 'El nombre del viento', 'Viento01', 'El nombre del viento. Crónica del asesino de reyes: primer día es una novela de fantasía épica, perteneciente a la serie Crónica del Asesino de Reyes, escrita por Patrick Rothfuss, escritor estadounidense y profesor adjunto de lengua y filología inglesa en la Universidad de Wisconsin.', 800, 30, 'viento.jpg', '4e80dde2568e76dee2449b54123e8021.jpg', 1, 0),
(9, 'Diario de Ana Frank', 'Frank01', 'Con el título de El diario de Ana Frank se conoce la edición de los diarios personales escritos por la joven holandesa Ana Frank entre el 12 de junio de 1942 y el 1 de agosto de 1944, en un total de tres cuadernos conservados en la actualidad.', 120, 40, 'frank.jpg', 'd3eb8aefd5f760e2fd62f22f6fc05e7f.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `pass`, `status`, `eliminado`) VALUES
(1, 'Eduardo', 'prueba@gmail.com', 'c378985d629e99a4e86213db0cd5e70d', 1, 0),
(2, 'Carlos', 'carlos@gmail.com', 'c378985d629e99a4e86213db0cd5e70d', 1, 0),
(3, 'Luis', 'luis@gmail.com', 'c378985d629e99a4e86213db0cd5e70d', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
