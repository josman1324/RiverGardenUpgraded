-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2025 a las 23:38:55
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
-- Base de datos: `hotelreservas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `datos_fiscales` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `id_usuario`, `nombre`, `email`, `telefono`, `datos_fiscales`) VALUES
(8, 8, 'Yenny Reina', 'yennyreina26@gmail.com', NULL, NULL),
(9, 9, 'Jose Manuel', 'jikdk@casco.com', NULL, NULL),
(10, 10, 'Jose Manuel Hernandez Prueba', 'conectahorra@gmail.com', NULL, NULL),
(11, 11, 'caca', 'fnjenferjfj@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `consecutivo` varchar(50) NOT NULL,
  `fecha_emision` timestamp NOT NULL DEFAULT current_timestamp(),
  `monto_total` decimal(10,2) NOT NULL,
  `detalle` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_factura`, `id_reserva`, `consecutivo`, `fecha_emision`, `monto_total`, `detalle`) VALUES
(3, 3, 'FE-RG-3', '2025-10-27 15:48:06', 1000000.00, 'Adelanto (50%) por reserva de habitación. Noches: 4.'),
(4, 4, 'FE-RG-4', '2025-11-04 23:25:09', 350000.00, 'Adelanto (50%) por reserva de habitación. Noches: 1.'),
(5, 5, 'FE-RG-5', '2025-12-10 22:21:55', 5850000.00, 'Adelanto (50%) por reserva de habitación. Noches: 13.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_habitacion` int(11) NOT NULL,
  `numero_habitacion` varchar(20) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio_noche` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado` enum('disponible','ocupada','mantenimiento') NOT NULL DEFAULT 'disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_habitacion`, `numero_habitacion`, `tipo`, `descripcion`, `precio_noche`, `estado`) VALUES
(1, '101', 'Individual', 'Habitación sencilla con cama individual', 150000.00, 'disponible'),
(2, '102', 'Pareja', 'Habitación doble con dos camas', 250000.00, 'disponible'),
(3, '201', 'Triple', 'Suite con vista a la ciudad', 350000.00, 'disponible'),
(4, '202', 'Familiar', 'Habitación familiar con 2 camas dobles', 450000.00, 'disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  `id_transaccion` varchar(255) DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL,
  `estado` enum('iniciado','exitoso','fallido') NOT NULL,
  `fecha_pago` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `id_factura`, `metodo_pago`, `id_transaccion`, `monto`, `estado`, `fecha_pago`) VALUES
(3, 3, 'Simulado (Stripe)', 'SIMULADA123', 500000.00, 'exitoso', '2025-10-27 15:56:38'),
(4, 4, 'Simulado (Stripe)', 'SIMULADA123', 175000.00, 'exitoso', '2025-11-04 23:25:58'),
(5, 5, 'Simulado (Stripe)', 'SIMULADA123', 2925000.00, 'exitoso', '2025-12-10 22:22:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `numero_noches` int(11) NOT NULL DEFAULT 1,
  `monto_total` decimal(10,2) NOT NULL,
  `monto_adelanto` decimal(10,2) NOT NULL,
  `estado_reserva` enum('pendiente','confirmada','cancelada') NOT NULL DEFAULT 'pendiente',
  `estado_pago` enum('pendiente','pagado','reembolsado') NOT NULL DEFAULT 'pendiente',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_cliente`, `id_habitacion`, `fecha_entrada`, `fecha_salida`, `numero_noches`, `monto_total`, `monto_adelanto`, `estado_reserva`, `estado_pago`, `fecha_creacion`) VALUES
(3, 8, 2, '2025-10-27', '2025-10-31', 4, 1000000.00, 500000.00, 'confirmada', 'pagado', '2025-10-27 15:48:06'),
(4, 8, 3, '2025-11-04', '2025-11-05', 1, 350000.00, 175000.00, 'confirmada', 'pagado', '2025-11-04 23:25:09'),
(5, 10, 4, '2025-12-11', '2025-12-24', 13, 5850000.00, 2925000.00, 'confirmada', 'pagado', '2025-12-10 22:21:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('cliente','recepcionista','admin') NOT NULL DEFAULT 'cliente',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `password`, `rol`, `fecha_creacion`) VALUES
(7, 'Jose Manuel Hernandez Montealegre', 'josman2413@gmail.com', '$2y$10$ZbAb42Z39.J0pcJqVXZZPehgvlZAlcvKldhADQ2mcz/q9x.gzgCZC', 'admin', '2025-10-27 15:45:17'),
(8, 'Yenny Reina', 'yennyreina26@gmail.com', '$2y$10$GHDmcWvfeIkwX/ThrZjcQeSEhOMxF488iGP88PSh.IKmB6sErkiHC', 'cliente', '2025-10-27 15:47:09'),
(9, 'Jose Manuel', 'jikdk@casco.com', '$2y$10$S9qbgyMV4eM4E0ciSuu8MO0SD2XfKZDGnNCMBFVKYnK2ViaVT2ZTe', 'cliente', '2025-11-19 18:33:56'),
(10, 'Jose Manuel Hernandez Prueba', 'conectahorra@gmail.com', '$2y$10$JEB9.kfS4YBgYr0KPNlj/O7nHktchVpiYMTpMdE9SuB32Owi0Scye', 'cliente', '2025-12-10 22:21:15'),
(11, 'caca', 'fnjenferjfj@gmail.com', '$2y$10$QRwN/mNNts120.jR.ZdGmuvknFKfpnN3le0tKgeeY5P5/eIb2vpgi', 'cliente', '2025-12-10 22:33:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_cliente_usuario` (`id_usuario`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD UNIQUE KEY `consecutivo` (`consecutivo`),
  ADD KEY `fk_factura_reserva` (`id_reserva`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_habitacion`),
  ADD UNIQUE KEY `numero_habitacion` (`numero_habitacion`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `fk_pago_factura` (`id_factura`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `fk_reservas_clientes` (`id_cliente`),
  ADD KEY `fk_reservas_habitaciones` (`id_habitacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_cliente_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_factura_reserva` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id_reserva`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pago_factura` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_reservas_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservas_habitaciones` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id_habitacion`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
