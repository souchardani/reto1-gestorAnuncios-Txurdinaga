-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2023 a las 10:32:53
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
-- Base de datos: `gestor_de_anuncios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `datetime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `creador` varchar(50) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`datetime`, `username`, `contrasena`, `admin_name`, `creador`, `id`) VALUES
('2023-10-18 08:40:42', 'carmen', 'admin', 'carmen', 'admin', 2),
('2023-10-18 08:40:56', 'admin', 'admin', 'dani', 'admin', 3),
('2023-10-18 08:41:02', 'ander', 'admin', 'ander', 'admin', 4),
('2023-10-18 08:41:11', 'andres', 'admin', 'andres', 'admin', 5),
('2023-10-18 08:50:58', 'daniel', 'admin', 'Daniel', 'ander', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `titulo` varchar(300) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `descripcion` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id`, `datetime`, `titulo`, `categoria`, `autor`, `imagen`, `descripcion`) VALUES
(25, '2023-10-08 23:29:33', 'Talleres de Verano para Niños', 'fechas importantes', 'Daniel', 'administracion1-1024x683.jpg', '¿Buscas actividades educativas y divertidas para tus hijos durante las vacaciones de verano? ¡Tenemos la solución! Únete a nuestros talleres de verano llenos de diversión, aprendizaje y creatividad.'),
(27, '2023-10-08 23:31:48', 'Charla Gratuita sobre Orientación Vocacional', 'destacados', 'Daniel', 'marketing-1024x683.jpg', 'Estás indeciso acerca de tu futuro académico y profesional? Únete a nuestra charla gratuita sobre orientación vocacional, donde te ayudaremos a descubrir tus pasiones y metas educativas.'),
(28, '2023-10-08 23:32:03', 'Seminario de Tecnología Educativa', 'ferias educativas', 'Daniel', 'Comercio_chicas-scaled.jpg', 'Descubre las últimas tendencias en tecnología educativa en nuestro seminario exclusivo. Aprende cómo la tecnología puede transformar la enseñanza y el aprendizaje en el aula.'),
(29, '2023-10-08 23:32:15', 'Clases de Idiomas para Todos los Niveles', 'ferias educativas', 'Daniel', 'quimica2-1024x683.jpg', '¿Quieres aprender un nuevo idioma o mejorar tus habilidades lingüísticas? Ofrecemos clases de idiomas para principiantes y estudiantes avanzados. Ven y sumérgete en una experiencia de aprendizaje multicultural.'),
(30, '2023-10-08 23:32:29', 'Programa de Becas Académicas', 'fechas importantes', 'Daniel', 'electronica1-1024x683.jpg', 'Nos enorgullece anunciar nuestro programa de becas académicas. Brindamos oportunidades de financiamiento para estudiantes talentosos que deseen alcanzar sus metas académicas. ¡Aplica hoy y persigue tus sueños!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `titulo`, `autor`, `datetime`) VALUES
(2, 'deportes', 'Daniel', '2023-10-06 22:35:52'),
(3, 'eventos', 'Daniel', '2023-10-06 22:36:00'),
(4, 'festividades', 'Daniel', '2023-10-06 22:36:03'),
(5, 'fechas importantes', 'Daniel', '2023-10-06 22:36:12'),
(6, 'destacados', 'Daniel', '2023-10-06 22:59:27'),
(7, 'ferias educativas', 'Daniel', '2023-10-07 00:43:21'),
(8, 'Noticias', 'admin', '2023-10-18 08:41:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `cuerpo` varchar(500) NOT NULL,
  `aprobadopor` varchar(30) NOT NULL,
  `publicado` varchar(30) NOT NULL,
  `id_anuncio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `datetime`, `nombre`, `email`, `cuerpo`, `aprobadopor`, `publicado`, `id_anuncio`) VALUES
(3, '2023-10-09 00:47:45', 'daniel', 'dani@mail.com', 'sdfsdf', '', '', 0),
(4, '2023-10-09 00:52:24', 'sdafsdf', 'dani@mail.comsda', 'fsdafsdfsdaffds', '', '', 0),
(5, '2023-10-09 00:55:07', 'sdafsdf', 'dani@mail.comsda', 'fsdafsdfsdaffds', '', '', 0),
(6, '2023-10-09 00:55:15', 'danie', 'dani@fds.com', 'dsdfafds', '', '', 0),
(7, '2023-10-09 00:57:05', 'sadasd', 'asdasd@mail.com', 'dadfgdsfg', '', '', 0),
(8, '2023-10-09 01:01:01', 'danie', 'dani@mail.com', 'dsfadfsg', '', '', 0),
(12, '2023-10-18 08:41:58', 'Daniel', 'dani@mail.com', 'Muy interesante!', 'admin', 'SI', 30),
(13, '2023-10-18 08:42:13', 'Ander', 'ander@mail.com', 'Me ha gustado mucho!', 'Pendiente', 'NO', 30),
(14, '2023-10-18 08:42:30', 'Andres', 'andres@mail.com', 'Cuando empiezan?', 'Pendiente', 'NO', 29),
(15, '2023-10-18 08:42:48', 'carmen', 'carmen@mail.com', 'me apunto!', 'admin', 'SI', 28),
(16, '2023-10-18 08:43:49', 'Carlos', 'jose@mail.com', 'cuanto dura?', 'admin', 'SI', 27),
(17, '2023-10-18 08:44:03', 'Juan', 'juan@mail.com', 'donde se imparte la charla?', 'Pendiente', 'NO', 27),
(18, '2023-10-18 08:44:49', 'carmen', 'carmen@mail.com', 'donde son las inscripcciones?', 'admin', 'SI', 25),
(19, '2023-10-18 08:45:06', 'ander', 'ander@mail.com', 'que interesante!', 'admin', 'SI', 25),
(20, '2023-10-18 08:45:32', 'Daniel', 'dani@mail.com', 'hasta cuando me puedo apuntar?', 'admin', 'SI', 25),
(21, '2023-10-18 08:46:42', 'Eneritz', 'eneritz@mail.com', 'como me apunto?', 'Pendiente', 'NO', 30);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
