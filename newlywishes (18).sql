-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-04-2014 a las 23:25:49
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `rombomed_newly`
--
CREATE DATABASE IF NOT EXISTS `rombomed_newly` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rombomed_newly`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE IF NOT EXISTS `anuncios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioId` int(11) NOT NULL,
  `webpage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9AFBE206EEC9F102` (`usuarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE IF NOT EXISTS `articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioId` int(11) NOT NULL,
  `idInterno` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `precioPromocion` int(11) NOT NULL,
  `tamanos` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `tipo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9C6F8597EEC9F102` (`usuarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `usuarioId`, `idInterno`, `nombre`, `descripcion`, `stock`, `precio`, `precioPromocion`, `tamanos`, `tipo`, `estatus`) VALUES
(1, 15, 'asdf', 'asdf', 'asdf', 45, 456, 45, 'as,bs,cs', 'Producto', 0),
(2, 15, 'asdf', 'asdf', 'asdf', 45, 456, 45, 'caci,tisi,cusi', 'Producto', 0),
(3, 15, 'asdf', 'asdf', 'asdf', 45, 456, 45, 'caci,tisi,cusi', 'Producto', 0),
(6, 15, 'eui', 'Juanito', 'oeui oeui', 1, 34, 34, '54,55,56,57,58,59', 'Producto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioId` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_250F2568EEC9F102` (`usuarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `banners`
--

INSERT INTO `banners` (`id`, `usuarioId`, `name`, `path`) VALUES
(4, 15, 'cari10', 'carita.png'),
(5, 15, '684984', 'DSWinBlue-preview.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodas`
--

CREATE TABLE IF NOT EXISTS `bodas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioId` int(11) NOT NULL,
  `ceremonia` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ceremonia_direccion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `recepcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `recepcion_direccion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_boda` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BCA12DF9EEC9F102` (`usuarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `bodas`
--

INSERT INTO `bodas` (`id`, `usuarioId`, `ceremonia`, `ceremonia_direccion`, `recepcion`, `recepcion_direccion`, `fecha_boda`) VALUES
(20, 16, 'Tata', 'Tata', 'Tata', 'Tata', '2015-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_regalos`
--

CREATE TABLE IF NOT EXISTS `cat_regalos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoriaName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `cat_regalos`
--

INSERT INTO `cat_regalos` (`id`, `categoriaName`) VALUES
(1, 'Muebles'),
(2, 'Electrodomésticos'),
(3, 'Viajes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checklist`
--

CREATE TABLE IF NOT EXISTS `checklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioId` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `tarea` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DE98EF8CEEC9F102` (`usuarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `checklist`
--

INSERT INTO `checklist` (`id`, `usuarioId`, `status`, `tarea`, `categoria`, `descripcion`) VALUES
(1, 16, 0, 'Comprar jabón', 'Cosas que comprar', 'En la luna de miel necesitamos jabón sensual marca Dove'),
(3, 16, 1, 'Llorar', 'Sentimientos', 'Llorar hasta sacar todas y cada una de las pinches penas del alma.'),
(4, 16, 1, 'Reír', 'Sentimientos', 'Reír como desquiciado :)'),
(5, 16, 1, 'Besar a la novia', 'Día libre', 'Nomas por no tener nada mejor que hacer.'),
(12, 14, 0, 'euid', 'uid', 'ueid');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paisId` int(11) NOT NULL,
  `estado` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_222B2128654FCD12` (`paisId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `paisId`, `estado`) VALUES
(1, 1, 'Aguascalientes'),
(2, 1, 'Baja California'),
(3, 1, 'Baja California Sur'),
(4, 1, 'Campeche'),
(5, 1, 'Chiapas'),
(6, 1, 'Chihuahua'),
(7, 1, 'Coahuila'),
(8, 1, 'Colima'),
(9, 1, 'Distrito Federal'),
(10, 1, 'Durango'),
(11, 1, 'Estado de México'),
(12, 1, 'Guanajuato'),
(13, 1, 'Guerrero'),
(14, 1, 'Hidalgo'),
(15, 1, 'Jalisco'),
(16, 1, 'Michoacán'),
(17, 1, 'Morelos'),
(18, 1, 'Nayarit'),
(19, 1, 'Nuevo León'),
(20, 1, 'Oaxaca'),
(21, 1, 'Puebla'),
(22, 1, 'Querétaro'),
(23, 1, 'Quintana Roo'),
(24, 1, 'San Luis Potosí'),
(25, 1, 'Sinaloa'),
(26, 1, 'Sonora'),
(27, 1, 'Tabasco'),
(28, 1, 'Tamaulipas'),
(29, 1, 'Tlaxcala'),
(30, 1, 'Veracruz'),
(31, 1, 'Yucatán'),
(32, 1, 'Zacatecas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fos_user`
--

CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(4, 'Juanito', 'juanito', 'oeui@oeui', 'oeui@oeui', 1, 'eb4iwk0vhbwc0kgos448g48oks0gs0k', 'QKISMEWs3VP53/bCbq2QRq0um1LD02sMNlc4FIqwRRBHW6Hxp2eA+QP5B608lomaTKV6L3IsjM6EasXLlv8aHw==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL),
(6, 'Roman', 'roman', 'oeui@oeuie', 'oeui@oeuie', 1, 'ostbsyqztrkssw0o0co0ooogso8wsk8', 'wETvQSennDVRN4tgKjEmcwLAhQdpMLNGwS4ABumoAe0lCTdylNLiLYC4GOo2FPU21fqRM5xCBuCWgoZEkQKSqg==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL),
(9, 'Roeu', 'roeu', 'oeui@oeuiee', 'oeui@oeuiee', 1, 'rvoai73bh1c0g44kg4owksco00gcsgs', 'IxpYeqoKAjAHKCwEW+QXSxuF1Oj+d7vl9V4ji5X37rI9UYZzuH5DIjbw3kCj3tZqKlJJ1XDNTrJ7ny9+9L6w6w==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL),
(10, 'docser', 'docser', 'aoeu@aoeu', 'aoeu@aoeu', 1, 'b2s9838jc2040cwggcoo8ks8gswowsw', '5sbyI6pc/2jlCzKurRsghcca7TesnbKrpFMWqTThuWc6TX3L3C8n16sNj1SAlMPeZ7kz3o6J1PabdtoGDMRvJg==', '2014-02-14 08:00:00', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL),
(11, 'docsernovios', 'docsernovios', 'ao@aoeu', 'ao@aoeu', 1, 'mk3clzj49qsoowcso4ww4scgwc8w00g', 'OkY0q0bY8JO6QCbFHTjK9XX0VFqusozIQqdxcNqGAz5MlmqgscKHRKm44azQWXy817q2d/yWP68TBzxcBdlMAQ==', '2014-02-14 07:08:32', 0, 0, NULL, NULL, NULL, 'a:2:{i:0;s:10:"ROLE_USER1";i:1;s:11:"ROLE_NOVIOS";}', 0, NULL),
(13, 'docserproveedores', 'docserproveedores', 'aoe@oeuuuu', 'aoe@oeuuuu', 1, 'qe7djj4hqdc4k8sc0gssws0o8ok04o', 'rBJwUXBraaRL62ftNWJTa4IUvnMirkMI7gTnpZz2PJDnER1QHM8iQ8k9xpItmhzGkPV7Is61NAX8Vv//X0vPvQ==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL),
(14, 'prueba', 'prueba', 'aoeu@aoeuo', 'aoeu@aoeuo', 1, '1zgp6xvx3h9cg0k8kcwc408kkk0k84c', 'uSX5qB8TUvUV8xRrx34jfh2JqLX8xvvwVeenanRxWNsysYPI3o47U/2GyoOx5OgKGvu82XxNsKo8VQqK4uowyw==', '2014-02-17 04:34:20', 0, 0, NULL, NULL, NULL, 'a:2:{i:0;s:9:"ROLE_USER";i:1;s:10:"ROLE_NOVIO";}', 0, NULL),
(15, 'proveedor', 'proveedor', 'aoeu@oeu', 'aoeu@oeu', 1, '7c21heq39lgc00sgco0g40gs4g044gk', 'dPiU/+gVPUcyEyz0BN92i3EmD4bdSt43gB7eMFloaOxn2rdMXfpcEhyIbq9y+1TnOiTBc5yfE2WMFtnNd2b/Vg==', '2014-04-01 09:26:13', 0, 0, NULL, NULL, NULL, 'a:2:{i:0;s:9:"ROLE_USER";i:1;s:14:"ROLE_PROVEEDOR";}', 0, NULL),
(16, 'novio', 'novio', 'oeui@oeoui', 'oeui@oeoui', 1, 'f35be3mraxkcowk4cookowos4gks0ck', 'dnqcCDXDJWuwATwLpw6d1ade0m7he87lC9DYMZRYrgC8fWJ0Us8Gmbn4ccvVKgEbBVhrPKLdMcNOPTwKQk76XQ==', '2014-03-26 14:41:35', 0, 0, NULL, NULL, NULL, 'a:2:{i:0;s:9:"ROLE_USER";i:1;s:10:"ROLE_NOVIO";}', 0, NULL),
(17, 'Juan', 'juan', 'doaoo@aoeu.com', 'doaoo@aoeu.com', 1, 'rrwguwpzm9wkwcwow4cgo4gww8so0w4', 'L0ErGBnfJym838jLoBfGXBMI0iumLQvFXCnNSesG47E4lhackhVG8tzXOiip4RNeZxIDSa1BF245W8I2GaYRHA==', '2014-02-15 03:13:13', 0, 0, NULL, NULL, NULL, 'a:2:{i:0;s:9:"ROLE_USER";i:1;s:14:"ROLE_PROVEEDOR";}', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotosarticulos`
--

CREATE TABLE IF NOT EXISTS `fotosarticulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articuloId` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F5FC5E4D383FDD7` (`articuloId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `fotosarticulos`
--

INSERT INTO `fotosarticulos` (`id`, `articuloId`, `path`) VALUES
(1, 6, 'avatar.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_invitados`
--

CREATE TABLE IF NOT EXISTS `lista_invitados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioId` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `familia` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75397DFBEEC9F102` (`usuarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `lista_invitados`
--

INSERT INTO `lista_invitados` (`id`, `usuarioId`, `status`, `nombre`, `familia`, `telefono`) VALUES
(2, 14, 1, 'Petronilo', 'Gutiérrez Cuétara', '7773701317'),
(3, 14, 1, 'iu', 'iue', 'u'),
(5, 16, 1, 'Pito', 'Perez Gonzàlez', '7919136229'),
(6, 16, 0, 'Rodrigo', 'Ibarra Calleja', '2221234567'),
(7, 16, 1, 'Andrea', 'Bárcenas', '5554235689');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE IF NOT EXISTS `notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioId` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_65776388EEC9F102` (`usuarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `usuarioId`, `titulo`, `descripcion`) VALUES
(2, 16, 'Mi notita', 'Esto debe ser para algo, creo estar seguro que para algo me ha de funcionar tener notitas aquí :)'),
(3, 16, 'Nueva nota', 'Nota sin sentido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novias`
--

CREATE TABLE IF NOT EXISTS `novias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sNombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `aPaterno` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `aMaterno` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `eMail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lada` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_24E65A9AEEC9F102` (`usuarioId`),
  KEY `IDX_24E65A9A265DE1E3` (`estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `novias`
--

INSERT INTO `novias` (`id`, `estado`, `usuarioId`, `nombre`, `sNombre`, `aPaterno`, `aMaterno`, `eMail`, `lada`, `telefono`, `celular`, `direccion`, `ciudad`, `cp`) VALUES
(1, 1, 4, 'oeui', 'ioeu', 'euo', 'eu', 'oe@oeui', 'oeu', 'ieui', 'oeui', 'oeui', 'oeui', 'oeui'),
(2, 14, 6, 'oeuieui', 'eui', 'eui', 'oeui', 'eui@oeue', 'oeu', 'oeu', 'oeu', 'oeu', 'oeui', 'oeu'),
(4, 11, 9, 'oeu', 'aoeu', 'aoeu', 'oeu', 'ao@oeue', 'aoe', 'aoeu', 'aoe', 'oeu', 'oeui', 'oeu'),
(5, 1, 10, 'eui', 'eui', 'eui', 'eui', 'oeuioeu@oeu', 'eou', 'oeui', 'eui', 'oeu', 'aoeu', 'oeu'),
(6, 1, 11, 'oeu', 'oeu', 'aoeu', 'aoeu', 'oeuioeu@oeu', 'oeu', 'aoeuaoeu', 'eoui', 'aoeu', 'aoeu', 'oeu'),
(7, 1, 14, 'euoi', 'oeuioeui', 'oeui', 'oeui', 'oaeu@equ', 'aoe', 'aoeu', 'aoeu', 'aoeu', 'oeua', 'aoeu'),
(8, 15, 16, 'Andrea', 'lkjhlk', 'hkjhjkh', 'jkhkjlh', 'adf@asdf', 'sdf', 'hlkhlk', 'sdfg', 'kjh', 'sdfg', 'sdfg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novios`
--

CREATE TABLE IF NOT EXISTS `novios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sNombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `aPaterno` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `aMaterno` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `eMail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lada` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_BA657714EEC9F102` (`usuarioId`),
  KEY `IDX_BA657714265DE1E3` (`estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `novios`
--

INSERT INTO `novios` (`id`, `estado`, `usuarioId`, `nombre`, `sNombre`, `aPaterno`, `aMaterno`, `eMail`, `lada`, `telefono`, `celular`, `direccion`, `ciudad`, `cp`) VALUES
(1, 17, 9, 'e', 'eu', 'oeu', 'oe', 'oeui@oeuiee', 'oeu', 'aoeu', 'u', 'eou', 'oeu', 'oeu'),
(2, 1, 10, 'oeu', 'oeau', 'oeu', 'aoeu', 'aoeu@aoeu', 'aoe', 'aoeu', 'aoeu', 'aoeu', 'oeua', 'aoeu'),
(3, 1, 11, 'aoeu', 'oeuoaeu', 'oeu', 'aoeu', 'ao@aoeu', 'aoe', 'oeu', 'aoeu', 'oeu', 'ueouoe', 'oeu'),
(4, 1, 14, 'aoeu', 'oaeu', 'aoeu', 'oeu', 'aoeu@aoeuo', 'oe', 'a', 'aoeu', 'aoeu', 'oeu', 'aoeu'),
(5, 1, 16, 'sdfg', 'sdfg', 'sdfg', 'sdfg', 'adf@asdf', 'sdf', 'sdfg', 'sdfg', 'dsfg', 'sdfg', 'sdfg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padrinos`
--

CREATE TABLE IF NOT EXISTS `padrinos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioId` int(11) NOT NULL,
  `padrino` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DBCAFE06EEC9F102` (`usuarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `padrinos`
--

INSERT INTO `padrinos` (`id`, `usuarioId`, `padrino`, `categoria`) VALUES
(2, 16, 'Andrea Pilla', 'Pastelito'),
(3, 16, 'Jorge Benitez', 'Pantunflas'),
(5, 16, 'Juana de Asbaje', 'Anillos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `pais`) VALUES
(1, 'México');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD12469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `tipoPersona` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombreRazon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellidoPaterno` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellidoMaterno` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rfc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lada` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_864FA8F1EEC9F102` (`usuarioId`),
  KEY `IDX_864FA8F1265DE1E3` (`estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `estado`, `usuarioId`, `tipoPersona`, `nombreRazon`, `apellidoPaterno`, `apellidoMaterno`, `rfc`, `email`, `lada`, `telefono`, `celular`, `direccion`, `ciudad`, `cp`) VALUES
(1, 1, 13, 'fisica', 'eoi', 'oeu', 'oeu', 'aoeu', 'aoe@oeuuuu', 'aoe', 'oeu', 'oaeu', 'aoeu', 'aoeu', 'aoeu'),
(2, 14, 15, 'fisica', 'Sergio', 'Vargas', 'Enrique', '21212', 'docser@gmail.com', '222', '52222391', '1212', 'Hidalgo 21', 'Tepeapulco', '43970'),
(3, 6, 17, 'moral', 'Juan', 'Perez', 'García', '123456', 'doaoo@aoeu.com', '222', '12345678', '1654679794', 'Av del garbanzo no 17', 'Pizzerola', '65874');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regalos`
--

CREATE TABLE IF NOT EXISTS `regalos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `regalo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `precioTotal` int(11) NOT NULL,
  `horcruxes` int(11) NOT NULL,
  `horcruxesPagados` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `absorberComision` tinyint(1) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7C8EDE04EEC9F102` (`usuarioId`),
  KEY `IDX_7C8EDE044E10122D` (`categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `regalos`
--

INSERT INTO `regalos` (`id`, `categoria`, `usuarioId`, `regalo`, `precioTotal`, `horcruxes`, `horcruxesPagados`, `descripcion`, `absorberComision`, `cantidad`) VALUES
(1, 2, 16, 'Microondas', 3000, 3, 7, 'Horno de microondas marca LG con extractor y tiro al centro para hacer palomitas en las noches de pasión y películas.', 0, 5),
(3, 2, 16, 'Licuadora', 10008000, 10, 0, 'Quiero mi licuadora right nau', 1, 1),
(4, 3, 16, 'Miami', 78000, 78, 0, 'Viajaremos a Florida', 0, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `FK_9AFBE206EEC9F102` FOREIGN KEY (`usuarioId`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `FK_9C6F8597EEC9F102` FOREIGN KEY (`usuarioId`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `FK_250F2568EEC9F102` FOREIGN KEY (`usuarioId`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `bodas`
--
ALTER TABLE `bodas`
  ADD CONSTRAINT `FK_BCA12DF9EEC9F102` FOREIGN KEY (`usuarioId`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `checklist`
--
ALTER TABLE `checklist`
  ADD CONSTRAINT `FK_DE98EF8CEEC9F102` FOREIGN KEY (`usuarioId`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `estados`
--
ALTER TABLE `estados`
  ADD CONSTRAINT `FK_222B2128654FCD12` FOREIGN KEY (`paisId`) REFERENCES `paises` (`id`);

--
-- Filtros para la tabla `fotosarticulos`
--
ALTER TABLE `fotosarticulos`
  ADD CONSTRAINT `FK_F5FC5E4D383FDD7` FOREIGN KEY (`articuloId`) REFERENCES `articulos` (`id`);

--
-- Filtros para la tabla `lista_invitados`
--
ALTER TABLE `lista_invitados`
  ADD CONSTRAINT `FK_75397DFBEEC9F102` FOREIGN KEY (`usuarioId`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `FK_65776388EEC9F102` FOREIGN KEY (`usuarioId`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `novias`
--
ALTER TABLE `novias`
  ADD CONSTRAINT `FK_24E65A9A265DE1E3` FOREIGN KEY (`estado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `FK_24E65A9AEEC9F102` FOREIGN KEY (`usuarioId`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `novios`
--
ALTER TABLE `novios`
  ADD CONSTRAINT `FK_BA657714265DE1E3` FOREIGN KEY (`estado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `FK_BA657714EEC9F102` FOREIGN KEY (`usuarioId`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `padrinos`
--
ALTER TABLE `padrinos`
  ADD CONSTRAINT `FK_DBCAFE06EEC9F102` FOREIGN KEY (`usuarioId`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `FK_864FA8F1265DE1E3` FOREIGN KEY (`estado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `FK_864FA8F1EEC9F102` FOREIGN KEY (`usuarioId`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `regalos`
--
ALTER TABLE `regalos`
  ADD CONSTRAINT `FK_7C8EDE044E10122D` FOREIGN KEY (`categoria`) REFERENCES `cat_regalos` (`id`),
  ADD CONSTRAINT `FK_7C8EDE04EEC9F102` FOREIGN KEY (`usuarioId`) REFERENCES `fos_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
