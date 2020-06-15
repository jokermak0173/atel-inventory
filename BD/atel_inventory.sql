-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-06-2020 a las 14:13:00
-- Versión del servidor: 5.7.30-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `atel_inventory`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componente`
--

CREATE TABLE `componente` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `componente`
--

INSERT INTO `componente` (`id`, `nombre`) VALUES
(1, 'mouse'),
(2, 'teclado'),
(3, 'diadema'),
(4, 'adaptador cacahuate'),
(5, 'monitor'),
(6, 'CPU'),
(7, 'Cable cacahuate\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales`
--

CREATE TABLE `locales` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `nombre_alias` text NOT NULL,
  `plaza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `locales`
--

INSERT INTO `locales` (`id`, `nombre`, `nombre_alias`, `plaza`) VALUES
(1, 'sala-a', 'Sala A', 1),
(2, 'sala-b', 'Sala B', 1),
(3, 'e11', 'E-11', 2),
(4, 'e29pa', 'E-29 PA', 2),
(5, 'e29pb', 'E-29 PB', 2),
(6, 'e31pb', 'E-31 PB', 2),
(7, 'e40', 'E - 40', 2),
(8, 'e31pa', 'E-31 PA\r\n', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `solicitud` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` text NOT NULL,
  `estado_solicitud` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `solicitud`, `usuario`, `fecha`, `estado`, `estado_solicitud`) VALUES
(1, 1, 22, '2020-05-22 18:25:24', 'visto', 'enviado'),
(2, 1, 60345, '2020-05-22 18:25:24', 'no-visto', 'enviado'),
(3, 1, 60904, '2020-05-22 18:25:24', 'no-visto', 'enviado'),
(4, 1, 60984, '2020-05-22 18:25:24', 'no-visto', 'enviado'),
(5, 1, 505553, '2020-05-22 18:25:24', 'no-visto', 'enviado'),
(6, 4, 666, '2020-05-22 19:58:43', 'visto', 'enviado'),
(7, 4, 4, '2020-05-22 19:59:54', 'no-visto', 'cambiado'),
(8, 2, 4, '2020-05-22 20:00:29', 'no-visto', 'cancelado'),
(9, 6, 22, '2020-06-11 21:40:34', 'visto', 'enviado'),
(10, 6, 666, '2020-06-11 21:40:34', 'no-visto', 'enviado'),
(11, 6, 60242, '2020-06-11 21:40:34', 'no-visto', 'enviado'),
(12, 6, 60996, '2020-06-11 21:40:35', 'no-visto', 'enviado'),
(13, 6, 209548, '2020-06-11 21:40:35', 'no-visto', 'enviado'),
(14, 6, 30, '2020-06-11 21:41:23', 'visto', 'cambiado'),
(15, 6, 666, '2020-06-11 21:41:23', 'no-visto', 'cambiado'),
(16, 6, 60242, '2020-06-11 21:41:23', 'no-visto', 'cambiado'),
(17, 6, 60996, '2020-06-11 21:41:23', 'no-visto', 'cambiado'),
(18, 6, 209548, '2020-06-11 21:41:23', 'no-visto', 'cambiado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_cambio`
--

CREATE TABLE `solicitud_cambio` (
  `id` int(11) NOT NULL,
  `local` int(11) NOT NULL,
  `posicion` int(11) NOT NULL,
  `usuario_reporta` int(11) NOT NULL,
  `motivo_cambio` text,
  `componente` int(11) NOT NULL,
  `comentario_reporte` text,
  `fecha_reporte` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_atiende` int(11) DEFAULT NULL,
  `fecha_resolucion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `comentario_resolucion` text,
  `estado` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitud_cambio`
--

INSERT INTO `solicitud_cambio` (`id`, `local`, `posicion`, `usuario_reporta`, `motivo_cambio`, `componente`, `comentario_reporte`, `fecha_reporte`, `usuario_atiende`, `fecha_resolucion`, `comentario_resolucion`, `estado`) VALUES
(1, 3, 108, 30, NULL, 1, '', '2020-05-22 18:25:23', NULL, NULL, NULL, 'enviado'),
(2, 1, 67, 4, NULL, 5, 'no prende', '2020-05-22 18:47:20', 666, '2020-05-22 20:00:29', NULL, 'cancelado'),
(3, 1, 58, 4, 'Falla detectada', 7, '', '2020-05-22 18:50:25', 4, '2020-05-22 18:50:23', '', 'cambiado'),
(4, 1, 74, 4, NULL, 5, 'no prende', '2020-05-22 19:58:43', 666, '2020-05-22 19:59:53', '', 'cambiado'),
(5, 1, 105, 4, 'Falla detectada', 4, '', '2020-05-22 20:02:54', 4, '2020-05-22 20:02:53', '', 'cambiado'),
(6, 1, 131, 30, NULL, 5, 'no prende', '2020-06-11 21:40:34', 22, '2020-06-11 21:41:22', 'se cambio por uno nuevo', 'cambiado'),
(7, 1, 104, 30, 'Falla detectada', 4, '', '2020-06-11 21:42:35', 30, '2020-06-11 21:42:35', '', 'cambiado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `componente`
--
ALTER TABLE `componente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_cambio`
--
ALTER TABLE `solicitud_cambio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `SOLICITUDES_ID_LOCAL_FK` (`local`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `componente`
--
ALTER TABLE `componente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `locales`
--
ALTER TABLE `locales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `solicitud_cambio`
--
ALTER TABLE `solicitud_cambio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `solicitud_cambio`
--
ALTER TABLE `solicitud_cambio`
  ADD CONSTRAINT `SOLICITUDES_ID_LOCAL_FK` FOREIGN KEY (`local`) REFERENCES `locales` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
