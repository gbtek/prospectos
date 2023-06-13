-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-06-2023 a las 00:54:04
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `pr_docs` (
  `id_documento` int(11) NOT NULL,
  `id_prospecto` int(11) NOT NULL,
  `doc_nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `doc_url` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `doc_estatus` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `doc_notas` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pr_prospectos`
--

CREATE TABLE `pr_prospectos` (
  `id_prospecto` int(11) NOT NULL,
  `pros_nombre` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pros_apell1` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pros_apell2` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pros_calle` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pros_num` varchar(64) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pros_col` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pros_cp` int(11) DEFAULT NULL,
  `pros_tel` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pros_rfc` varchar(14) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pros_estatus` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pros_notas` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

CREATE TABLE `pr_usdata` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `user_displayname` varchar(250) NOT NULL DEFAULT '',
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_datereg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_type` varchar(20) DEFAULT NULL,
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pr_usdata`
--

INSERT INTO `pr_usdata` (`id_user`, `user_displayname`, `user_name`, `user_pass`, `user_email`, `user_datereg`, `user_type`, `user_activation_key`, `user_status`) VALUES
(1, 'Fernando Godoy', 'fer', '827ccb0eea8a706c4c34a16891f84e7b', 'socialadded@gmail.com', '2016-08-27 04:46:44', 'promotor', '', 1),
(2, 'Juan Manuel', 'jm', '827ccb0eea8a706c4c34a16891f84e7b', '', '2023-03-10 01:13:28', 'evaluador', '', 1),
(3, 'Administrador', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '', '2023-06-11 17:37:15', 'admin', '', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pr_docs`
--
ALTER TABLE `pr_docs`
  ADD PRIMARY KEY (`id_documento`,`id_prospecto`);

--
-- Indices de la tabla `pr_prospectos`
--
ALTER TABLE `pr_prospectos`
  ADD PRIMARY KEY (`id_prospecto`);

--
-- Indices de la tabla `pr_usdata`
--
ALTER TABLE `pr_usdata`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `user_login_key` (`user_name`),
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pr_docs`
--
ALTER TABLE `pr_docs`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pr_prospectos`
--
ALTER TABLE `pr_prospectos`
  MODIFY `id_prospecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `pr_usdata`
--
ALTER TABLE `pr_usdata`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
