-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 02, 2015 at 02:19 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `adnativo_pi`
--

-- --------------------------------------------------------

--
-- Table structure for table `archivos`
--

CREATE TABLE `archivos` (
`id` int(11) NOT NULL,
  `archivos` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `campana`
--

CREATE TABLE `campana` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `imagenes` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idpersona` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `campana`
--

INSERT INTO `campana` (`id`, `nombre`, `descripcion`, `imagenes`, `marca`, `idpersona`, `idEstado`) VALUES
(1, 'Running Chile', 'Ejemplo para marlene', './uploads/agencias/registered/10153609881033259/1/1.jpg', 'Chile Running', 1, 0),
(2, 'Polla gol', 'campaña de banners', './uploads/agencias/registered/10153609881033259/2/1.jpg', 'Loto', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
`id` int(11) NOT NULL,
  `Nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Descripción` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
`id` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user`, `pass`, `correo`) VALUES
(3, 'Marlene', 'e10adc3949ba59abbe56e057f20f883e', 'marlene@mediatrends.cl');

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
`id` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono1` bigint(11) NOT NULL,
  `telefono2` bigint(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `RS_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `oauth_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `picture_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `empresa` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`id`, `id_tipo`, `id_estado`, `id_login`, `nombre`, `correo`, `telefono1`, `telefono2`, `fecha_ingreso`, `RS_id`, `oauth_id`, `picture_url`, `empresa`) VALUES
(1, 2, 1, 0, 'Argkont Koha Kohacaelo', 'kohacaelo@gmail.com', 0, 0, '0000-00-00', '10153609881033259', '', '//graph.facebook.com/10153609881033259/picture', ''),
(4, 2, 1, 3, 'Marlene', 'marlene@mediatrends.cl', 93849072349, 9345098230, '0000-00-00', '', '', './uploads/agencias/registered/marlene@mediatrends.cl/avatar.gif', 'Mediatrends');

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

CREATE TABLE `tipo` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archivos`
--
ALTER TABLE `archivos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campana`
--
ALTER TABLE `campana`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archivos`
--
ALTER TABLE `archivos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `campana`
--
ALTER TABLE `campana`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;