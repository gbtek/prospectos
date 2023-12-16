-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-12-2023 a las 06:30:23
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prospectos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pr_docs`
--

DROP TABLE IF EXISTS `pr_docs`;
CREATE TABLE IF NOT EXISTS `pr_docs` (
  `id_documento` int NOT NULL AUTO_INCREMENT,
  `id_prospecto` int NOT NULL,
  `doc_nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `doc_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `doc_estatus` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `doc_notas` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  PRIMARY KEY (`id_documento`,`id_prospecto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pr_prospectos`
--

DROP TABLE IF EXISTS `pr_prospectos`;
CREATE TABLE IF NOT EXISTS `pr_prospectos` (
  `id_prospecto` int NOT NULL AUTO_INCREMENT,
  `pros_nombre` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `pros_apell1` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `pros_apell2` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `pros_calle` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `pros_num` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `pros_col` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `pros_cp` int DEFAULT NULL,
  `pros_tel` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `pros_rfc` varchar(14) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `pros_estatus` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `pros_notas` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  PRIMARY KEY (`id_prospecto`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `pr_prospectos`
--

INSERT INTO `pr_prospectos` (`id_prospecto`, `pros_nombre`, `pros_apell1`, `pros_apell2`, `pros_calle`, `pros_num`, `pros_col`, `pros_cp`, `pros_tel`, `pros_rfc`, `pros_estatus`, `pros_notas`) VALUES
(1, 'Juan Fernando', 'Godoy', 'Lomelí', 'Donato Guerra', '421', 'Centro', 80000, '6677889900', 'GOLJ871221557', 'Autorizado', 'Ya vimos que si es chilo el morro.'),
(2, 'Miguel', 'Hernandez', 'Herrera', 'Napoleon', '521', 'San Miguel', 82014, '6677998854', 'HEHM7781212', 'Rechazado', 'El prospecto no cumple con los requerimentos minimos necesarios, por lo que hemos decidido no admitirlo. Aclaraciones con Jorge de Producción.'),
(3, 'Elon', 'Mosk', '', 'Avenida Siempre Viva', '12', 'Las Quintas', 12345, '1234512345', 'ASDF125445ASD', 'Autorizado', 'El bato es chilo'),
(4, 'Luis Alberto', 'Dias', 'Espericueto', 'alvaro Obregon', '156 Sur', 'Alamos', 80012, '6987452123', 'ASDF125445ASD', 'Rechazado', 'sdfsdfsdf'),
(5, 'Graciela ', 'Velazquez', 'Lopez', 'Natividad', '185', 'Plutarco Elias', 80542, '6677554422', 'VELG871010FG5', 'Enviado', NULL),
(6, 'Ermenegildo', 'Espinoza', 'de los Montero', 'Blvd. Pedro Infante', '1254', 'Centro', 80000, '6679874521', 'ESME990605EDR', 'Enviado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pr_usdata`
--

DROP TABLE IF EXISTS `pr_usdata`;
CREATE TABLE IF NOT EXISTS `pr_usdata` (
  `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_displayname` varchar(250) NOT NULL DEFAULT '',
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_datereg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_type` varchar(20) DEFAULT NULL,
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`),
  KEY `user_login_key` (`user_name`),
  KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `pr_usdata`
--

INSERT INTO `pr_usdata` (`id_user`, `user_displayname`, `user_name`, `user_pass`, `user_email`, `user_datereg`, `user_type`, `user_activation_key`, `user_status`) VALUES
(1, 'Fernando Godoy', 'fer', '827ccb0eea8a706c4c34a16891f84e7b', 'socialadded@gmail.com', '2016-08-27 04:46:44', 'promotor', '', 1),
(2, 'Juan Manuel', 'jm', '827ccb0eea8a706c4c34a16891f84e7b', '', '2023-03-10 01:13:28', 'evaluador', '', 1),
(3, 'Administrador', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '', '2023-06-11 17:37:15', 'admin', '', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
