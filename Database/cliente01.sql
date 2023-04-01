-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2023 a las 21:57:30
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
