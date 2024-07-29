-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2023 a las 22:39:48
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
(2, 'Botones'),
(3, 'Personal de limpieza'),
(4, 'Electrico'),
(5, 'Limpiador');

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
(1, 'Restaurante          '),
(2, 'Estacionamiento'),
(3, 'Bar'),
(4, 'Salones'),
(5, 'Sin servicio'),
(6, 'bares'),
(7, 'baress');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `id_cargo_empleado` int(11) NOT NULL,
  `id_turno_empleados` int(11) NOT NULL,
  `id_tipo_contrato` int(11) NOT NULL,
  `nombre_empleado` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_empleado` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `sueldo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `id_cargo_empleado`, `id_turno_empleados`, `id_tipo_contrato`, `nombre_empleado`, `apellido_empleado`, `documento`, `telefono`, `correo`, `sueldo`, `estado`) VALUES
(1, 1, 1, 1, 'Sergio', 'Fernandez              ', '23623085', '321890561', 'sergio@gmail.com', '1200000', 'Activo'),
(3, 1, 2, 1, 'Juan', 'Perez  ', '94967236', '3204567905', 'juan@gmail.com', '1', 'activo'),
(4, 4, 1, 1, 'Juan', 'Perez', '9496721316', '3112780162', 'juana@gmail.com', '1000000', 'activo'),
(5, 1, 1, 1, 'Pedro', 'Torres', '94967232', '3125758291', 'pedro@gmail.com', '200000', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_habitacion`
--

CREATE TABLE `estado_habitacion` (
  `id_estado` int(11) NOT NULL,
  `estado_habitacion` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado_habitacion`
--

INSERT INTO `estado_habitacion` (`id_estado`, `estado_habitacion`) VALUES
(1, 'Disponible'),
(2, 'En uso'),
(3, 'En limpieza'),
(4, 'En mantenimiento'),
(5, 'Reservada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id_habitacion` int(6) NOT NULL,
  `id_tipo_habitacion` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_temporada` int(11) NOT NULL,
  `nombre_habitacion` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_habitacion` text COLLATE utf8_spanish_ci NOT NULL,
  `cantidad_personas` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `precio_Tb` int(11) NOT NULL,
  `precio_Ta` int(11) NOT NULL,
  `imagen_habitacion` text COLLATE utf8_spanish_ci NOT NULL,
  `cant_reservas` int(11) NOT NULL,
  `id_promocion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id_habitacion`, `id_tipo_habitacion`, `id_estado`, `id_temporada`, `nombre_habitacion`, `descripcion_habitacion`, `cantidad_personas`, `precio_Tb`, `precio_Ta`, `imagen_habitacion`, `cant_reservas`, `id_promocion`) VALUES
(1, 1, 2, 5, 'Habitación 101           ', 'Una habitación ideal para quienes viajan solos y que además buscan tener un lugar tranquilo para descansar de sus viajes. En ellas tendrán a su alcance todos los servicios del hotel para una estancia agradable y confortable.                 ', '1', 30000, 40000, '../imgHabitaciones/h1.jpg', 4, NULL),
(2, 2, 1, 5, 'Habitación 102', 'Una de las opciones más económicas y simples, pero perfecta para la relajación y el descanso. Nuestras habitaciones estándar ofrecen a nuestro huésped una selecta variedad de servicios e inigualable confort.', '2', 35000, 45000, '../imgHabitaciones/h2.jpg', 1, NULL),
(3, 3, 5, 5, 'Habitación 103', 'Nuestras habitaciones dobles disponen ya sea de una cama matrimonial o de camas gemelas. Son bastante espaciosas e iluminadas para ofrecerle una vacación de calidad. Esta habitación cuenta con un espacio perfecto para dos personas que busquen comodidad y tranquilidad.', '2', 40000, 50000, '../imgHabitaciones/h3.jpg', 3, NULL),
(4, 4, 1, 5, 'Habitación 104 ', 'La habitación con más espacio y comodidad, ideal para familias de hasta 4 personas, además cuenta con balcón privado con vista hacia la calle. Amplias y confortables habitaciones totalmente equipadas. Estas cómodas habitaciones familiares te permitirán tener una estancia agradable.', '4', 50000, 60000, '../imgHabitaciones/h4.jpg', 1, NULL),
(5, 1, 1, 5, 'Habitación 105', 'Especial para 2 personas ', '1', 30000, 40000, '../imgHabitaciones/h8.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `id_habitacion`, `id_producto`, `cantidad`) VALUES
(1, 1, 2, 11),
(2, 2, 1, 6),
(3, 3, 1, 1),
(4, 1, 3, 10),
(5, 1, 5, 1),
(6, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opiniones`
--

CREATE TABLE `opiniones` (
  `id_opinion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `opinion` text COLLATE utf8_spanish_ci NOT NULL,
  `calificacion` decimal(10,1) NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `opiniones`
--

INSERT INTO `opiniones` (`id_opinion`, `id_usuario`, `opinion`, `calificacion`, `fecha_reg`) VALUES
(17, 4, 'Buen servicio', '4.5', '2023-04-12 23:33:39'),
(18, 4, '¡Que buen servicio!', '4.0', '2023-04-16 17:24:31'),
(21, 4, 'l', '2.0', '2023-04-16 17:52:22'),
(22, 4, 'Habitaciones amplias, buena ubicación y un ambiente pacifico', '4.5', '2023-05-03 01:02:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `cantidad_producto`) VALUES
(1, 'Toallas                  ', 2),
(2, 'Cobijas          ', 1),
(3, 'Jabones        ', 1),
(4, 'Shampoo  ', 8),
(5, 'Escobas', 1),
(6, 'Endredones  ', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id_promocion` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `nombre_prom` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `descuento` int(11) NOT NULL,
  `estado` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id_promocion`, `id_habitacion`, `nombre_prom`, `descripcion`, `fecha_inicio`, `fecha_fin`, `descuento`, `estado`, `imagen`) VALUES
(2, 3, 'Fin de descuento', 'Aprovecha esta nueva promocion      ', '2023-04-29', '2023-04-30', 15, 'Finalizada', './img/desc.jpg');

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
  `forma_pago` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `total_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reservacion`
--

INSERT INTO `reservacion` (`id_reservacion`, `id_usuario`, `id_habitacion`, `id_servicio`, `fecha_reservacion`, `fecha_ingreso`, `fecha_salida`, `cantidad_personas`, `estado_reservacion`, `forma_pago`, `total_pago`) VALUES
(1, 4, 1, 1, '2023-04-16 16:20:01', '2023-04-14', '2023-04-15', '1', 'Finalizada', 'En linea', 76000),
(2, 4, 4, 1, '2023-04-15 15:09:33', '2023-04-14', '2023-04-14', '1', 'Finalizada', 'En linea', 63000),
(3, 4, 2, 1, '2023-04-16 16:20:01', '2023-04-14', '2023-04-15', '1', 'Finalizada', 'En linea', 86000),
(4, 4, 3, 5, '2023-04-16 16:59:38', '2023-04-14', '2023-04-15', '2', 'Finalizada', 'En linea', 45000),
(5, 4, 4, 1, '2023-04-17 14:56:05', '2023-04-15', '2023-04-16', '2', 'Finalizada', 'En linea', 142000),
(6, 4, 1, 1, '2023-04-19 22:36:13', '2023-04-18', '2023-04-18', '1', 'Finalizada', 'En linea', 38000),
(7, 4, 1, 1, '2023-04-21 00:11:40', '2023-04-19', '2023-04-19', '1', 'Finalizada', 'En linea', 38000),
(8, 4, 1, 5, '2023-04-26 21:08:31', '2023-04-24', '2023-04-25', '1', 'Finalizada', 'En linea', 60000),
(9, 4, 3, 5, '2023-04-27 14:23:55', '2023-04-25', '2023-04-26', '1', 'Finalizada', 'En linea', 80000),
(10, 4, 1, 5, '2023-04-27 14:23:55', '2023-04-26', '2023-04-26', '1', 'Finalizada', 'En linea', 24000),
(11, 4, 2, 1, '2023-05-03 14:28:12', '2023-05-01', '2023-05-02', '1', 'Finalizada', 'En linea', 86000),
(12, 4, 1, 5, '2023-05-03 18:03:47', '2023-05-02', '2023-05-03', '1', 'Cancelada', 'En linea', 60000),
(13, 4, 5, 5, '2023-05-03 14:28:12', '2023-05-02', '2023-05-02', '1', 'Finalizada', 'En linea', 30000),
(14, 4, 3, 5, '2023-05-02 12:11:11', '2023-05-01', '2023-05-01', '1', 'Finalizada', 'Tarjeta de credito', 40000),
(15, 4, 4, 5, '2023-05-03 14:28:12', '2023-05-01', '2023-05-02', '1', 'Finalizada', 'Tarjeta de credito', 100000),
(16, 4, 3, 1, '2023-05-03 00:54:54', '2023-05-02', '2023-05-03', '1', 'Registrada', 'Tarjeta de credito', 96000);

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
(1, 1, 'Desayunos        ', 'Inicie el día de la mejor manera despertando tus sentidos con un completo desayuno, ofrecemos desde frutas típicas hasta platos calientes que garantizan opciones para todos los gustos.    ', 8000, '../imgServicios/r1.jpg'),
(2, 1, 'Almuerzos', 'Nuestros Restaurantes asociados son los lugares ideales para compartir y degustar la mejor experiencia culinaria. Disfruta junto a tu familia o amigos de sus excelentes cartas con los mejores platos de la gastronomía local', 13000, '../imgServicios/r2.jpg'),
(3, 2, 'Parqueadero', 'El hotel cuenta con parqueadero interno privado, el cual te permitirá guardar tu auto de forma segura. Este servicio está sujeto a disponibilidad.', 0, '../imgServicios/S3.jpg'),
(4, 1, 'Bar', 'Un rincón con un ambiente íntimo y acogedor ideal para encuentros privados, reuniones sociales o simplemente para relajarse tomando su bebida preferida. El lugar perfecto para disfrutar de momentos agradables, un trago de negocios o una cita romántica.', 0, '../imgServicios/b3.jpg'),
(5, 5, 'Sin servicio', 'Sin servicio', 0, '../imgServicios/p1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporada`
--

CREATE TABLE `temporada` (
  `id_temporada` int(11) NOT NULL,
  `temporada` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `temporada`
--

INSERT INTO `temporada` (`id_temporada`, `temporada`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'alta', '2023-01-01', '2023-01-22'),
(2, 'alta', '2023-04-02', '2023-04-09'),
(3, 'alta', '2023-06-16', '2023-07-16'),
(4, 'alta', '2023-12-01', '2023-12-31'),
(5, 'baja', '2023-01-23', '2023-06-15'),
(6, 'baja', '2023-07-17', '2023-11-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_contrato`
--

CREATE TABLE `tipo_contrato` (
  `id_tipo_contrato` int(11) NOT NULL,
  `contrato` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_contrato`
--

INSERT INTO `tipo_contrato` (`id_tipo_contrato`, `contrato`) VALUES
(1, 'Definido'),
(2, 'Indefinido');

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
(1, 'Individual               '),
(2, 'Estándar'),
(3, 'Doble'),
(4, 'Familiar'),
(16, 'Junior    '),
(33, 'Matrimonial');

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
(1, 'Mañana-Tarde', '07:00:00', '14:00:00'),
(2, 'Tarde-Noche', '15:00:00', '23:00:00'),
(3, 'Noche-Mañana', '23:00:00', '07:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(6) NOT NULL,
  `nombre_usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_reg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `documento`, `fecha_nacimiento`, `telefono`, `email`, `password`, `fecha_reg`, `token`) VALUES
(1, 'Juan Fernando', 'Perez Torres', '1002314092', '2002-01-21', '3112780162', 'Juan@gmail.com', 'HwnctaM=', '2023-04-15 17:24:54', 'Eo6XHk9NMTQcOdzyp40l'),
(2, 'David', 'Fernandez', '1002314099', '2002-06-21', '3143614896', 'david@gmail.com', 'HwnctQ==', '2023-03-26 22:30:14', NULL),
(3, 'Juan', 'Perez', '3231222222', '2001-05-26', '3111111111', 'laura@gmail.com', 'Hwnc', '2023-03-26 22:28:25', NULL),
(4, 'Nicolas', 'Castañeda', '1002314097', '2002-06-21', '3143614897', 'nicolascas2102@gmail.com', 'HwnctQ==', '2023-05-03 16:49:19', 'Vkg2hUMA8c7ykD0pWPKJ'),
(5, 'Juán', 'Gutierrez', '111111111', '1998-02-28', '3112780162', 'Juana@gmail.com', 'HwnctaM=', '2023-03-29 22:30:37', NULL),
(8, 'David', 'Fernandez', '6313561236', '2002-05-15', '3125678686', 'nicod2102@gmail.com', 'Hwnc', '2023-04-15 23:46:45', 'kcQR4CUj6ASEf57pPdzZ'),
(9, 'jau', 'sahg', '1423144513', '1999-05-16', '3612536536', 'pal@gmail.com', 'Hwnc', '2023-04-16 17:51:23', NULL),
(10, 'Ni', 'pe', '3225265672', '2023-04-17', '3267253625', 'dj@gmail.com', 'Hwk=', '2023-04-17 19:36:07', NULL),
(11, 'Pedro', 'P', '3651361561', '2023-04-17', '6536125326', 'pe@gmail.com', 'Hwk=', '2023-04-17 21:27:19', NULL),
(12, 'David', 'Rodriguez', '6867888888', '1986-12-29', '3143614897', 'da@gmail.com', 'Hwnc', '2023-04-18 00:09:22', NULL),
(13, 'Pedro', 'Lopez', '2163736763', '2000-05-17', '3261736128', 'pedro1@gmail.com', 'Hwnc', '2023-04-18 02:50:16', NULL),
(14, 'Carlos', 'Marquez', '3213231736', '1992-04-30', '8423742896', 'carlos@gmail.com', 'HwnctQ==', '2023-04-18 02:52:39', NULL),
(15, 'Pedro', 'Duque', '3217836273', '2002-11-29', '3276382638', 'alaura@gmail.com', 'Hwnc', '2023-04-18 21:37:12', NULL),
(16, 'Juan', 'Lopez', '3257253651', '2003-12-27', '3561253612', 'f@gmail.com', 'Hwnc', '2023-04-18 21:39:14', NULL),
(17, 'Juan', 'Perez', '3215636234', '2002-08-25', '3213562136', 'juanl@gmail.com', 'Hwnc', '2023-04-18 21:53:00', NULL),
(18, 'Jose', 'Pedroza', '9813673281', '1998-10-25', '3127683999', 'jose@gmail.com', 'Hwnc', '2023-04-22 20:58:08', NULL);

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
  ADD KEY `id_turno_empleados` (`id_turno_empleados`),
  ADD KEY `id_tipo_contrato` (`id_tipo_contrato`);

--
-- Indices de la tabla `estado_habitacion`
--
ALTER TABLE `estado_habitacion`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`id_habitacion`),
  ADD KEY `id_tipo_habitacion` (`id_tipo_habitacion`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `fk_id_temporada` (`id_temporada`),
  ADD KEY `fk_id_promocion` (`id_promocion`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_habitacion` (`id_habitacion`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `opiniones`
--
ALTER TABLE `opiniones`
  ADD PRIMARY KEY (`id_opinion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id_promocion`),
  ADD KEY `id_habitacion` (`id_habitacion`);

--
-- Indices de la tabla `reservacion`
--
ALTER TABLE `reservacion`
  ADD PRIMARY KEY (`id_reservacion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_servicio` (`id_servicio`),
  ADD KEY `id_habitacion` (`id_habitacion`) USING BTREE;

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `id_categoria_servicio` (`id_categoria_servicio`);

--
-- Indices de la tabla `temporada`
--
ALTER TABLE `temporada`
  ADD PRIMARY KEY (`id_temporada`);

--
-- Indices de la tabla `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  ADD PRIMARY KEY (`id_tipo_contrato`);

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
  MODIFY `id_cargo_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categoria_servicio`
--
ALTER TABLE `categoria_servicio`
  MODIFY `id_categoria_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estado_habitacion`
--
ALTER TABLE `estado_habitacion`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `id_habitacion` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `opiniones`
--
ALTER TABLE `opiniones`
  MODIFY `id_opinion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id_promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reservacion`
--
ALTER TABLE `reservacion`
  MODIFY `id_reservacion` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `temporada`
--
ALTER TABLE `temporada`
  MODIFY `id_temporada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  MODIFY `id_tipo_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `id_tipo_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `turnos_empleados`
--
ALTER TABLE `turnos_empleados`
  MODIFY `id_turno_empleados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_cargo_empleado`) REFERENCES `cargo_empleado` (`id_cargo_empleado`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`id_turno_empleados`) REFERENCES `turnos_empleados` (`id_turno_empleados`),
  ADD CONSTRAINT `empleado_ibfk_3` FOREIGN KEY (`id_tipo_contrato`) REFERENCES `tipo_contrato` (`id_tipo_contrato`);

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `fk_id_promocion` FOREIGN KEY (`id_promocion`) REFERENCES `promociones` (`id_promocion`),
  ADD CONSTRAINT `fk_id_temporada` FOREIGN KEY (`id_temporada`) REFERENCES `temporada` (`id_temporada`),
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tipo_habitacion` (`id_tipo_habitacion`),
  ADD CONSTRAINT `habitacion_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado_habitacion` (`id_estado`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id_habitacion`),
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `opiniones`
--
ALTER TABLE `opiniones`
  ADD CONSTRAINT `opiniones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `promociones_ibfk_1` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id_habitacion`);

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
