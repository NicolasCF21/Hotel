-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2023 a las 03:58:11
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_administrador` int(11) NOT NULL,
  `email` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_administrador`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'HwnctaM=');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo_empleado`
--

CREATE TABLE `cargo_empleado` (
  `id_cargo_empleado` int(11) NOT NULL,
  `cargo_empleado` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cargo_empleado`
--

INSERT INTO `cargo_empleado` (`id_cargo_empleado`, `cargo_empleado`) VALUES
(1, 'Recepcionista'),
(2, 'Gobernata'),
(4, ' Botones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_servicio`
--

CREATE TABLE `categoria_servicio` (
  `id_categoria_servicio` int(11) NOT NULL,
  `categoria_servicio` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria_servicio`
--

INSERT INTO `categoria_servicio` (`id_categoria_servicio`, `categoria_servicio`) VALUES
(1, 'Restaurante'),
(2, 'Parqueadero'),
(3, 'Bar'),
(4, 'Salones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `id_cargo_empleado` int(11) NOT NULL,
  `id_turno_empleados` int(11) NOT NULL,
  `nombre_empleado` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_empleado` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `sueldo` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `id_cargo_empleado`, `id_turno_empleados`, `nombre_empleado`, `apellido_empleado`, `documento`, `telefono`, `correo`, `sueldo`) VALUES
(1, 1, 2, 'David', 'Fernandez', '1002314097', '3112780162', 'david@gmail.com', '1200000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id_habitacion` int(6) NOT NULL,
  `id_tipo_habitacion` int(11) NOT NULL,
  `nombre_habitacion` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_habitacion` text COLLATE utf8_spanish_ci NOT NULL,
  `cantidad_personas` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `estado_habitacion` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `precio_habitacion` int(11) NOT NULL,
  `imagen_habitacion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id_habitacion`, `id_tipo_habitacion`, `nombre_habitacion`, `descripcion_habitacion`, `cantidad_personas`, `estado_habitacion`, `precio_habitacion`, `imagen_habitacion`) VALUES
(1, 1, 'Habitación 101         ', 'Una habitación ideal para quienes viajan solos y que además buscan tener un lugar tranquilo para descansar de sus viajes.En ellas tendrán a su alcance todos los servicios del hotel para una estancia agradable y confortable.              ', '1', 'Disponible', 50000, '../imgHabitaciones/h1.jpg'),
(2, 2, 'Habitación 102', 'Una de las opciones mas económicas y simples, pero perfecta para la relajación y el descanso. Nuestras habitaciones estándar ofrecen a nuestro huésped una selecta variedad de servicios e inigualable confort. ', '1', 'Disponible', 55000, '../imgHabitaciones/h2.jpg'),
(3, 3, 'Habitación 103', 'Nuestras habitaciones dobles disponen ya sea de una cama matrimonial o de camas gemelas. Son bastante espaciosas e iluminadas para ofrecerle una vacación de calidad. Esta habitación cuenta con un espacio perfecto para dos personas que busquen comodidad y tranquilidad. ', '2', 'Disponible', 65000, '../imgHabitaciones/h-12.jpg'),
(4, 4, 'Habitación 104 ', 'La habitación con mas espacio y comodidad, ideal para familias de hasta 5 personas, además cuenta con balcón privado con vista hacia la calle. Amplias y confortables habitaciones totalmente equipadas. Estas cómodas habitaciones familiares te permitirán tener una estancia agradable. ', '5', 'Disponible', 90000, '../imgHabitaciones/h8.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservacion`
--

CREATE TABLE `reservacion` (
  `id_reservacion` int(6) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `fecha_reservacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `cantidad_personas` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `estado_reservacion` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `forma_pago` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `total_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reservacion`
--

INSERT INTO `reservacion` (`id_reservacion`, `id_usuario`, `id_habitacion`, `id_servicio`, `fecha_reservacion`, `fecha_ingreso`, `fecha_salida`, `cantidad_personas`, `estado_reservacion`, `forma_pago`, `total_pago`) VALUES
(1, 1, 1, 1, '2022-12-06 12:18:00', '2022-12-06', '2022-12-08', '2', 'Cancelada', 'En linea-Tarjeta', 160000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(6) NOT NULL,
  `id_habitacion` int(6) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `nombres` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `cant_personas` int(6) NOT NULL,
  `total_pago` decimal(8,3) NOT NULL,
  `estado_reservacion` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `id_categoria_servicio` int(11) NOT NULL,
  `nombre_servicio` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_servicio` text COLLATE utf8_spanish_ci NOT NULL,
  `tarifa_servicio` int(11) NOT NULL,
  `imagen_servicio` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `id_categoria_servicio`, `nombre_servicio`, `descripcion_servicio`, `tarifa_servicio`, `imagen_servicio`) VALUES
(1, 1, 'Desayuno             ', 'Inicie el día de la mejor manera despertando tus sentidos con un completo desayuno, ofrecemos desde frutas típicas hasta platos calientes que garantizan opciones para todos los gustos    ', 15000, '../imgServicios/r1.jpg'),
(2, 1, 'Almuerzo    ', 'Nuestros Restaurantes asociados son los lugares ideales para compartir y degustar la mejor experiencia culinaria.  Disfruta junto a tu familia o amigos de sus excelentes cartas con los mejores platos de la gastronomía local', 25000, '../imgServicios/r2.jpg'),
(3, 2, 'Parqueadero          ', 'El hotel cuenta con parqueadero interno privado, el cual te permitirá guardar tu auto de forma segura.  Este servicio esta sujeto a disponibilidad  ', 0, '../imgServicios/S3.jpg'),
(4, 3, 'Bar    ', 'Un rincón con un ambiente íntimo y acogedor ideal para encuentros privados, reuniones sociales o simplemente para relajarse tomando su bebida preferida. El lugar perfecto para disfrutar de momentos agradables, un trago de negocios o una cita romántica. ', 0, '../imgServicios/b3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE `tipo_habitacion` (
  `id_tipo_habitacion` int(11) NOT NULL,
  `tipo_habitacion` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`id_tipo_habitacion`, `tipo_habitacion`) VALUES
(1, 'Individual'),
(2, 'Estandar'),
(3, 'Doble'),
(4, 'Familiar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos_empleados`
--

CREATE TABLE `turnos_empleados` (
  `id_turno_empleados` int(11) NOT NULL,
  `jornada` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `entrada` time NOT NULL,
  `salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `turnos_empleados`
--

INSERT INTO `turnos_empleados` (`id_turno_empleados`, `jornada`, `entrada`, `salida`) VALUES
(1, 'Mañana', '07:00:00', '15:00:00'),
(2, 'Tarde', '15:00:00', '23:00:00'),
(3, 'Noche', '23:00:00', '07:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(6) NOT NULL,
  `nombre_usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `documento`, `telefono`, `email`, `password`, `fecha_reg`) VALUES
(1, 'Juan Pablo', 'Pérez Piñeros', '94967236', '3204567907', 'Juan@gmail.com', 'HwnctaM=', '2022-12-06 01:42:30'),
(2, 'Laura', 'Rodriguez', '89567230', '3112780162', 'laura@gmail.com', 'Gw/cs6c=', '2022-11-29 23:40:40'),
(3, 'Pedro', 'Mora', '76825076', '3218905618', 'pedro@gmail.com', 'T16G7uM=', '2022-11-24 01:55:22'),
(4, 'Camila', 'Fernandez', '1006785373', '3245806754', 'camila@gmail.com', 'W1SG5Pc=', '2022-11-24 01:55:57'),
(5, 'Nicolas', 'Castañeda', '1002314097', '3112780162', 'nicolascas2102@gmail.com', 'HwnctaM=', '2022-12-05 23:52:34'),
(6, 'David', 'Fernandez', '1006785373', '3143614897', 'david@gmail.com', 'Gw/cs6c=', '2022-12-05 23:54:30'),
(7, 'Matias', 'Castañeda', '1006785373', '3217450976', 'matias@gmail.com', 'HwnctQ==', '2022-12-05 23:55:54'),
(8, 'Sara', 'Lopez', '76825076', '3204567905', 'sara@gmail.com', 'Gw/cs6c=', '2022-12-06 00:36:49');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_administrador`);

--
-- Indices de la tabla `cargo_empleado`
--
ALTER TABLE `cargo_empleado`
  ADD PRIMARY KEY (`id_cargo_empleado`);

--
-- Indices de la tabla `categoria_servicio`
--
ALTER TABLE `categoria_servicio`
  ADD PRIMARY KEY (`id_categoria_servicio`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_cargo_empleado` (`id_cargo_empleado`),
  ADD KEY `id_turno_empleados` (`id_turno_empleados`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`id_habitacion`),
  ADD KEY `id_tipo_habitacion` (`id_tipo_habitacion`);

--
-- Indices de la tabla `reservacion`
--
ALTER TABLE `reservacion`
  ADD PRIMARY KEY (`id_reservacion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_servicio` (`id_servicio`),
  ADD KEY `id_habitacion` (`id_habitacion`) USING BTREE;

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_habitacion` (`id_habitacion`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `id_categoria_servicio` (`id_categoria_servicio`);

--
-- Indices de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  ADD PRIMARY KEY (`id_tipo_habitacion`);

--
-- Indices de la tabla `turnos_empleados`
--
ALTER TABLE `turnos_empleados`
  ADD PRIMARY KEY (`id_turno_empleados`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cargo_empleado`
--
ALTER TABLE `cargo_empleado`
  MODIFY `id_cargo_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categoria_servicio`
--
ALTER TABLE `categoria_servicio`
  MODIFY `id_categoria_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `id_habitacion` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reservacion`
--
ALTER TABLE `reservacion`
  MODIFY `id_reservacion` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `id_tipo_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `turnos_empleados`
--
ALTER TABLE `turnos_empleados`
  MODIFY `id_turno_empleados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_cargo_empleado`) REFERENCES `cargo_empleado` (`id_cargo_empleado`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`id_turno_empleados`) REFERENCES `turnos_empleados` (`id_turno_empleados`);

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tipo_habitacion` (`id_tipo_habitacion`);

--
-- Filtros para la tabla `reservacion`
--
ALTER TABLE `reservacion`
  ADD CONSTRAINT `reservacion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `reservacion_ibfk_2` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id_habitacion`),
  ADD CONSTRAINT `reservacion_ibfk_3` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`id_categoria_servicio`) REFERENCES `categoria_servicio` (`id_categoria_servicio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
