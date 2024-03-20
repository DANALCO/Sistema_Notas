SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Secundaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ACTIVIDAD`
--

CREATE TABLE `ACTIVIDAD` (
  `actividad_id` int(11) NOT NULL,
  `nombre_actividad` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ALUMNOS`
--

CREATE TABLE `ALUMNOS` (
  `alumno_id` int(11) NOT NULL,
  `nombre_alumno` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fecha_nac` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AULAS`
--

CREATE TABLE `AULAS` (
  `aula_id` int(11) NOT NULL,
  `nombre_aula` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CALIFICACIONES`
--

CREATE TABLE `CALIFICACIONES` (
  `calificacion_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GRADOS`
--

CREATE TABLE `GRADOS` (
  `grado_id` int(11) NOT NULL,
  `nombre_grado` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MATERIAS`
--

CREATE TABLE `MATERIAS` (
  `materia_id` int(11) NOT NULL,
  `nombre_materia` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `NOTAS`
--

CREATE TABLE `NOTAS` (
  `nota_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `valor_nota` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PERIODOS`
--

CREATE TABLE `PERIODOS` (
  `periodo_id` int(11) NOT NULL,
  `nombre_periodo` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROCESOALUMNO`
--

CREATE TABLE `PROCESOALUMNO` (
  `procesoa_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `proceso_id` int(11) NOT NULL,
  `estadop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROCESOPROFESOR`
--

CREATE TABLE `PROCESOPROFESOR` (
  `proceso_id` int(11) NOT NULL,
  `grado_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROFESOR`
--

CREATE TABLE `PROFESOR` (
  `profesor_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `nivel_est` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ROL`
--

CREATE TABLE `ROL` (
  `rol_id` int(11) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ROL`
--

INSERT INTO `ROL` (`rol_id`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Asistente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`usuario_id`, `nombre`, `usuario`, `clave`, `rol`, `estado`) VALUES
(1, 'Luis Noguera', 'admin', '$2y$10$0R6PdfuFhC', 1, 1),
(2, 'Jesus Mireles', 'jesus1', '$2y$10$jCtsfOfFwiKBwKvESViukuA0YSg4W3MbZIJTQNmDx.au2EqDXBtv.', 2, 0),
(3, 'Andres', 'andres1', '$2y$10$NRNhbzPgwxb8TKqrVqZopu7Pwe.9eJVtK7srAcJWSSAtGXKv03nx.', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ACTIVIDAD`
--
ALTER TABLE `ACTIVIDAD`
  ADD PRIMARY KEY (`actividad_id`);

--
-- Indices de la tabla `ALUMNOS`
--
ALTER TABLE `ALUMNOS`
  ADD PRIMARY KEY (`alumno_id`);

--
-- Indices de la tabla `AULAS`
--
ALTER TABLE `AULAS`
  ADD PRIMARY KEY (`aula_id`);

--
-- Indices de la tabla `CALIFICACIONES`
--
ALTER TABLE `CALIFICACIONES`
  ADD PRIMARY KEY (`calificacion_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `GRADOS`
--
ALTER TABLE `GRADOS`
  ADD PRIMARY KEY (`grado_id`);

--
-- Indices de la tabla `MATERIAS`
--
ALTER TABLE `MATERIAS`
  ADD PRIMARY KEY (`materia_id`);

--
-- Indices de la tabla `NOTAS`
--
ALTER TABLE `NOTAS`
  ADD PRIMARY KEY (`nota_id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `actividad_id` (`actividad_id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `PERIODOS`
--
ALTER TABLE `PERIODOS`
  ADD PRIMARY KEY (`periodo_id`);

--
-- Indices de la tabla `PROCESOALUMNO`
--
ALTER TABLE `PROCESOALUMNO`
  ADD PRIMARY KEY (`procesoa_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `proceso_id` (`proceso_id`);

--
-- Indices de la tabla `PROCESOPROFESOR`
--
ALTER TABLE `PROCESOPROFESOR`
  ADD PRIMARY KEY (`proceso_id`),
  ADD KEY `grado_id` (`grado_id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `PROFESOR`
--
ALTER TABLE `PROFESOR`
  ADD PRIMARY KEY (`profesor_id`);

--
-- Indices de la tabla `ROL`
--
ALTER TABLE `ROL`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ACTIVIDAD`
--
ALTER TABLE `ACTIVIDAD`
  MODIFY `actividad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ALUMNOS`
--
ALTER TABLE `ALUMNOS`
  MODIFY `alumno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `AULAS`
--
ALTER TABLE `AULAS`
  MODIFY `aula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `CALIFICACIONES`
--
ALTER TABLE `CALIFICACIONES`
  MODIFY `calificacion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `GRADOS`
--
ALTER TABLE `GRADOS`
  MODIFY `grado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `MATERIAS`
--
ALTER TABLE `MATERIAS`
  MODIFY `materia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `NOTAS`
--
ALTER TABLE `NOTAS`
  MODIFY `nota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `PERIODOS`
--
ALTER TABLE `PERIODOS`
  MODIFY `periodo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `PROCESOALUMNO`
--
ALTER TABLE `PROCESOALUMNO`
  MODIFY `procesoa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `PROCESOPROFESOR`
--
ALTER TABLE `PROCESOPROFESOR`
  MODIFY `proceso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `PROFESOR`
--
ALTER TABLE `PROFESOR`
  MODIFY `profesor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ROL`
--
ALTER TABLE `ROL`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `NOTAS`
--
ALTER TABLE `NOTAS`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`materia_id`) REFERENCES `MATERIAS` (`materia_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`alumno_id`) REFERENCES `ALUMNOS` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_3` FOREIGN KEY (`actividad_id`) REFERENCES `ACTIVIDAD` (`actividad_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_ibfk_4` FOREIGN KEY (`periodo_id`) REFERENCES `PERIODOS` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `PROCESOALUMNO`
--
ALTER TABLE `PROCESOALUMNO`
  ADD CONSTRAINT `procesoalumno_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `ALUMNOS` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `procesoalumno_ibfk_2`FOREIGN KEY (`proceso_id`) REFERENCES `PROCESOPROFESOR` (`proceso_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `PROCESOPROFESOR`
--
ALTER TABLE `PROCESOPROFESOR`
  ADD CONSTRAINT `procesoprofesor_ibfk_1` FOREIGN KEY (`aula_id`) REFERENCES `AULAS` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `procesoprofesor_ibfk_2` FOREIGN KEY (`grado_id`) REFERENCES `GRADOS` (`grado_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `procesoprofesor_ibfk_3` FOREIGN KEY (`profesor_id`) REFERENCES `PROFESOR` (`profesor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `ROL` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


