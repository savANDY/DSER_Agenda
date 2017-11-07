-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2017 a las 10:11:32
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dser_agenda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `idContacto` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellidos` varchar(20) NOT NULL,
  `Telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`idContacto`, `Nombre`, `Apellidos`, `Telefono`) VALUES
(1, 'Valeriu Andrei', 'Sanautanu', 651405555),
(2, 'Julen', 'Estivez', 657388421),
(3, 'Andoni', 'Tome', 675885254),
(4, 'Iker', 'Torre', 688255161),
(5, 'Xavi', 'Xavi', 69121254);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emails`
--

CREATE TABLE `emails` (
  `email` varchar(20) NOT NULL,
  `idContacto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `emails`
--

INSERT INTO `emails` (`email`, `idContacto`) VALUES
('andicuu@gmail.com', 1),
('dungulescu@yahoo.com', 1),
('savaleriu@gmail.com', 2),
('andoniando@gmail.com', 3),
('torre@iker.com', 4),
('xavierxavi@gmail.com', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idGrupo` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`idGrupo`, `Nombre`) VALUES
(1, 'Familia'),
(2, 'Amigos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_grupos`
--

CREATE TABLE `rel_grupos` (
  `idGrupo` int(11) NOT NULL,
  `idContacto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rel_grupos`
--

INSERT INTO `rel_grupos` (`idGrupo`, `idContacto`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 2),
(2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `Nombre`) VALUES
(1, 'Viewer'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `username`, `password`, `rol`) VALUES
(1, 'savandy', '$2y$10$NhIf5l/50VwIzJ2wkwmvj.wuGc7w4vqJ4Ub7v39iOYmSURzxmG9pC', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`idContacto`);

--
-- Indices de la tabla `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`email`),
  ADD KEY `contacto` (`idContacto`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idGrupo`);

--
-- Indices de la tabla `rel_grupos`
--
ALTER TABLE `rel_grupos`
  ADD PRIMARY KEY (`idGrupo`,`idContacto`),
  ADD KEY `idGrupo` (`idGrupo`),
  ADD KEY `idContacto` (`idContacto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `idContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`idContacto`) REFERENCES `contactos` (`idContacto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rel_grupos`
--
ALTER TABLE `rel_grupos`
  ADD CONSTRAINT `rel_grupos_ibfk_2` FOREIGN KEY (`idContacto`) REFERENCES `contactos` (`idContacto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_grupos_ibfk_3` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
