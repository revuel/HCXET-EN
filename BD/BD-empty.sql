-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2015 a las 18:36:08
-- Versión del servidor: 5.5.39
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `hcsxetdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

CREATE TABLE IF NOT EXISTS `contiene` (
  `id_lista` int(50) NOT NULL,
  `id_destinatario` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinatario`
--

CREATE TABLE IF NOT EXISTS `destinatario` (
`id_destinatario` int(100) NOT NULL,
  `email_destinatario` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_destinatario` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidos_destinatario` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista`
--

CREATE TABLE IF NOT EXISTS `lista` (
`id_lista` int(50) NOT NULL,
  `nombre_lista` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_usuario` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `target`
--

CREATE TABLE IF NOT EXISTS `target` (
`id_target` int(50) NOT NULL,
  `nombre_target` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `link_target` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_ini` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_usuario` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id_usuario` int(5) NOT NULL,
  `email_usuario` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_usuario` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidos_usuario` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

CREATE TABLE IF NOT EXISTS `valoracion` (
  `id_destinatario` int(100) NOT NULL,
  `id_target` int(50) NOT NULL,
  `token` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `respuesta_1` int(1) DEFAULT NULL,
  `respuesta_2` int(1) DEFAULT NULL,
  `respuesta_3` int(1) DEFAULT NULL,
  `respuesta_4` int(1) DEFAULT NULL,
  `respuesta_5` int(1) DEFAULT NULL,
  `respuesta_6` int(1) DEFAULT NULL,
  `respuesta_7` int(1) DEFAULT NULL,
  `respuesta_8` int(1) DEFAULT NULL,
  `respuesta_9` int(1) DEFAULT NULL,
  `respuesta_10` int(1) DEFAULT NULL,
  `respuesta_11` int(1) DEFAULT NULL,
  `respuesta_12` int(1) DEFAULT NULL,
  `respuesta_13` int(1) DEFAULT NULL,
  `respuesta_14` int(1) DEFAULT NULL,
  `respuesta_15` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contiene`
--
ALTER TABLE `contiene`
 ADD PRIMARY KEY (`id_lista`,`id_destinatario`), ADD KEY `id_destinatario` (`id_destinatario`);

--
-- Indices de la tabla `destinatario`
--
ALTER TABLE `destinatario`
 ADD PRIMARY KEY (`id_destinatario`);

--
-- Indices de la tabla `lista`
--
ALTER TABLE `lista`
 ADD PRIMARY KEY (`id_lista`), ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `target`
--
ALTER TABLE `target`
 ADD PRIMARY KEY (`id_target`), ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `valoracion`
--
ALTER TABLE `valoracion`
 ADD PRIMARY KEY (`id_destinatario`,`id_target`), ADD KEY `id_target` (`id_target`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `destinatario`
--
ALTER TABLE `destinatario`
MODIFY `id_destinatario` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de la tabla `lista`
--
ALTER TABLE `lista`
MODIFY `id_lista` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de la tabla `target`
--
ALTER TABLE `target`
MODIFY `id_target` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contiene`
--
ALTER TABLE `contiene`
ADD CONSTRAINT `contiene_ibfk_1` FOREIGN KEY (`id_lista`) REFERENCES `lista` (`id_lista`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `contiene_ibfk_2` FOREIGN KEY (`id_destinatario`) REFERENCES `destinatario` (`id_destinatario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lista`
--
ALTER TABLE `lista`
ADD CONSTRAINT `lista_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `target`
--
ALTER TABLE `target`
ADD CONSTRAINT `target_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `valoracion`
--
ALTER TABLE `valoracion`
ADD CONSTRAINT `valoracion_ibfk_1` FOREIGN KEY (`id_destinatario`) REFERENCES `destinatario` (`id_destinatario`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `valoracion_ibfk_2` FOREIGN KEY (`id_target`) REFERENCES `target` (`id_target`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
