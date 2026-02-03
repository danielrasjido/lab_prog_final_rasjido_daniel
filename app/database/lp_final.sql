-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-02-2026 a las 21:45:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lp_final`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPelicula` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `fechaHora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `idUsuario`, `idPelicula`, `comentario`, `fechaHora`) VALUES
(1, 3, 1, 'Muy buena película, la recomiendo.', '2024-08-11 10:30:00'),
(2, 4, 1, 'Me gustó la historia y los efectos.', '2024-08-11 12:15:00'),
(3, 4, 2, 'Interesante pero un poco lenta.', '2024-08-13 09:45:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `idEntrada` int(11) NOT NULL,
  `idFuncion` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaHora` datetime NOT NULL,
  `anulada` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`idEntrada`, `idFuncion`, `idUsuario`, `fechaHora`, `anulada`) VALUES
(1, 1, 3, '2024-08-10 18:45:00', 0),
(2, 1, 4, '2024-08-10 18:50:00', 0),
(3, 2, 3, '2024-08-11 17:30:00', 0),
(4, 3, 4, '2024-08-12 20:10:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

CREATE TABLE `funciones` (
  `idFuncion` int(11) NOT NULL,
  `idPelicula` int(11) NOT NULL,
  `idProgramacion` int(11) NOT NULL,
  `idSala` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`idFuncion`, `idPelicula`, `idProgramacion`, `idSala`, `precio`, `fecha`, `hora`) VALUES
(1, 1, 1, 1, 3500.00, '2024-08-10', '20:00:00'),
(2, 1, 1, 2, 3000.00, '2024-08-11', '18:30:00'),
(3, 2, 1, 1, 3800.00, '2024-08-12', '21:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `idPelicula` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `tituloOriginal` varchar(150) DEFAULT NULL,
  `duracion` int(11) NOT NULL,
  `fechaEstreno` date DEFAULT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  `fechaIngreso` date NOT NULL,
  `sitioWeb` varchar(255) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `imagenCartelera` varchar(255) DEFAULT NULL,
  `actores` text DEFAULT NULL,
  `genero` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `idiomas` varchar(100) DEFAULT NULL,
  `calificacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`idPelicula`, `nombre`, `tituloOriginal`, `duracion`, `fechaEstreno`, `disponibilidad`, `fechaIngreso`, `sitioWeb`, `sinopsis`, `imagenCartelera`, `actores`, `genero`, `pais`, `idiomas`, `calificacion`) VALUES
(1, 'El Viaje Final', 'The Final Journey', 125, '2022-06-15', 1, '2024-08-01', 'https://www.elviajefinal.com', 'Una aventura épica sobre el destino y la redención.', 'viaje_final.jpg', 'Actor Uno, Actor Dos', 'Aventura', 'Estados Unidos', 'Español, Inglés', 'ATP'),
(2, 'Sombras del Pasado', 'Shadows of the Past', 110, '2021-10-20', 1, '2024-08-05', 'https://www.sombrasdelpasado.com', 'Un thriller psicológico lleno de misterio.', 'sombras_pasado.jpg', 'Actor Tres, Actor Cuatro', 'Thriller', 'Argentina', 'Español', '+13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `idPerfil` int(11) NOT NULL,
  `perfil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`idPerfil`, `perfil`) VALUES
(1, 'ADMINISTRADOR'),
(3, 'EXTERNO'),
(2, 'OPERADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion`
--

CREATE TABLE `programacion` (
  `idProgramacion` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programacion`
--

INSERT INTO `programacion` (`idProgramacion`, `fechaInicio`, `fechaFin`) VALUES
(1, '2024-08-10', '2024-08-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `idSala` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`idSala`, `capacidad`, `estado`) VALUES
(1, 120, 1),
(2, 80, 1),
(3, 60, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `idPerfil` int(11) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cuenta` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `resetPassword` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `idPerfil`, `apellido`, `nombre`, `cuenta`, `password`, `correo`, `resetPassword`) VALUES
(1, 1, 'Rasjido', 'Daniel', 'dani.rasjido', '$2y$10$hash_admin', 'admin@cine.com', 0),
(2, 2, 'Gomez', 'Laura', 'lauri.gomez', '$2y$10$hash_operador', 'operador@cine.com', 0),
(3, 3, 'Perez', 'Juan', 'juanceto01', '$2y$10$hash_cliente', 'cliente1@gmail.com', 0),
(4, 3, 'Lopez', 'Maria', 'marita', '$2y$10$hash_cliente', 'cliente2@gmail.com', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `fk_comentario_usuario` (`idUsuario`),
  ADD KEY `fk_comentario_pelicula` (`idPelicula`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`idEntrada`),
  ADD KEY `fk_entrada_funcion` (`idFuncion`),
  ADD KEY `fk_entrada_usuario` (`idUsuario`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`idFuncion`),
  ADD KEY `fk_funcion_pelicula` (`idPelicula`),
  ADD KEY `fk_funcion_programacion` (`idProgramacion`),
  ADD KEY `fk_funcion_sala` (`idSala`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`idPelicula`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`idPerfil`),
  ADD UNIQUE KEY `perfil` (`perfil`);

--
-- Indices de la tabla `programacion`
--
ALTER TABLE `programacion`
  ADD PRIMARY KEY (`idProgramacion`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`idSala`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_usuario_perfil` (`idPerfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `funciones`
--
ALTER TABLE `funciones`
  MODIFY `idFuncion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `idPelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `idPerfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `programacion`
--
ALTER TABLE `programacion`
  MODIFY `idProgramacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentario_pelicula` FOREIGN KEY (`idPelicula`) REFERENCES `peliculas` (`idPelicula`),
  ADD CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_entrada_funcion` FOREIGN KEY (`idFuncion`) REFERENCES `funciones` (`idFuncion`),
  ADD CONSTRAINT `fk_entrada_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD CONSTRAINT `fk_funcion_pelicula` FOREIGN KEY (`idPelicula`) REFERENCES `peliculas` (`idPelicula`),
  ADD CONSTRAINT `fk_funcion_programacion` FOREIGN KEY (`idProgramacion`) REFERENCES `programacion` (`idProgramacion`),
  ADD CONSTRAINT `fk_funcion_sala` FOREIGN KEY (`idSala`) REFERENCES `salas` (`idSala`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_perfil` FOREIGN KEY (`idPerfil`) REFERENCES `perfiles` (`idPerfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
