-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2023 a las 10:48:22
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

--
-- Volcado de datos para la tabla `anuncio`
--

INSERT INTO `anuncio` (`id`, `Título`, `Autor`, `Aceptado`, `Fecha_publi`, `Descripción`, `Imagen`) VALUES
(14, 'Talleres de Verano para Niños', 'Dani', 1, '2023-10-20', '¿Buscas actividades educativas y divertidas para tus hijos durante las vacaciones de verano? ¡Tenemos la solución! Únete a nuestros talleres de verano llenos de diversión, aprendizaje y creatividad.', 'administracion1-1024x683.jpg'),
(15, 'Charla Gratuita sobre Orientación Vocacional', 'Dani', 1, '2023-10-20', 'Estás indeciso acerca de tu futuro académico y profesional? Únete a nuestra charla gratuita sobre orientación vocacional, donde te ayudaremos a descubrir tus pasiones y metas educativas.', 'marketing-1024x683.jpg'),
(16, 'Seminario de Tecnología Educativa', 'Dani', 1, '2023-10-20', 'Descubre las últimas tendencias en tecnología educativa en nuestro seminario exclusivo. Aprende cómo la tecnología puede transformar la enseñanza y el aprendizaje en el aula.', 'Comercio_chicas-scaled.jpg'),
(17, 'Clases de Idiomas para Todos los Niveles', 'Dani', 1, '2023-10-20', '¿Quieres aprender un nuevo idioma o mejorar tus habilidades lingüísticas? Ofrecemos clases de idiomas para principiantes y estudiantes avanzados. Ven y sumérgete en una experiencia de aprendizaje multicultural.', 'quimica2-1024x683.jpg'),
(18, 'Programa de Becas Académicas', 'Dani', 1, '2023-10-20', 'Nos enorgullece anunciar nuestro programa de becas académicas. Brindamos oportunidades de financiamiento para estudiantes talentosos que deseen alcanzar sus metas académicas. ¡Aplica hoy y persigue tus sueños!', 'electronica1-1024x683.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`Nombre`) VALUES
('Eventos'),
('Exámenes'),
('Fechas Importantes'),
('Noticias'),
('Servicios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_anuncio`
--

CREATE TABLE `categoria_anuncio` (
  `Categoria` varchar(50) NOT NULL,
  `Anuncio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria_anuncio`
--

INSERT INTO `categoria_anuncio` (`Categoria`, `Anuncio`) VALUES
('Eventos', 14),
('Eventos', 15),
('Fechas Importantes', 16),
('Servicios', 17),
('Servicios', 18);

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
  `Texto` text NOT NULL,
  `Validado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `Autor`, `Anuncio`, `Texto`, `Validado`) VALUES
(11, 'Dani', 18, 'Muy interesante!', 1),
(13, 'Dani', 17, 'hasta cuando me puedo apuntar?', 1),
(14, 'Dani', 15, 'como me apunto?', 1),
(15, 'Dani', 14, 'me apunto!', 0),
(16, 'Dani', 16, 'que interesante!', 0);

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
('Alumno', 'Alumno', 'Estudiante', 'Alumno', 1, 'alumno', 'alumno@mail.com', '2023-10-20', '2dw3a', ''),
('Ander', 'Ander', 'Tapia', 'Administrador', 1, 'admin', 'ander@mail.com', '2003-03-02', '2dw3a', ''),
('Carmen', 'Carmen', 'Gabiola', 'Administrador', 1, 'admin', 'carmengabiola@gmail.com', '2003-07-07', '2dw3a', ''),
('Dani', 'Daniel', 'Souchar', 'Administrador', 1, 'admin', 'dani@mail.com', '1998-11-09', '2dw3a', ''),
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
