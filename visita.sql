-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2015 a las 16:42:05
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `visita`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `empresa_id` int(11) DEFAULT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `usuario_creador` varchar(30) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `usuario_actualiza` varchar(30) DEFAULT NULL,
  `fecha_actualiza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

CREATE TABLE IF NOT EXISTS `lugar` (
  `lugar_id` int(11) DEFAULT NULL,
  `lugar_nombre` varchar(250) DEFAULT NULL,
  `lugar_piso` varchar(10) DEFAULT NULL,
  `usuario_creador` varchar(30) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `usuario_actualiza` varchar(30) DEFAULT NULL,
  `fecha_actualiza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo`
--

CREATE TABLE IF NOT EXISTS `motivo` (
  `motivo_id` int(11) DEFAULT NULL,
  `motivo_descripcion` varchar(250) DEFAULT NULL,
  `usuario_creador` varchar(30) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `usuario_actualiza` varchar(30) DEFAULT NULL,
  `fecha_actualiza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `persona_id` int(11) DEFAULT NULL,
  `persona_nombre` varchar(50) DEFAULT NULL,
  `persona_apepat` varchar(50) DEFAULT NULL,
  `persona_apemat` varchar(50) DEFAULT NULL,
  `persona_nombres` varchar(150) DEFAULT NULL,
  `tipodocumento_id` int(11) DEFAULT NULL,
  `documento_numero` varchar(20) DEFAULT NULL,
  `usuario_creador` varchar(30) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `usuario_actualiza` varchar(30) DEFAULT NULL,
  `fecha_actualiza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE IF NOT EXISTS `tipodocumento` (
  `tipodocumento_id` int(11) DEFAULT NULL,
  `tipodocumento_nombre` varchar(15) DEFAULT NULL,
  `usuario_creador` varchar(30) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `usuario_actualiza` varchar(30) DEFAULT NULL,
  `fecha_actualiza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE IF NOT EXISTS `visita` (
  `visita_id` int(11) DEFAULT NULL,
  `personal_id` int(11) DEFAULT NULL,
  `lugar_id` int(11) DEFAULT NULL,
  `motivo_id` int(11) DEFAULT NULL,
  `visita_obervacion` varchar(200) DEFAULT NULL,
  `visita_detalle` varchar(200) DEFAULT NULL,
  `visita_fecha` char(10) DEFAULT NULL,
  `visista_horaprogramada` char(8) DEFAULT NULL,
  `usuario_creador` varchar(30) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `usuario_actualiza` varchar(30) DEFAULT NULL,
  `fecha_actualiza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitante`
--

CREATE TABLE IF NOT EXISTS `visitante` (
  `visitante_id` int(11) DEFAULT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `visitante_email` varchar(150) DEFAULT NULL,
  `usuario_creador` varchar(30) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `usuario_actualiza` varchar(30) DEFAULT NULL,
  `fecha_actualiza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitavisitante`
--

CREATE TABLE IF NOT EXISTS `visitavisitante` (
  `visitavisitante_id` int(11) DEFAULT NULL,
  `visita_id` int(11) DEFAULT NULL,
  `visitante_id` int(11) DEFAULT NULL,
  `visita_horaingeso` char(8) DEFAULT NULL,
  `visita_horasalida` char(8) DEFAULT NULL,
  `usuario_creador` varchar(30) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `usuario_actualiza` varchar(30) DEFAULT NULL,
  `fecha_actualiza` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
