-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2017 a las 09:52:59
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `spBorrarContacto` (IN `p_idContacto` INT(11))  NO SQL
BEGIN
 DELETE FROM contactos WHERE idContacto = p_idContacto;
 DELETE FROM emails WHERE idContacto = p_idContacto;
 DELETE FROM rel_grupos WHERE idContacto = p_idContacto;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spDatosPorId` (IN `spIdContacto` INT(11))  NO SQL
BEGIN
select c.idContacto id, c.Nombre, c.Apellidos, c.Telefono, c.Poblacion, group_concat(distinct e.email separator '<br>') Email, group_concat(distinct g.Nombre separator '<br>') as Grupo
            from contactos c, emails e, grupos g, rel_grupos rg
            WHERE (rg.idContacto = c.idContacto) AND (g.idGrupo = rg.idGrupo) AND (e.idContacto = c.idContacto) AND c.idContacto = spIdContacto
            group by c.idContacto order by c.Nombre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertUpdate` (IN `p_nombre` VARCHAR(20), IN `p_apellidos` VARCHAR(20), IN `p_telefono` INT(11), IN `p_poblacion` VARCHAR(30), IN `p_correo1` VARCHAR(50), IN `p_correo2` VARCHAR(50), IN `p_grupo1` INT, IN `p_grupo2` INT, IN `p_grupo3` INT, IN `p_idContacBorrar` INT)  NO SQL
BEGIN
    DECLARE p_idContacto INT;

    IF p_idContacBorrar <> '' THEN
           DELETE FROM contactos WHERE idContacto = p_idContacBorrar;
    END IF;

    INSERT INTO contactos(Nombre, Apellidos, Telefono, Poblacion)                 VALUES (p_nombre,p_apellidos,p_telefono,p_poblacion);

    SET p_idContacto = (SELECT MAX(idContacto) FROM contactos);

    INSERT INTO emails(email,idContacto) 
    VALUES (p_correo1,p_idContacto);

    INSERT INTO rel_grupos(idGrupo,idContacto) 
    VALUES (p_grupo1,p_idContacto);

    IF p_correo2 <> '' THEN
        INSERT INTO emails(email,idContacto) 
        VALUES (p_correo2,p_idContacto);
    END IF;
    IF p_grupo2 <> '' THEN
        INSERT INTO rel_grupos(idGrupo, idContacto) 
        VALUES (p_grupo2,p_idContacto);
    END IF;
    IF p_grupo3 <> '' THEN
        INSERT INTO rel_grupos(idGrupo, idContacto) 
        VALUES (p_grupo3, p_idContacto);
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `idContacto` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellidos` varchar(20) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Poblacion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`idContacto`, `Nombre`, `Apellidos`, `Telefono`, `Poblacion`) VALUES
(2, 'Julen', 'Estivez', 657388421, ''),
(7, 'Flavian', 'Ilici', 651405252, ''),
(10, 'Jon Ander', 'Zabala', 688158751, ''),
(11, 'Hola', 'Hola', 123456789, ''),
(14, 'Iker', 'Torre', 688255162, ''),
(19, 'Valeriu Andrei', 'Sanautanu', 651405555, 'Igorre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emails`
--

CREATE TABLE `emails` (
  `email` varchar(50) NOT NULL,
  `idContacto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `emails`
--

INSERT INTO `emails` (`email`, `idContacto`) VALUES
('savaleriu@gmail.com', 2),
('jonander@gmail.com', 10),
('hola@caracola.com', 11),
('torre@iker.com', 14),
('andicuu@gmail.com', 19),
('dungulescu@yahoo.com', 19);

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
(1, 2),
(1, 10),
(1, 11),
(1, 14),
(1, 19),
(2, 2),
(2, 10),
(2, 11),
(2, 14);

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
(1, 'savandy', '$2y$10$NhIf5l/50VwIzJ2wkwmvj.wuGc7w4vqJ4Ub7v39iOYmSURzxmG9pC', 2),
(2, 'noadmin', '$2y$10$NhIf5l/50VwIzJ2wkwmvj.wuGc7w4vqJ4Ub7v39iOYmSURzxmG9pC', 1);

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
  MODIFY `idContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
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
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
