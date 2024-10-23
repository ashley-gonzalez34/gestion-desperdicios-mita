-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-10-2024 a las 07:41:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `demo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `Aid` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` text NOT NULL,
  `location` text NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`Aid`, `name`, `email`, `password`, `location`, `address`) VALUES
(3, 'admin', 'gonzalezashli219@gmail.com', '$2y$10$bJWtS6UqnO6tEPQ/6JmLQ.zmd4TC.n.0/tPS9lOT42A6b3REb8fN6', 'asuncion_mita', 'as mita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `delivery_persons`
--

CREATE TABLE `delivery_persons` (
  `Did` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `delivery_persons`
--

INSERT INTO `delivery_persons` (`Did`, `name`, `email`, `password`, `city`) VALUES
(5, 'repartidor', 'pazherreramari@gmail.com', '$2y$10$t.gv.vno5HcJfMcc3kDAN.mUFykyMscfOMCsd7G7.UkvAH3rqBGPq', 'aguas_finas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `food_donations`
--

CREATE TABLE `food_donations` (
  `Fid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `food` varchar(50) NOT NULL,
  `type` text NOT NULL,
  `category` text NOT NULL,
  `quantity` text NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `address` text NOT NULL,
  `location` varchar(50) NOT NULL,
  `phoneno` varchar(25) NOT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `delivery_by` int(11) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `food_donations`
--

INSERT INTO `food_donations` (`Fid`, `name`, `email`, `food`, `type`, `category`, `quantity`, `date`, `address`, `location`, `phoneno`, `assigned_to`, `delivery_by`, `expiration_date`) VALUES
(26, 'ash gonzalez', 'cami123@gmail.com', 'Frijoles', 'Vegana', 'Cruda', '43', '2024-10-22 23:29:50', 'jutiapa', 'asuncion_mita', '31943009', 3, NULL, '2024-10-24'),
(27, 'ash gonzalez', 'gonzalezashli219@gmail.com', 'Banano', 'Vegana', 'Cruda', '5', '2024-10-22 23:33:26', 'jutiapa', 'aguas_finas', '31943009', 3, 5, '2024-10-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` text NOT NULL,
  `gender` text NOT NULL,
  `phone` varchar(9) NOT NULL,
  `dpi` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `password`, `gender`, `phone`, `dpi`) VALUES
(19, 'ash gonzalez', 'cami123@gmail.com', '$2y$10$O2dVHkH/Bhpr3OWT0G.7k.vtn7iHWNjhbUXdFcTUpWFMXsFl.8uxC', 'female', '31943009', '1234567899658'),
(17, 'ash gonzalez', 'pazherreramari@gmail.com', '$2y$10$MaccICmldWOsR/SZz3mnGeVvSe3mheeKuacLfDqVjFp/qadHSHFFS', 'female', '31943009', '2451789450101'),
(20, 'persona', 'persona@gmail.com', '$2y$10$0hnzw0fjpT4K0641NC.FD.PbGLzJJftz5G0/RqRpSsNYMPk/efqQy', 'male', '31943009', '1234567891014'),
(18, 'ash gonzalez', 'tasuncion82@gmail.com', '$2y$10$3/UYI/PuRqGqpfdHCD9PNeHPhSVRl9ua1v0Lq4CxpuYC5bqAaEH0O', 'female', '31943009', '1234567899658');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_feedback`
--

CREATE TABLE `user_feedback` (
  `feedback_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_feedback`
--

INSERT INTO `user_feedback` (`feedback_id`, `name`, `email`, `message`) VALUES
(1, 'John Smith', 'john@example.com', 'I really enjoyed using your product!');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Aid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `delivery_persons`
--
ALTER TABLE `delivery_persons`
  ADD PRIMARY KEY (`Did`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `food_donations`
--
ALTER TABLE `food_donations`
  ADD PRIMARY KEY (`Fid`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `Aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `delivery_persons`
--
ALTER TABLE `delivery_persons`
  MODIFY `Did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `food_donations`
--
ALTER TABLE `food_donations`
  MODIFY `Fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `user_feedback`
--
ALTER TABLE `user_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
