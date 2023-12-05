-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-12-2023 a las 21:08:58
-- Versión del servidor: 8.0.35-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `token_password` varchar(40) DEFAULT NULL,
  `password_request` tinyint NOT NULL DEFAULT '0',
  `activo` tinyint NOT NULL,
  `fecha_alta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `usuario`, `password`, `nombre`, `email`, `token_password`, `password_request`, `activo`, `fecha_alta`) VALUES
(1, 'admin', '$2y$10$M33/hIlcHdw.D4ZXwg1bfudUXY5rv5UspqS9LDW6xSixLJsME7GY.', 'administrador', 'carritoscompras@gmail.com', NULL, 0, 1, '2023-12-04 07:39:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id` int NOT NULL,
  `caracteristicas` varchar(30) NOT NULL,
  `activo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `caracteristicas`
--

INSERT INTO `caracteristicas` (`id`, `caracteristicas`, `activo`) VALUES
(1, 'medida', 1),
(2, 'color', 1),
(3, 'litros', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `activo`) VALUES
(1, 'COLEMAN', 1),
(2, 'mdf', 1),
(3, 'champañera', 1),
(4, 'mesas', 1),
(8, 'machinbre', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int NOT NULL,
  `nombres` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `estatus` tinyint NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_modifica` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellidos`, `email`, `telefono`, `cedula`, `estatus`, `fecha_alta`, `fecha_modifica`, `fecha_baja`) VALUES
(1, 'Lucas', 'bazan', 'bazanlucas684@gmail.com', '0987567898', '5272897', 1, '2023-12-03 05:16:48', NULL, NULL),
(2, 'gladys', 'ortiz', 'carritoscompras@gmail.com', '098767567', '4567876', 1, '2023-12-03 20:33:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int NOT NULL,
  `id_transaccion` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_cliente` varchar(20) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_transaccion`, `fecha`, `status`, `email`, `id_cliente`, `total`) VALUES
(1, '9WM4088510189901K', '2023-12-04 16:53:00', 'COMPLETED', 'sb-whudz28444948@personal.example.com', 'TWVFFDNPHMRPC', 181000),
(2, '63P27377X9209315D', '2023-12-04 18:03:24', 'COMPLETED', 'bazanlucas684@gmail.com', '1', 90500),
(3, '6NW36494LL827221M', '2023-12-04 18:10:55', 'COMPLETED', 'bazanlucas684@gmail.com', '1', 90500),
(4, '1R858355XR091563B', '2023-12-04 18:18:48', 'COMPLETED', 'carritoscompras@gmail.com', '2', 90500),
(5, '55938787FP2009833', '2023-12-04 18:26:33', 'COMPLETED', 'bazanlucas684@gmail.com', '1', 90500),
(6, '490286118S337440M', '2023-12-04 18:29:34', 'COMPLETED', 'bazanlucas684@gmail.com', '1', 90500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valor` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre`, `valor`) VALUES
(1, 'tienda_nombre', 'DIOVIC ARTESANIA'),
(2, 'correo_email', 'pruebadecuentas684@gmail.com'),
(3, 'corre_smtp', 'smtp.gmail.com.'),
(4, 'correo_password', 'c1BpuifpxekC1nRi+BCZfQ==:2dpYucgLal/etph+p04sSa+ObSxUyhmRlN8Jqb3ABoU='),
(5, 'correo_puerto', '465');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int NOT NULL,
  `id_compra` int NOT NULL,
  `id_producto` int NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_compra`, `id_producto`, `nombre`, `precio`, `cantidad`) VALUES
(1, 1, 1, 'caja de Corazon', 40500, 2),
(2, 1, 2, 'caja para platos', 50000, 2),
(3, 2, 1, 'caja de Corazon', 40500, 1),
(4, 2, 2, 'caja para platos', 50000, 1),
(5, 3, 1, 'caja de Corazon', 40500, 1),
(6, 3, 2, 'caja para platos', 50000, 1),
(7, 4, 1, 'caja de Corazon', 40500, 1),
(8, 4, 2, 'caja para platos', 50000, 1),
(9, 5, 1, 'caja de Corazon', 40500, 1),
(10, 5, 2, 'caja para platos', 50000, 1),
(11, 6, 2, 'caja para platos', 50000, 1),
(12, 6, 1, 'caja de Corazon', 40500, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_prod_caracter`
--

CREATE TABLE `det_prod_caracter` (
  `id` int NOT NULL,
  `id_producto` int NOT NULL,
  `id_caracteristica` int NOT NULL,
  `valor` varchar(30) NOT NULL,
  `stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `det_prod_caracter`
--

INSERT INTO `det_prod_caracter` (`id`, `id_producto`, `id_caracteristica`, `valor`, `stock`) VALUES
(1, 1, 1, '25x25', 30),
(2, 1, 1, '20x15', 15),
(3, 1, 2, 'blanco', 5),
(4, 1, 2, 'negro', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` int NOT NULL,
  `descuento` tinyint NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '0',
  `id_categoria` int NOT NULL,
  `activo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `descuento`, `stock`, `id_categoria`, `activo`) VALUES
(1, 'caja de Corazon', 'caja de corazon color blanco', 45000, 10, 0, 1, 1),
(2, 'caja para platos', 'caja para platos de madera', 50000, 0, 0, 1, 1),
(5, 'caja tipo cartera', 'caja de mdf difentes colores', 30000, 5, 10, 8, 1),
(6, 'caja redondo', 'caja redondo de machinbre color tabaco', 30000, 5, 10, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(120) NOT NULL,
  `activacion` int NOT NULL DEFAULT '0',
  `token` varchar(40) NOT NULL,
  `token_password` varchar(40) DEFAULT NULL,
  `password_request` int NOT NULL DEFAULT '0',
  `id_cliente` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `activacion`, `token`, `token_password`, `password_request`, `id_cliente`) VALUES
(1, 'lucas', '$2y$10$Cbl1XsnDJq1WoH1Hcfr7P.mabRDskcVlApB09KHmXthvcn/8Efg0q', 1, '', '8d25554ab166e9112033026b58058584', 1, 1),
(2, 'gladys', '$2y$10$VvwqG7V9oqmNSzHIVju//Od7uQSsoMH4Ptjl16tBWNekxelYM.tVC', 1, '', NULL, 0, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `det_prod_caracter`
--
ALTER TABLE `det_prod_caracter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_det_prod` (`id_producto`),
  ADD KEY `fk_det_caracter` (`id_caracteristica`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `det_prod_caracter`
--
ALTER TABLE `det_prod_caracter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `det_prod_caracter`
--
ALTER TABLE `det_prod_caracter`
  ADD CONSTRAINT `fk_det_caracter` FOREIGN KEY (`id_caracteristica`) REFERENCES `caracteristicas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_det_prod` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
