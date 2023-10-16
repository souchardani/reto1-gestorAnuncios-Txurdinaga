-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2023 a las 08:55:53
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestor_anuncios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

CREATE TABLE `anuncio` (
  `id` int(10) NOT NULL,
  `Título` varchar(500) NOT NULL,
  `Autor` varchar(20) NOT NULL,
  `Aceptado` tinyint(1) NOT NULL,
  `Fecha_publi` date NOT NULL,
  `Descripción` text NOT NULL,
  `Imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_anuncio`
--

CREATE TABLE `categoria_anuncio` (
  `Categoria` varchar(50) NOT NULL,
  `Anuncio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `Nombre` varchar(10) NOT NULL,
  `Aula` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`Nombre`, `Aula`) VALUES
('2dw3a', 108);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(10) NOT NULL,
  `Autor` varchar(20) NOT NULL,
  `Anuncio` int(10) NOT NULL,
  `Texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Nick` varchar(20) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Rol` enum('Administrador','Profesor','Alumno','') NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Fecha_naci` date NOT NULL,
  `Clase` varchar(10) NOT NULL,
  `Imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Nick`, `Nombre`, `Apellido`, `Rol`, `Activo`, `Contraseña`, `Correo`, `Fecha_naci`, `Clase`, `Imagen`) VALUES
('Carmen', 'Carmen', 'Gabiola', 'Administrador', 1, 'admin', 'carmengabiola@gmail.com', '2003-07-07', '2dw3a', ''),
('Eneritz', 'Eneritz', 'Marcos', 'Administrador', 1, 'admin', 'eneritzmarcos@gmail.com', '1999-07-08', '2dw3a', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Autor` (`Autor`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Nombre`);

--
-- Indices de la tabla `categoria_anuncio`
--
ALTER TABLE `categoria_anuncio`
  ADD KEY `Categoria` (`Categoria`),
  ADD KEY `Anuncio` (`Anuncio`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`Nombre`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Autor` (`Autor`),
  ADD KEY `Anuncio` (`Anuncio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Nick`),
  ADD KEY `Clase` (`Clase`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `anuncio_ibfk_1` FOREIGN KEY (`Autor`) REFERENCES `usuario` (`Nick`);

--
-- Filtros para la tabla `categoria_anuncio`
--
ALTER TABLE `categoria_anuncio`
  ADD CONSTRAINT `categoria_anuncio_ibfk_1` FOREIGN KEY (`Categoria`) REFERENCES `categoria` (`Nombre`),
  ADD CONSTRAINT `categoria_anuncio_ibfk_2` FOREIGN KEY (`Anuncio`) REFERENCES `anuncio` (`id`);

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`Autor`) REFERENCES `usuario` (`Nick`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`Anuncio`) REFERENCES `anuncio` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Clase`) REFERENCES `clase` (`Nombre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
