-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 31-01-2024 a las 15:30:51
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Modasof`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_temporal_usuario`
--

CREATE TABLE `ingreso_temporal_usuario` (
  `Id_Ingreso_Tempora` int(11) NOT NULL,
  `Tipo_Pago_Temporal` int(11) NOT NULL DEFAULT 0,
  `Valor_Pago_Temporal` int(11) NOT NULL,
  `Voucher` varchar(255) NOT NULL,
  `Usuario_Ingreso` int(11) NOT NULL,
  `Pago_De` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_actualizacion_ordenes`
--

CREATE TABLE `t_actualizacion_ordenes` (
  `Id_Actualizacion_Orden` int(11) NOT NULL,
  `Actualiza_Id_Usuario` int(11) NOT NULL,
  `Fecha_Actualiza` datetime NOT NULL,
  `Comentario_Actualiza` text NOT NULL,
  `SolTem_Id_Solicitud` int(11) NOT NULL,
  `Pedido_Id_Pedido` int(11) NOT NULL,
  `Estado_Actualiza` int(11) NOT NULL,
  `taller_id_taller` int(11) NOT NULL,
  `fecha_leido` datetime NOT NULL,
  `leido_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ajustes_inventario_ref`
--

CREATE TABLE `t_ajustes_inventario_ref` (
  `Id_Registro_Ajuste_Ref` int(11) NOT NULL,
  `Ajuste_Id_Usuario` int(11) NOT NULL,
  `Fecha_Ajuste` datetime NOT NULL,
  `Cant_Ajuste` int(11) NOT NULL,
  `Referencia_Id_Referencia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ajustes_inventario_telas`
--

CREATE TABLE `t_ajustes_inventario_telas` (
  `Id_Registro_Ajuste` int(11) NOT NULL,
  `Ajuste_Id_Usuario` int(11) NOT NULL,
  `Fecha_Ajuste` datetime NOT NULL,
  `Cant_Ajuste` decimal(5,2) NOT NULL,
  `Cod_Insumo_Cod` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_areas`
--

CREATE TABLE `t_areas` (
  `Id_Area` int(11) NOT NULL,
  `Desc_Area` varchar(255) NOT NULL,
  `Nom_Area` varchar(255) NOT NULL,
  `Area_Publicada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_areas`
--

INSERT INTO `t_areas` (`Id_Area`, `Desc_Area`, `Nom_Area`, `Area_Publicada`) VALUES
(1, '??rea encargada de lo administrativo', 'Administrativa', 1),
(2, 'Mercadeo', 'Mercadeo', 1),
(3, 'Compras', 'Compras', 1),
(4, 'Mensajer??a', 'Operativa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_atributos_categoria_ins`
--

CREATE TABLE `t_atributos_categoria_ins` (
  `Id_Atributo_Categoria` int(11) NOT NULL,
  `Categoria_Id_Categoria_Insumo` int(11) NOT NULL,
  `Nom_Atributo_Categoria` varchar(255) DEFAULT NULL,
  `Atributo_Categoria_Publicada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_atributos_categoria_ins`
--

INSERT INTO `t_atributos_categoria_ins` (`Id_Atributo_Categoria`, `Categoria_Id_Categoria_Insumo`, `Nom_Atributo_Categoria`, `Atributo_Categoria_Publicada`) VALUES
(1, 1, 'ESTAMPADA', 1),
(2, 1, 'PINTADA', 1),
(3, 1, 'RAYAS', 1),
(4, 1, 'UNICOLOR', 1),
(5, 1, 'MULTICOLOR', 1),
(7, 3, 'BRILLANTE', 1),
(8, 3, 'MATE', 1),
(9, 4, 'BASICA', 1),
(10, 1, 'CUADROS', 1),
(11, 1, 'CIRCULOS', 1),
(12, 1, 'TERRACOTA', 1),
(13, 44, 'TRANSPARENTE', 1),
(14, 25, 'AJUSTES PRENDAS', 1),
(15, 64, 'CAMISA MANGA CORTA ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_bodegas`
--

CREATE TABLE `t_bodegas` (
  `Id_Bodega` int(11) NOT NULL,
  `Cod_Bodega` varchar(255) NOT NULL,
  `Nom_Bodega` varchar(255) NOT NULL,
  `Usuario_Encargado` int(11) NOT NULL,
  `Dir_Bodega` varchar(255) NOT NULL,
  `Tel_Bodega` varchar(255) NOT NULL,
  `Cel_Bodega` varchar(255) NOT NULL,
  `Correo_Bodega` varchar(255) NOT NULL,
  `Ciudad_Id_Ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_bodegas`
--

INSERT INTO `t_bodegas` (`Id_Bodega`, `Cod_Bodega`, `Nom_Bodega`, `Usuario_Encargado`, `Dir_Bodega`, `Tel_Bodega`, `Cel_Bodega`, `Correo_Bodega`, `Ciudad_Id_Ciudad`) VALUES
(5, '001', 'TALLER VALLEDUPAR', 6, 'VALLEDUPAR', '(345) 345-3453', '(123) 123-1231', 'VALLEDUPAR@GMAIL.COM', 9),
(6, '002', 'VALLEDUPAR 2024', 5, 'CCO BARRANQUILLA', '(312) 897-9999', '(312) 789-5667', 'BARRANQUILLA@HOTMAIL.COM', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_bonos`
--

CREATE TABLE `t_bonos` (
  `Id_bono` int(11) NOT NULL,
  `Num_Bono` varchar(255) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Fecha_Bono` datetime NOT NULL,
  `Fecha_venta` datetime NOT NULL,
  `recibo_caja` int(11) NOT NULL,
  `Estado_Bono` varchar(255) NOT NULL,
  `Usuario_Crea` int(11) NOT NULL,
  `Usuario_Vende` int(11) NOT NULL,
  `Valor_Comercial` int(11) NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cartera`
--

CREATE TABLE `t_cartera` (
  `Id_Cartera` int(11) NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Fecha_Cartera` datetime NOT NULL,
  `Valor_Cartera` int(11) NOT NULL,
  `Cartera_Id_Usuario` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Estado_Cartera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_categorias_insumos`
--

CREATE TABLE `t_categorias_insumos` (
  `Id_Categoria_Insumo` int(11) NOT NULL,
  `Nom_CategoriaIns` varchar(255) NOT NULL,
  `Cod_Categoria_Insumo` int(11) NOT NULL,
  `Consecutivo_Categoria` int(11) NOT NULL,
  `CategoriaIns_Publicada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_categoria_producto`
--

CREATE TABLE `t_categoria_producto` (
  `Id_Cat_Producto` int(11) NOT NULL,
  `Cod_Cat_Producto` varchar(255) NOT NULL,
  `Nom_Cat_Producto` varchar(512) NOT NULL,
  `Cat_Producto_Publicada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_categoria_producto`
--

INSERT INTO `t_categoria_producto` (`Id_Cat_Producto`, `Cod_Cat_Producto`, `Nom_Cat_Producto`, `Cat_Producto_Publicada`) VALUES
(1, 'ALP', 'ALPARGATA', 1),
(2, 'BER', 'BERMUDA', 1),
(3, 'BEB', 'BERMUDA BANO', 1),
(4, 'VES', 'VESTIDO', 1),
(5, 'BIL', 'BILLETERA', 1),
(6, 'BLA', 'BLAZER', 1),
(7, 'BLU', 'BLUSA', 1),
(8, 'BLZ', 'BLUZON', 1),
(9, 'BOL', 'BOLSO', 1),
(10, 'BUS', 'BUZO', 1),
(11, 'ZPS', 'CALZADO SMOKING', 1),
(12, 'ZPC', 'CALZADO CORDON', 1),
(13, 'ZPD', 'CALZADO DEPORTIVO', 1),
(14, 'ZPH', 'CALZADO HERRAJE', 1),
(15, 'ZPM', 'CALZADO MOCASIN', 1),
(16, 'ZPT', 'CALZADO TUBULAR', 1),
(17, 'CML', 'CAMISA MANGA LARGA', 1),
(18, 'CMC', 'CAMISA MANGA CORTA', 1),
(19, 'CSK', 'CAMISA SMOKING', 1),
(20, 'CMS', 'CAMISETA', 1),
(21, 'CHL', 'CHALECO', 1),
(22, 'CHQ', 'CHAQUETA', 1),
(23, 'CIN', 'CINTURON', 1),
(24, 'CNJ', 'CONJUNTO', 1),
(25, 'CRB', 'CORBATA', 1),
(26, 'CBT', 'CORBATIN', 1),
(27, 'GYB', 'GUAYABERA', 1),
(28, 'JEA', 'JEANS', 1),
(29, 'PNT', 'PANTALON', 1),
(30, 'PTA', 'PANTANOLETA', 1),
(31, 'POD', 'PORTADOCUMENTO', 1),
(32, 'PUL', 'PULSERA', 1),
(33, 'SHO', 'SHORT', 1),
(34, 'SUP', 'SUETER POLO', 1),
(35, 'SCR', 'SUETER CUELLO REDONDO', 1),
(36, 'SCV', 'SUETER CUELLO V', 1),
(37, 'TLG', 'TALEGO', 1),
(38, 'MAM', 'MAMELUCO', 1),
(39, 'CRG', 'CARGADERAS-TIRANTAS', 1),
(40, 'MAN', 'MANCORNA', 1),
(41, 'HER', 'HERRAJE DE ZAPATO', 1),
(42, 'BXR', 'BOXER', 1),
(43, 'CAM', 'CAMISILLAS', 1),
(44, 'SDL', 'SANDALIA', 1),
(45, 'CRP', 'CROP TOP', 1),
(46, 'FAL', 'FALDA', 1),
(47, 'BSA', 'BOLSA ESTAMPADA', 1),
(48, 'TRA', 'TRANSPORTE', 1),
(49, 'TEL', 'TELA', 1),
(50, 'PIJ', 'PIJAMA', 1),
(51, 'JOG', 'JOGGERS', 1),
(52, 'TAP', 'TAPABOCAS', 1),
(53, 'BOD', 'BODY', 1),
(54, 'PLT', 'PA?OLETA', 1),
(55, 'CLX', 'CALZADO LUXURY', 1),
(56, 'CJR', 'CAJA REGALO', 1),
(57, 'GRR', 'GORRA', 1),
(58, 'TJR', 'TARJETA REGALO', 1),
(59, 'ENT', 'ENTERIZO', 1),
(60, 'JUM', 'JUMPERS', 1),
(61, 'MAX', 'MAXIVESTIDO', 1),
(62, 'VBO', 'VESTIDO DE BA?O', 1),
(63, 'LEV', 'LEVANTADORA', 1),
(64, 'HEB', 'HEBILLA', 1),
(65, 'LYC', 'LYCRA', 1),
(66, 'MCH', 'MOCHILA', 1),
(67, 'FSH', 'FALDA SHORT', 1),
(68, 'PCK', 'PACK 3', 1),
(69, 'CAP', 'AJUSTE PRENDAS', 1),
(70, 'SOM', 'SOMBRERO', 1),
(71, 'PON', 'PONCHO', 1),
(72, 'MED', 'MEDIAS', 1),
(73, 'CPL', 'PLATAFORMA', 1),
(74, 'HOO', 'HOODIE', 1),
(75, 'CAB', 'CAMIBUSO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_causales`
--

CREATE TABLE `t_causales` (
  `id_causal` int(11) NOT NULL,
  `nombre_causal` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cc`
--

CREATE TABLE `t_cc` (
  `Id_Remision` int(11) NOT NULL,
  `Fecha_Remision` datetime NOT NULL,
  `Num_Remision` int(11) NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Subtotal_Remision` int(11) NOT NULL,
  `Iva_Remision` int(11) NOT NULL,
  `Total_Remision` int(11) NOT NULL,
  `Estado_Remision` int(11) NOT NULL,
  `Marca_Temporal` datetime NOT NULL,
  `Usuario_Vendedor` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Observa_Remision` text NOT NULL,
  `proveedor_id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ciudades`
--

CREATE TABLE `t_ciudades` (
  `Id_Ciudad` int(11) NOT NULL,
  `Nom_Ciudad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_ciudades`
--

INSERT INTO `t_ciudades` (`Id_Ciudad`, `Nom_Ciudad`) VALUES
(1, 'MEDELLIN'),
(2, 'BARRANQUILLA'),
(3, 'BOGOTA, D.C.'),
(4, 'CARTAGENA'),
(5, 'TUNJA'),
(6, 'MANIZALES'),
(7, 'FLORENCIA'),
(8, 'POPAYAN'),
(9, 'VALLEDUPAR'),
(10, 'MONTERIA'),
(11, 'AGUA DE DIOS'),
(12, 'QUIBDO'),
(13, 'NEIVA'),
(14, 'RIOHACHA'),
(15, 'SANTA MARTA'),
(16, 'VILLAVICENCIO'),
(17, 'PASTO'),
(18, 'CUCUTA'),
(19, 'ARMENIA'),
(20, 'PEREIRA'),
(21, 'BUCARAMANGA'),
(22, 'SINCELEJO'),
(23, 'IBAGUE'),
(24, 'CALI'),
(25, 'ARAUCA'),
(26, 'YOPAL'),
(27, 'MOCOA'),
(28, 'SAN ANDRES'),
(29, 'LETICIA'),
(30, 'INIRIDA'),
(31, 'SAN JOSE DEL GUAVIARE'),
(32, 'MITU'),
(33, 'PUERTO CARRE??O'),
(34, 'ABEJORRAL'),
(35, 'ABRIAQUI'),
(36, 'ALEJANDRIA'),
(37, 'AMAGA'),
(38, 'AMALFI'),
(39, 'ANDES'),
(40, 'ANGELOPOLIS'),
(41, 'ANGOSTURA'),
(42, 'ANORI'),
(43, 'SANTAFE DE ANTIOQUIA'),
(44, 'ANZA'),
(45, 'APARTADO'),
(46, 'ARBOLETES'),
(47, 'ARGELIA'),
(48, 'ARMENIA'),
(49, 'BARBOSA'),
(50, 'BELMIRA'),
(51, 'BELLO'),
(52, 'BETANIA'),
(53, 'BETULIA'),
(54, 'CIUDAD BOLIVAR'),
(55, 'BRICE??O'),
(56, 'BURITICA'),
(57, 'CACERES'),
(58, 'CAICEDO'),
(59, 'CALDAS'),
(60, 'CAMPAMENTO'),
(61, 'CA??ASGORDAS'),
(62, 'CARACOLI'),
(63, 'CARAMANTA'),
(64, 'CAREPA'),
(65, 'EL CARMEN DE VIBORAL'),
(66, 'CAROLINA'),
(67, 'CAUCASIA'),
(68, 'CHIGORODO'),
(69, 'CISNEROS'),
(70, 'COCORNA'),
(71, 'CONCEPCION'),
(72, 'CONCORDIA'),
(73, 'COPACABANA'),
(74, 'DABEIBA'),
(75, 'DON MATIAS'),
(76, 'EBEJICO'),
(77, 'EL BAGRE'),
(78, 'ENTRERRIOS'),
(79, 'ENVIGADO'),
(80, 'FREDONIA'),
(81, 'FRONTINO'),
(82, 'GIRALDO'),
(83, 'GIRARDOTA'),
(84, 'GOMEZ PLATA'),
(85, 'GRANADA'),
(86, 'GUADALUPE'),
(87, 'GUARNE'),
(88, 'GUATAPE'),
(89, 'HELICONIA'),
(90, 'HISPANIA'),
(91, 'ITAGUI'),
(92, 'ITUANGO'),
(93, 'JARDIN'),
(94, 'JERICO'),
(95, 'LA CEJA'),
(96, 'LA ESTRELLA'),
(97, 'LA PINTADA'),
(98, 'LA UNION'),
(99, 'LIBORINA'),
(100, 'MACEO'),
(101, 'MARINILLA'),
(102, 'MONTEBELLO'),
(103, 'MURINDO'),
(104, 'MUTATA'),
(105, 'NARI??O'),
(106, 'NECOCLI'),
(107, 'NECHI'),
(108, 'OLAYA'),
(109, 'PE??OL'),
(110, 'PEQUE'),
(111, 'PUEBLORRICO'),
(112, 'PUERTO BERRIO'),
(113, 'PUERTO NARE'),
(114, 'PUERTO TRIUNFO'),
(115, 'REMEDIOS'),
(116, 'RETIRO'),
(117, 'RIONEGRO'),
(118, 'SABANALARGA'),
(119, 'SABANETA'),
(120, 'SALGAR'),
(121, 'SAN ANDRES DE CUERQUIA'),
(122, 'SAN CARLOS'),
(123, 'SAN FRANCISCO'),
(124, 'SAN JERONIMO'),
(125, 'SAN JOSE DE LA MONTA??A'),
(126, 'SAN JUAN DE URABA'),
(127, 'SAN LUIS'),
(128, 'SAN PEDRO'),
(129, 'SAN PEDRO DE URABA'),
(130, 'SAN RAFAEL'),
(131, 'SAN ROQUE'),
(132, 'SAN VICENTE'),
(133, 'SANTA BARBARA'),
(134, 'SANTA ROSA DE OSOS'),
(135, 'SANTO DOMINGO'),
(136, 'EL SANTUARIO'),
(137, 'SEGOVIA'),
(138, 'SONSON'),
(139, 'SOPETRAN'),
(140, 'TAMESIS'),
(141, 'TARAZA'),
(142, 'TARSO'),
(143, 'TITIRIBI'),
(144, 'TOLEDO'),
(145, 'TURBO'),
(146, 'URAMITA'),
(147, 'URRAO'),
(148, 'VALDIVIA'),
(149, 'VALPARAISO'),
(150, 'VEGACHI'),
(151, 'VENECIA'),
(152, 'VIGIA DEL FUERTE'),
(153, 'YALI'),
(154, 'YARUMAL'),
(155, 'YOLOMBO'),
(156, 'YONDO'),
(157, 'ZARAGOZA'),
(158, 'BARANOA'),
(159, 'CAMPO DE LA CRUZ'),
(160, 'CANDELARIA'),
(161, 'GALAPA'),
(162, 'JUAN DE ACOSTA'),
(163, 'LURUACO'),
(164, 'MALAMBO'),
(165, 'MANATI'),
(166, 'PALMAR DE VARELA'),
(167, 'PIOJO'),
(168, 'POLONUEVO'),
(169, 'PONEDERA'),
(170, 'PUERTO COLOMBIA'),
(171, 'REPELON'),
(172, 'SABANAGRANDE'),
(174, 'SANTA LUCIA'),
(175, 'SANTO TOMAS'),
(176, 'SOLEDAD'),
(177, 'SUAN'),
(178, 'TUBARA'),
(179, 'USIACURI'),
(180, 'ACHI'),
(181, 'ALTOS DEL ROSARIO'),
(182, 'ARENAL'),
(183, 'ARJONA'),
(184, 'ARROYOHONDO'),
(185, 'BARRANCO DE LOBA'),
(186, 'CALAMAR'),
(187, 'CANTAGALLO'),
(188, 'CICUCO'),
(189, 'CORDOBA'),
(190, 'CLEMENCIA'),
(191, 'EL CARMEN DE BOLIVAR'),
(192, 'EL GUAMO'),
(193, 'EL PE??ON'),
(194, 'HATILLO DE LOBA'),
(195, 'MAGANGUE'),
(196, 'MAHATES'),
(197, 'MARGARITA'),
(198, 'MARIA LA BAJA'),
(199, 'MONTECRISTO'),
(200, 'MOMPOS'),
(201, 'NOROSI'),
(202, 'MORALES'),
(203, 'PINILLOS'),
(204, 'REGIDOR'),
(205, 'RIO VIEJO'),
(206, 'SAN CRISTOBAL'),
(207, 'SAN ESTANISLAO'),
(208, 'SAN FERNANDO'),
(209, 'SAN JACINTO'),
(210, 'SAN JACINTO DEL CAUCA'),
(211, 'SAN JUAN NEPOMUCENO'),
(212, 'SAN MARTIN DE LOBA'),
(213, 'SAN PABLO'),
(214, 'SANTA CATALINA'),
(215, 'SANTA ROSA'),
(216, 'SANTA ROSA DEL SUR'),
(217, 'SIMITI'),
(218, 'SOPLAVIENTO'),
(219, 'TALAIGUA NUEVO'),
(220, 'TIQUISIO'),
(221, 'TURBACO'),
(222, 'TURBANA'),
(223, 'VILLANUEVA'),
(224, 'ZAMBRANO'),
(225, 'ALMEIDA'),
(226, 'AQUITANIA'),
(227, 'ARCABUCO'),
(228, 'BELEN'),
(229, 'BERBEO'),
(230, 'BETEITIVA'),
(231, 'BOAVITA'),
(232, 'BOYACA'),
(234, 'BUENAVISTA'),
(235, 'BUSBANZA'),
(237, 'CAMPOHERMOSO'),
(238, 'CERINZA'),
(239, 'CHINAVITA'),
(240, 'CHIQUINQUIRA'),
(241, 'CHISCAS'),
(242, 'CHITA'),
(243, 'CHITARAQUE'),
(244, 'CHIVATA'),
(245, 'CIENEGA'),
(246, 'COMBITA'),
(247, 'COPER'),
(248, 'CORRALES'),
(249, 'COVARACHIA'),
(250, 'CUBARA'),
(251, 'CUCAITA'),
(252, 'CUITIVA'),
(253, 'CHIQUIZA'),
(254, 'CHIVOR'),
(255, 'DUITAMA'),
(256, 'EL COCUY'),
(257, 'EL ESPINO'),
(258, 'FIRAVITOBA'),
(259, 'FLORESTA'),
(260, 'GACHANTIVA'),
(261, 'GAMEZA'),
(262, 'GARAGOA'),
(263, 'GUACAMAYAS'),
(264, 'GUATEQUE'),
(265, 'GUAYATA'),
(266, 'GsICAN'),
(267, 'IZA'),
(268, 'JENESANO'),
(270, 'LABRANZAGRANDE'),
(271, 'LA CAPILLA'),
(272, 'LA VICTORIA'),
(273, 'LA UVITA'),
(274, 'VILLA DE LEYVA'),
(275, 'MACANAL'),
(276, 'MARIPI'),
(277, 'MIRAFLORES'),
(278, 'MONGUA'),
(279, 'MONGUI'),
(280, 'MONIQUIRA'),
(281, 'MOTAVITA'),
(282, 'MUZO'),
(283, 'NOBSA'),
(284, 'NUEVO COLON'),
(285, 'OICATA'),
(286, 'OTANCHE'),
(287, 'PACHAVITA'),
(288, 'PAEZ'),
(289, 'PAIPA'),
(290, 'PAJARITO'),
(291, 'PANQUEBA'),
(292, 'PAUNA'),
(293, 'PAYA'),
(294, 'PAZ DE RIO'),
(295, 'PESCA'),
(296, 'PISBA'),
(297, 'PUERTO BOYACA'),
(298, 'QUIPAMA'),
(299, 'RAMIRIQUI'),
(300, 'RAQUIRA'),
(301, 'RONDON'),
(302, 'SABOYA'),
(303, 'SACHICA'),
(304, 'SAMACA'),
(305, 'SAN EDUARDO'),
(306, 'SAN JOSE DE PARE'),
(307, 'SAN LUIS DE GACENO'),
(308, 'SAN MATEO'),
(309, 'SAN MIGUEL DE SEMA'),
(310, 'SAN PABLO DE BORBUR'),
(311, 'SANTANA'),
(312, 'SANTA MARIA'),
(313, 'SANTA ROSA DE VITERBO'),
(314, 'SANTA SOFIA'),
(315, 'SATIVANORTE'),
(316, 'SATIVASUR'),
(317, 'SIACHOQUE'),
(318, 'SOATA'),
(319, 'SOCOTA'),
(320, 'SOCHA'),
(321, 'SOGAMOSO'),
(322, 'SOMONDOCO'),
(323, 'SORA'),
(324, 'SOTAQUIRA'),
(325, 'SORACA'),
(326, 'SUSACON'),
(327, 'SUTAMARCHAN'),
(328, 'SUTATENZA'),
(329, 'TASCO'),
(330, 'TENZA'),
(331, 'TIBANA'),
(332, 'TIBASOSA'),
(333, 'TINJACA'),
(334, 'TIPACOQUE'),
(335, 'TOCA'),
(336, 'TOGsI'),
(337, 'TOPAGA'),
(338, 'TOTA'),
(339, 'TUNUNGUA'),
(340, 'TURMEQUE'),
(341, 'TUTA'),
(342, 'TUTAZA'),
(343, 'UMBITA'),
(344, 'VENTAQUEMADA'),
(345, 'VIRACACHA'),
(346, 'ZETAQUIRA'),
(347, 'AGUADAS'),
(348, 'ANSERMA'),
(349, 'ARANZAZU'),
(350, 'BELALCAZAR'),
(351, 'CHINCHINA'),
(352, 'FILADELFIA'),
(353, 'LA DORADA'),
(354, 'LA MERCED'),
(355, 'MANZANARES'),
(356, 'MARMATO'),
(357, 'MARQUETALIA'),
(358, 'MARULANDA'),
(359, 'NEIRA'),
(360, 'NORCASIA'),
(361, 'PACORA'),
(362, 'PALESTINA'),
(363, 'PENSILVANIA'),
(364, 'RIOSUCIO'),
(365, 'RISARALDA'),
(366, 'SALAMINA'),
(367, 'SAMANA'),
(368, 'SAN JOSE'),
(369, 'SUPIA'),
(370, 'VICTORIA'),
(371, 'VILLAMARIA'),
(372, 'VITERBO'),
(373, 'ALBANIA'),
(374, 'BELEN DE LOS ANDAQUIES'),
(375, 'CARTAGENA DEL CHAIRA'),
(376, 'CURILLO'),
(377, 'EL DONCELLO'),
(378, 'EL PAUJIL'),
(379, 'LA MONTA??ITA'),
(380, 'MILAN'),
(381, 'MORELIA'),
(382, 'PUERTO RICO'),
(383, 'SAN JOSE DEL FRAGUA'),
(384, 'SAN VICENTE DEL CAGUAN'),
(385, 'SOLANO'),
(386, 'SOLITA'),
(387, 'VALPARAISO'),
(388, 'ALMAGUER'),
(390, 'BALBOA'),
(391, 'BOLIVAR'),
(392, 'BUENOS AIRES'),
(393, 'CAJIBIO'),
(394, 'CALDONO'),
(395, 'CALOTO'),
(396, 'CORINTO'),
(397, 'EL TAMBO'),
(398, 'GUACHENE'),
(399, 'GUAPI'),
(400, 'INZA'),
(401, 'JAMBALO'),
(402, 'LA SIERRA'),
(403, 'LA VEGA'),
(404, 'LOPEZ'),
(405, 'MERCADERES'),
(406, 'MIRANDA'),
(407, 'MORALES'),
(408, 'PADILLA'),
(409, 'PAEZ'),
(410, 'PATIA'),
(411, 'PIAMONTE'),
(412, 'PIENDAMO'),
(413, 'PUERTO TEJADA'),
(414, 'PURACE'),
(415, 'ROSAS'),
(416, 'SAN SEBASTIAN'),
(417, 'SANTANDER DE QUILICHAO'),
(418, 'SANTA ROSA'),
(419, 'SILVIA'),
(420, 'SOTARA'),
(421, 'SUAREZ'),
(422, 'SUCRE'),
(423, 'TIMBIO'),
(424, 'TIMBIQUI'),
(425, 'TORIBIO'),
(426, 'TOTORO'),
(427, 'VILLA RICA'),
(428, 'AGUACHICA'),
(429, 'AGUSTIN CODAZZI'),
(430, 'ASTREA'),
(431, 'BECERRIL'),
(432, 'BOSCONIA'),
(433, 'CHIMICHAGUA'),
(434, 'CHIRIGUANA'),
(435, 'CURUMANI'),
(436, 'EL COPEY'),
(437, 'EL PASO'),
(438, 'GAMARRA'),
(439, 'GONZALEZ'),
(440, 'LA GLORIA'),
(441, 'LA JAGUA DE IBIRICO'),
(442, 'MANAURE'),
(443, 'PAILITAS'),
(444, 'PELAYA'),
(445, 'PUEBLO BELLO'),
(446, 'RIO DE ORO'),
(447, 'LA PAZ'),
(448, 'SAN ALBERTO'),
(449, 'SAN DIEGO'),
(450, 'SAN MARTIN'),
(451, 'TAMALAMEQUE'),
(452, 'AYAPEL'),
(453, 'BUENAVISTA'),
(454, 'CANALETE'),
(455, 'CERETE'),
(456, 'CHIMA'),
(457, 'CHINU'),
(458, 'CIENAGA DE ORO'),
(459, 'COTORRA'),
(460, 'LA APARTADA'),
(461, 'LORICA'),
(462, 'LOS CORDOBAS'),
(463, 'MOMIL'),
(464, 'MONTELIBANO'),
(465, 'MO??ITOS'),
(466, 'PLANETA RICA'),
(467, 'PUEBLO NUEVO'),
(468, 'PUERTO ESCONDIDO'),
(469, 'PUERTO LIBERTADOR'),
(470, 'PURISIMA'),
(471, 'SAHAGUN'),
(472, 'SAN ANDRES SOTAVENTO'),
(473, 'SAN ANTERO'),
(474, 'SAN BERNARDO DEL VIENTO'),
(476, 'SAN PELAYO'),
(477, 'TIERRALTA'),
(478, 'VALENCIA'),
(479, 'ALBAN'),
(480, 'ANAPOIMA'),
(481, 'ANOLAIMA'),
(482, 'ARBELAEZ'),
(483, 'BELTRAN'),
(484, 'BITUIMA'),
(485, 'BOJACA'),
(486, 'CABRERA'),
(487, 'CACHIPAY'),
(488, 'CAJICA'),
(489, 'CAPARRAPI'),
(490, 'CAQUEZA'),
(491, 'CARMEN DE CARUPA'),
(492, 'CHAGUANI'),
(493, 'CHIA'),
(494, 'CHIPAQUE'),
(495, 'CHOACHI'),
(496, 'CHOCONTA'),
(497, 'COGUA'),
(498, 'COTA'),
(499, 'CUCUNUBA'),
(500, 'EL COLEGIO'),
(501, 'EL PE??ON'),
(502, 'EL ROSAL'),
(503, 'FACATATIVA'),
(504, 'FOMEQUE'),
(505, 'FOSCA'),
(506, 'FUNZA'),
(507, 'FUQUENE'),
(508, 'FUSAGASUGA'),
(509, 'GACHALA'),
(510, 'GACHANCIPA'),
(511, 'GACHETA'),
(512, 'GAMA'),
(513, 'GIRARDOT'),
(515, 'GUACHETA'),
(516, 'GUADUAS'),
(517, 'GUASCA'),
(518, 'GUATAQUI'),
(519, 'GUATAVITA'),
(520, 'GUAYABAL DE SIQUIMA'),
(521, 'GUAYABETAL'),
(522, 'GUTIERREZ'),
(523, 'JERUSALEN'),
(524, 'JUNIN'),
(525, 'LA CALERA'),
(526, 'LA MESA'),
(527, 'LA PALMA'),
(528, 'LA PE??A'),
(529, 'LA VEGA'),
(530, 'LENGUAZAQUE'),
(531, 'MACHETA'),
(532, 'MADRID'),
(533, 'MANTA'),
(534, 'MEDINA'),
(535, 'MOSQUERA'),
(537, 'NEMOCON'),
(538, 'NILO'),
(539, 'NIMAIMA'),
(540, 'NOCAIMA'),
(541, 'VENECIA'),
(542, 'PACHO'),
(543, 'PAIME'),
(544, 'PANDI'),
(545, 'PARATEBUENO'),
(546, 'PASCA'),
(547, 'PUERTO SALGAR'),
(548, 'PULI'),
(549, 'QUEBRADANEGRA'),
(550, 'QUETAME'),
(551, 'QUIPILE'),
(552, 'APULO'),
(553, 'RICAURTE'),
(554, 'SAN ANTONIO DEL TEQUENDAMA'),
(555, 'SAN BERNARDO'),
(556, 'SAN CAYETANO'),
(558, 'SAN JUAN DE RIO SECO'),
(559, 'SASAIMA'),
(560, 'SESQUILE'),
(561, 'SIBATE'),
(562, 'SILVANIA'),
(563, 'SIMIJACA'),
(564, 'SOACHA'),
(565, 'SOPO'),
(566, 'SUBACHOQUE'),
(567, 'SUESCA'),
(568, 'SUPATA'),
(569, 'SUSA'),
(570, 'SUTATAUSA'),
(571, 'TABIO'),
(572, 'TAUSA'),
(573, 'TENA'),
(574, 'TENJO'),
(575, 'TIBACUY'),
(576, 'TIBIRITA'),
(577, 'TOCAIMA'),
(578, 'TOCANCIPA'),
(579, 'TOPAIPI'),
(580, 'UBALA'),
(581, 'UBAQUE'),
(582, 'VILLA DE SAN DIEGO DE UBATE'),
(583, 'UNE'),
(584, 'UTICA'),
(585, 'VERGARA'),
(586, 'VIANI'),
(587, 'VILLAGOMEZ'),
(588, 'VILLAPINZON'),
(589, 'VILLETA'),
(590, 'VIOTA'),
(591, 'YACOPI'),
(592, 'ZIPACON'),
(593, 'ZIPAQUIRA'),
(594, 'ACANDI'),
(595, 'ALTO BAUDO'),
(596, 'ATRATO'),
(597, 'BAGADO'),
(598, 'BAHIA SOLANO'),
(599, 'BAJO BAUDO'),
(600, 'BOJAYA'),
(601, 'EL CANTON DEL SAN PABLO'),
(602, 'CARMEN DEL DARIEN'),
(603, 'CERTEGUI'),
(604, 'CONDOTO'),
(605, 'EL CARMEN DE ATRATO'),
(606, 'EL LITORAL DEL SAN JUAN'),
(607, 'ISTMINA'),
(608, 'JURADO'),
(609, 'LLORO'),
(610, 'MEDIO ATRATO'),
(611, 'MEDIO BAUDO'),
(612, 'MEDIO SAN JUAN'),
(613, 'NOVITA'),
(614, 'NUQUI'),
(615, 'RIO IRO'),
(616, 'RIO QUITO'),
(617, 'RIOSUCIO'),
(618, 'SAN JOSE DEL PALMAR'),
(619, 'SIPI'),
(620, 'TADO'),
(621, 'UNGUIA'),
(622, 'UNION PANAMERICANA'),
(623, 'ACEVEDO'),
(624, 'AGRADO'),
(625, 'AIPE'),
(626, 'ALGECIRAS'),
(627, 'ALTAMIRA'),
(628, 'BARAYA'),
(629, 'CAMPOALEGRE'),
(630, 'COLOMBIA'),
(631, 'ELIAS'),
(632, 'GARZON'),
(633, 'GIGANTE'),
(635, 'HOBO'),
(636, 'IQUIRA'),
(637, 'ISNOS'),
(638, 'LA ARGENTINA'),
(639, 'LA PLATA'),
(640, 'NATAGA'),
(641, 'OPORAPA'),
(642, 'PAICOL'),
(643, 'PALERMO'),
(644, 'PALESTINA'),
(645, 'PITAL'),
(646, 'PITALITO'),
(647, 'RIVERA'),
(648, 'SALADOBLANCO'),
(649, 'SAN AGUSTIN'),
(650, 'SANTA MARIA'),
(651, 'SUAZA'),
(652, 'TARQUI'),
(653, 'TESALIA'),
(654, 'TELLO'),
(655, 'TERUEL'),
(656, 'TIMANA'),
(657, 'VILLAVIEJA'),
(658, 'YAGUARA'),
(659, 'ALBANIA'),
(660, 'BARRANCAS'),
(661, 'DIBULLA'),
(662, 'DISTRACCION'),
(663, 'EL MOLINO'),
(664, 'FONSECA'),
(665, 'HATONUEVO'),
(666, 'LA JAGUA DEL PILAR'),
(667, 'MAICAO'),
(668, 'MANAURE'),
(669, 'SAN JUAN DEL CESAR'),
(670, 'URIBIA'),
(671, 'URUMITA'),
(672, 'VILLANUEVA'),
(673, 'ALGARROBO'),
(674, 'ARACATACA'),
(675, 'ARIGUANI'),
(676, 'CERRO SAN ANTONIO'),
(677, 'CHIBOLO'),
(678, 'CIENAGA'),
(680, 'EL BANCO'),
(681, 'EL PI??ON'),
(682, 'EL RETEN'),
(683, 'FUNDACION'),
(684, 'GUAMAL'),
(685, 'NUEVA GRANADA'),
(686, 'PEDRAZA'),
(687, 'PIJI??O DEL CARMEN'),
(688, 'PIVIJAY'),
(689, 'PLATO'),
(690, 'PUEBLOVIEJO'),
(691, 'REMOLINO'),
(692, 'SABANAS DE SAN ANGEL'),
(693, 'SALAMINA'),
(694, 'SAN SEBASTIAN DE BUENAVISTA'),
(695, 'SAN ZENON'),
(696, 'SANTA ANA'),
(697, 'SANTA BARBARA DE PINTO'),
(698, 'SITIONUEVO'),
(699, 'TENERIFE'),
(700, 'ZAPAYAN'),
(701, 'ZONA BANANERA'),
(702, 'ACACIAS'),
(703, 'BARRANCA DE UPIA'),
(704, 'CABUYARO'),
(705, 'CASTILLA LA NUEVA'),
(706, 'CUBARRAL'),
(707, 'CUMARAL'),
(708, 'EL CALVARIO'),
(709, 'EL CASTILLO'),
(710, 'EL DORADO'),
(711, 'FUENTE DE ORO'),
(713, 'GUAMAL'),
(714, 'MAPIRIPAN'),
(715, 'MESETAS'),
(716, 'LA MACARENA'),
(717, 'URIBE'),
(718, 'LEJANIAS'),
(719, 'PUERTO CONCORDIA'),
(720, 'PUERTO GAITAN'),
(721, 'PUERTO LOPEZ'),
(722, 'PUERTO LLERAS'),
(723, 'PUERTO RICO'),
(724, 'RESTREPO'),
(726, 'SAN JUAN DE ARAMA'),
(727, 'SAN JUANITO'),
(728, 'SAN MARTIN'),
(729, 'VISTAHERMOSA'),
(730, 'ALBAN'),
(731, 'ALDANA'),
(732, 'ANCUYA'),
(733, 'ARBOLEDA'),
(734, 'BARBACOAS'),
(735, 'BELEN'),
(736, 'BUESACO'),
(737, 'COLON'),
(738, 'CONSACA'),
(739, 'CONTADERO'),
(740, 'CORDOBA'),
(741, 'CUASPUD'),
(742, 'CUMBAL'),
(743, 'CUMBITARA'),
(744, 'CHACHAGsI'),
(745, 'EL CHARCO'),
(746, 'EL PE??OL'),
(747, 'EL ROSARIO'),
(748, 'EL TABLON DE GOMEZ'),
(749, 'EL TAMBO'),
(750, 'FUNES'),
(751, 'GUACHUCAL'),
(752, 'GUAITARILLA'),
(753, 'GUALMATAN'),
(754, 'ILES'),
(755, 'IMUES'),
(756, 'IPIALES'),
(757, 'LA CRUZ'),
(758, 'LA FLORIDA'),
(759, 'LA LLANADA'),
(760, 'LA TOLA'),
(762, 'LEIVA'),
(763, 'LINARES'),
(764, 'LOS ANDES'),
(765, 'MAGsI'),
(766, 'MALLAMA'),
(767, 'MOSQUERA'),
(769, 'OLAYA HERRERA'),
(770, 'OSPINA'),
(771, 'FRANCISCO PIZARRO'),
(772, 'POLICARPA'),
(773, 'POTOSI'),
(774, 'PROVIDENCIA'),
(775, 'PUERRES'),
(776, 'PUPIALES'),
(777, 'RICAURTE'),
(778, 'ROBERTO PAYAN'),
(779, 'SAMANIEGO'),
(780, 'SANDONA'),
(781, 'SAN BERNARDO'),
(782, 'SAN LORENZO'),
(783, 'SAN PABLO'),
(784, 'SAN PEDRO DE CARTAGO'),
(785, 'SANTA BARBARA'),
(786, 'SANTACRUZ'),
(787, 'SAPUYES'),
(788, 'TAMINANGO'),
(789, 'TANGUA'),
(790, 'SAN ANDRES DE TUMACO'),
(791, 'TUQUERRES'),
(792, 'YACUANQUER'),
(793, 'ABREGO'),
(794, 'ARBOLEDAS'),
(795, 'BOCHALEMA'),
(796, 'BUCARASICA'),
(797, 'CACOTA'),
(798, 'CACHIRA'),
(799, 'CHINACOTA'),
(800, 'CHITAGA'),
(801, 'CONVENCION'),
(802, 'CUCUTILLA'),
(803, 'DURANIA'),
(804, 'EL CARMEN'),
(805, 'EL TARRA'),
(806, 'EL ZULIA'),
(807, 'GRAMALOTE'),
(808, 'HACARI'),
(809, 'HERRAN'),
(810, 'LABATECA'),
(811, 'LA ESPERANZA'),
(812, 'LA PLAYA'),
(813, 'LOS PATIOS'),
(814, 'LOURDES'),
(815, 'MUTISCUA'),
(816, 'OCA??A'),
(817, 'PAMPLONA'),
(818, 'PAMPLONITA'),
(819, 'PUERTO SANTANDER'),
(820, 'RAGONVALIA'),
(821, 'SALAZAR'),
(822, 'SAN CALIXTO'),
(823, 'SAN CAYETANO'),
(824, 'SANTIAGO'),
(825, 'SARDINATA'),
(826, 'SILOS'),
(827, 'TEORAMA'),
(828, 'TIBU'),
(829, 'TOLEDO'),
(830, 'VILLA CARO'),
(831, 'VILLA DEL ROSARIO'),
(832, 'BUENAVISTA'),
(833, 'CALARCA'),
(834, 'CIRCASIA'),
(835, 'CORDOBA'),
(836, 'FILANDIA'),
(837, 'GENOVA'),
(838, 'LA TEBAIDA'),
(839, 'MONTENEGRO'),
(840, 'PIJAO'),
(841, 'QUIMBAYA'),
(842, 'SALENTO'),
(843, 'APIA'),
(844, 'BALBOA'),
(845, 'BELEN DE UMBRIA'),
(846, 'DOSQUEBRADAS'),
(847, 'GUATICA'),
(848, 'LA CELIA'),
(849, 'LA VIRGINIA'),
(850, 'MARSELLA'),
(851, 'MISTRATO'),
(852, 'PUEBLO RICO'),
(853, 'QUINCHIA'),
(854, 'SANTA ROSA DE CABAL'),
(855, 'SANTUARIO'),
(856, 'AGUADA'),
(857, 'ALBANIA'),
(858, 'ARATOCA'),
(860, 'BARICHARA'),
(861, 'BARRANCABERMEJA'),
(863, 'BOLIVAR'),
(864, 'CABRERA'),
(865, 'CALIFORNIA'),
(866, 'CAPITANEJO'),
(867, 'CARCASI'),
(868, 'CEPITA'),
(869, 'CERRITO'),
(870, 'CHARALA'),
(871, 'CHARTA'),
(872, 'CHIMA'),
(873, 'CHIPATA'),
(874, 'CIMITARRA'),
(876, 'CONFINES'),
(877, 'CONTRATACION'),
(878, 'COROMORO'),
(879, 'CURITI'),
(880, 'EL CARMEN DE CHUCURI'),
(881, 'EL GUACAMAYO'),
(882, 'EL PE??ON'),
(883, 'EL PLAYON'),
(884, 'ENCINO'),
(885, 'ENCISO'),
(886, 'FLORIAN'),
(887, 'FLORIDABLANCA'),
(888, 'GALAN'),
(889, 'GAMBITA'),
(890, 'GIRON'),
(891, 'GUACA'),
(893, 'GUAPOTA'),
(894, 'GUAVATA'),
(895, 'GsEPSA'),
(896, 'HATO'),
(897, 'JESUS MARIA'),
(898, 'JORDAN'),
(899, 'LA BELLEZA'),
(900, 'LANDAZURI'),
(901, 'LA PAZ'),
(902, 'LEBRIJA'),
(903, 'LOS SANTOS'),
(904, 'MACARAVITA'),
(905, 'MALAGA'),
(906, 'MATANZA'),
(907, 'MOGOTES'),
(908, 'MOLAGAVITA'),
(909, 'OCAMONTE'),
(910, 'OIBA'),
(911, 'ONZAGA'),
(912, 'PALMAR'),
(913, 'PALMAS DEL SOCORRO'),
(914, 'PARAMO'),
(915, 'PIEDECUESTA'),
(916, 'PINCHOTE'),
(917, 'PUENTE NACIONAL'),
(918, 'PUERTO PARRA'),
(919, 'PUERTO WILCHES'),
(921, 'SABANA DE TORRES'),
(922, 'SAN ANDRES'),
(923, 'SAN BENITO'),
(924, 'SAN GIL'),
(925, 'SAN JOAQUIN'),
(926, 'SAN JOSE DE MIRANDA'),
(927, 'SAN MIGUEL'),
(928, 'SAN VICENTE DE CHUCURI'),
(929, 'SANTA BARBARA'),
(930, 'SANTA HELENA DEL OPON'),
(931, 'SIMACOTA'),
(932, 'SOCORRO'),
(933, 'SUAITA'),
(934, 'SUCRE'),
(935, 'SURATA'),
(936, 'TONA'),
(937, 'VALLE DE SAN JOSE'),
(938, 'VELEZ'),
(939, 'VETAS'),
(940, 'VILLANUEVA'),
(941, 'ZAPATOCA'),
(942, 'BUENAVISTA'),
(943, 'CAIMITO'),
(944, 'COLOSO'),
(945, 'COROZAL'),
(946, 'COVE??AS'),
(947, 'CHALAN'),
(948, 'EL ROBLE'),
(949, 'GALERAS'),
(950, 'GUARANDA'),
(952, 'LOS PALMITOS'),
(953, 'MAJAGUAL'),
(954, 'MORROA'),
(955, 'OVEJAS'),
(956, 'PALMITO'),
(957, 'SAMPUES'),
(958, 'SAN BENITO ABAD'),
(959, 'SAN JUAN DE BETULIA'),
(960, 'SAN MARCOS'),
(961, 'SAN ONOFRE'),
(962, 'SAN PEDRO'),
(963, 'SAN LUIS DE SINCE'),
(964, 'SUCRE'),
(965, 'SANTIAGO DE TOLU'),
(966, 'TOLU VIEJO'),
(967, 'ALPUJARRA'),
(968, 'ALVARADO'),
(969, 'AMBALEMA'),
(970, 'ANZOATEGUI'),
(971, 'ARMERO'),
(972, 'ATACO'),
(973, 'CAJAMARCA'),
(974, 'CARMEN DE APICALA'),
(975, 'CASABIANCA'),
(976, 'CHAPARRAL'),
(977, 'COELLO'),
(978, 'COYAIMA'),
(979, 'CUNDAY'),
(980, 'DOLORES'),
(981, 'ESPINAL'),
(982, 'FALAN'),
(983, 'FLANDES'),
(984, 'FRESNO'),
(985, 'GUAMO'),
(986, 'HERVEO'),
(987, 'HONDA'),
(988, 'ICONONZO'),
(989, 'LERIDA'),
(990, 'LIBANO'),
(991, 'MARIQUITA'),
(992, 'MELGAR'),
(993, 'MURILLO'),
(994, 'NATAGAIMA'),
(995, 'ORTEGA'),
(996, 'PALOCABILDO'),
(997, 'PIEDRAS'),
(998, 'PLANADAS'),
(999, 'PRADO'),
(1000, 'PURIFICACION'),
(1001, 'RIOBLANCO'),
(1002, 'RONCESVALLES'),
(1003, 'ROVIRA'),
(1004, 'SALDA??A'),
(1005, 'SAN ANTONIO'),
(1006, 'SAN LUIS'),
(1007, 'SANTA ISABEL'),
(1008, 'SUAREZ'),
(1009, 'VALLE DE SAN JUAN'),
(1010, 'VENADILLO'),
(1011, 'VILLAHERMOSA'),
(1012, 'VILLARRICA'),
(1013, 'ALCALA'),
(1014, 'ANDALUCIA'),
(1015, 'ANSERMANUEVO'),
(1017, 'BOLIVAR'),
(1018, 'BUENAVENTURA'),
(1019, 'GUADALAJARA DE BUGA'),
(1020, 'BUGALAGRANDE'),
(1021, 'CAICEDONIA'),
(1022, 'CALIMA'),
(1023, 'CANDELARIA'),
(1024, 'CARTAGO'),
(1025, 'DAGUA'),
(1026, 'EL AGUILA'),
(1027, 'EL CAIRO'),
(1028, 'EL CERRITO'),
(1029, 'EL DOVIO'),
(1030, 'FLORIDA'),
(1031, 'GINEBRA'),
(1032, 'GUACARI'),
(1033, 'JAMUNDI'),
(1034, 'LA CUMBRE'),
(1036, 'LA VICTORIA'),
(1037, 'OBANDO'),
(1038, 'PALMIRA'),
(1039, 'PRADERA'),
(1040, 'RESTREPO'),
(1041, 'RIOFRIO'),
(1042, 'ROLDANILLO'),
(1043, 'SAN PEDRO'),
(1044, 'SEVILLA'),
(1045, 'TORO'),
(1046, 'TRUJILLO'),
(1047, 'TULUA'),
(1048, 'ULLOA'),
(1049, 'VERSALLES'),
(1050, 'VIJES'),
(1051, 'YOTOCO'),
(1052, 'YUMBO'),
(1053, 'ZARZAL'),
(1054, 'ARAUQUITA'),
(1055, 'CRAVO NORTE'),
(1056, 'FORTUL'),
(1057, 'PUERTO RONDON'),
(1058, 'SARAVENA'),
(1059, 'TAME'),
(1060, 'AGUAZUL'),
(1061, 'CHAMEZA'),
(1062, 'HATO COROZAL'),
(1063, 'LA SALINA'),
(1064, 'MANI'),
(1065, 'MONTERREY'),
(1066, 'NUNCHIA'),
(1067, 'OROCUE'),
(1068, 'PAZ DE ARIPORO'),
(1069, 'PORE'),
(1070, 'RECETOR'),
(1072, 'SACAMA'),
(1073, 'SAN LUIS DE PALENQUE'),
(1074, 'TAMARA'),
(1075, 'TAURAMENA'),
(1076, 'TRINIDAD'),
(1077, 'VILLANUEVA'),
(1078, 'COLON'),
(1079, 'ORITO'),
(1080, 'PUERTO ASIS'),
(1081, 'PUERTO CAICEDO'),
(1082, 'PUERTO GUZMAN'),
(1083, 'LEGUIZAMO'),
(1084, 'SIBUNDOY'),
(1086, 'SAN MIGUEL'),
(1087, 'SANTIAGO'),
(1088, 'VALLE DEL GUAMUEZ'),
(1089, 'VILLAGARZON'),
(1090, 'PROVIDENCIA'),
(1091, 'EL ENCANTO'),
(1092, 'LA CHORRERA'),
(1093, 'LA PEDRERA'),
(1094, 'LA VICTORIA'),
(1095, 'MIRITI - PARANA'),
(1096, 'PUERTO ALEGRIA'),
(1097, 'PUERTO ARICA'),
(1098, 'PUERTO NARI??O'),
(1099, 'PUERTO SANTANDER'),
(1100, 'TARAPACA'),
(1101, 'BARRANCO MINAS'),
(1102, 'MAPIRIPANA'),
(1103, 'SAN FELIPE'),
(1104, 'PUERTO COLOMBIA'),
(1105, 'LA GUADALUPE'),
(1106, 'CACAHUAL'),
(1107, 'PANA PANA'),
(1108, 'MORICHAL'),
(1109, 'CALAMAR'),
(1110, 'EL RETORNO'),
(1111, 'MIRAFLORES'),
(1112, 'CARURU'),
(1113, 'PACOA'),
(1114, 'TARAIRA'),
(1115, 'PAPUNAUA'),
(1116, 'YAVARATE'),
(1117, 'LA PRIMAVERA'),
(1118, 'SANTA ROSALIA'),
(1119, 'CUMARIBO'),
(1120, 'LA LOMA'),
(1121, 'PANAMA'),
(1122, 'MARACAIBO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_clientes`
--

CREATE TABLE `t_clientes` (
  `Id_Cliente` int(11) NOT NULL,
  `Avatar_Cliente` text NOT NULL,
  `Documento_Cliente` bigint(20) NOT NULL,
  `Nom_Cliente` varchar(255) NOT NULL,
  `Ape_Cliente` varchar(255) NOT NULL,
  `Dir_Cliente` varchar(1024) NOT NULL,
  `Ciudad_Id_Ciudad` int(11) NOT NULL,
  `Correo_Cliente` varchar(512) NOT NULL,
  `Tel_Cliente` varchar(255) NOT NULL,
  `Cel1_Cliente` varchar(255) NOT NULL,
  `Cel2_Cliente` varchar(255) NOT NULL,
  `Tipo_Cliente` int(11) NOT NULL,
  `Largo_Manga` float NOT NULL,
  `Largo_Camisa` float NOT NULL,
  `Espalda` float NOT NULL,
  `Pecho` float NOT NULL,
  `Abdomen` float NOT NULL,
  `Contorno_Cuello` float NOT NULL,
  `Cintura` float NOT NULL,
  `Cadera` float NOT NULL,
  `Tiro` float NOT NULL,
  `Pierna` float NOT NULL,
  `Rodilla` float NOT NULL,
  `Pantorrilla` float NOT NULL,
  `Bota` float NOT NULL,
  `Largo_Pantalon` float NOT NULL,
  `Ingresado_Por` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Fechadia` int(11) NOT NULL,
  `Fechames` int(11) NOT NULL,
  `Fechaano` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_colecciones`
--

CREATE TABLE `t_colecciones` (
  `Id_Coleccion` int(11) NOT NULL,
  `Nom_Coleccion` varchar(255) NOT NULL,
  `Fecha_Inicio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_colores`
--

CREATE TABLE `t_colores` (
  `Id_Color` int(11) NOT NULL,
  `Nom_Color` varchar(255) NOT NULL,
  `Valor_Color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_colores`
--

INSERT INTO `t_colores` (`Id_Color`, `Nom_Color`, `Valor_Color`) VALUES
(16, 'Blanco', '#FFFFFF'),
(17, 'Negro', '#000000'),
(18, 'Gris', '#A5A5A5'),
(19, 'Dorado', '#D6B003'),
(20, 'Amarillo', '#FFFF00'),
(21, 'Azul', '#005DFF'),
(22, 'Rojo', '#FF0000'),
(23, 'Verde', '#17BA00'),
(24, 'Morado', '#8B00FF'),
(25, 'Naranja', '#FF9B00'),
(26, 'Violeta', '#EA77FF'),
(27, 'Marron', '#A48109'),
(28, 'Cafe', '#593B00'),
(29, 'Beige', '#FEF2DA'),
(31, 'Rosado', '#FFDBF3'),
(32, 'Azul Cielo', ''),
(33, 'Vino Tinto', ''),
(34, 'Mostaza', ''),
(35, 'Fucsia', ''),
(36, 'Avory', ''),
(37, 'Coral', ''),
(38, 'Trigo', ''),
(39, 'Lavanda', ''),
(40, 'BABY BLUE ', ''),
(41, 'Dark Blue', ''),
(42, 'Avena', ''),
(43, 'Lila', ''),
(44, 'Salmon', ''),
(45, 'Caqui', ''),
(46, 'Ladrillo', ''),
(47, 'Variado', ''),
(48, 'AZUL TURQUI', ''),
(49, 'Rosado Bebe', ''),
(50, 'Verde Menta', ''),
(51, 'Aqua', ''),
(52, 'Azul Rey', ''),
(53, 'Miel', ''),
(54, 'Hielo', ''),
(55, 'Surtidos', ''),
(56, 'Chocolate', ''),
(57, 'Mamon', ''),
(58, 'AZUL PETROLEO', ''),
(59, 'Nude', ''),
(60, 'Camel', ''),
(61, 'Palo de Rosa', ''),
(62, 'Rojo fuego', ''),
(63, 'Blanco pig', ''),
(64, 'Verde Militar ', ''),
(65, 'Arena', ''),
(66, 'Turquesa', ''),
(67, 'Oro Rosa', ''),
(68, 'Plateado', ''),
(69, 'TRANSPARENTE', ''),
(70, 'SAFARI', ''),
(71, 'CAFE LIGHT ', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_colores_ref`
--

CREATE TABLE `t_colores_ref` (
  `Id_Color_Ref` int(11) NOT NULL,
  `Color_Id_Color` int(11) NOT NULL,
  `Referencia_Cod_Referencia` varchar(255) NOT NULL,
  `Color_Ref_Publicado` int(11) NOT NULL,
  `Cod_Insumo_Color` varchar(255) NOT NULL,
  `Cant_Insumo_Color` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_comentarios_produccion`
--

CREATE TABLE `t_comentarios_produccion` (
  `Id_Comentario_Produccion` int(11) NOT NULL,
  `Usuario_id_usuario` int(11) NOT NULL,
  `Fecha_Comentario` datetime NOT NULL,
  `Comentario_Prod` text NOT NULL,
  `Solicitud_Cod_Orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_comentarios_produccion_cliente`
--

CREATE TABLE `t_comentarios_produccion_cliente` (
  `Id_Comentario_Produccion` int(11) NOT NULL,
  `Usuario_id_usuario` int(11) NOT NULL,
  `Fecha_Comentario` datetime NOT NULL,
  `Comentario_Prod` varchar(3096) NOT NULL,
  `Solicitud_Cod_Orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_config`
--

CREATE TABLE `t_config` (
  `Nom_App` varchar(255) NOT NULL,
  `Horas_Laborales` int(11) NOT NULL,
  `Footer_App` varchar(255) NOT NULL,
  `Correo_App` varchar(255) NOT NULL,
  `Tiempo` int(11) NOT NULL,
  `Url_Web` varchar(255) NOT NULL,
  `Url_Facebook` varchar(255) NOT NULL,
  `Url_Instagram` varchar(255) NOT NULL,
  `Url_Twitter` varchar(255) NOT NULL,
  `Terminos` text NOT NULL,
  `Desarrollador` varchar(255) NOT NULL,
  `Consecutivo` int(11) NOT NULL COMMENT 'Consecutivo Ordenes Compra',
  `Consecutivo_Factura` int(11) NOT NULL COMMENT 'N??mero Factura ',
  `Consecutivo_Prod` int(11) NOT NULL COMMENT 'Consecutivo Productos',
  `Cons_Orden_Prod` int(11) NOT NULL COMMENT 'Ordenes Produccion',
  `Cons_Despacho` int(11) NOT NULL COMMENT 'Consecutivo Despachos',
  `Cons_PedidosCl` int(11) NOT NULL COMMENT 'Consecutivo Pedidos Clientes',
  `Cons_RecibosCaja` int(11) NOT NULL COMMENT 'Consecutivo Recibos de Caja',
  `Cons_Traslado` int(11) NOT NULL COMMENT 'Consecutivo traslados entre tiendas',
  `Cons_cc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_config`
--

INSERT INTO `t_config` (`Nom_App`, `Horas_Laborales`, `Footer_App`, `Correo_App`, `Tiempo`, `Url_Web`, `Url_Facebook`, `Url_Instagram`, `Url_Twitter`, `Terminos`, `Desarrollador`, `Consecutivo`, `Consecutivo_Factura`, `Consecutivo_Prod`, `Cons_Orden_Prod`, `Cons_Despacho`, `Cons_PedidosCl`, `Cons_RecibosCaja`, `Cons_Traslado`, `Cons_cc`) VALUES
('Modasof', 0, 'Modasof Application 2019-2020 - Desarrollado por: TEKSYSTEM S.A.S', 'manfred1613@hotmail.com', 1440, 'http://www.Modasofaute.com/', 'https://www.facebook.com/ModasofAUTE', 'https://www.instagram.com/Modasofaute/?hl=es-la', 'https://twitter.com/Modasofaute?lang=es', 'Hola', 'TEKSYSTEM S.A.S', 789, 1175, 10327, 33409, 3003, 24539, 2018, 1002, 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_config_tienda`
--

CREATE TABLE `t_config_tienda` (
  `Id_Config_Tienda` int(11) NOT NULL,
  `Consecutivo_Factura` int(11) NOT NULL,
  `Consecutivo_ReciboCaja` int(11) NOT NULL,
  `Consecutivo_Salidas` int(11) NOT NULL,
  `Consecutivo_PlanSepare` int(11) NOT NULL,
  `Resolucion_tienda` varchar(1024) NOT NULL,
  `autorizado_hasta` varchar(1024) NOT NULL,
  `prefijo` varchar(255) NOT NULL,
  `impuesto` decimal(5,2) NOT NULL,
  `condiciones` longtext NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `linea_izquierda1` varchar(1024) NOT NULL,
  `linea_izquierda2` varchar(1024) NOT NULL,
  `linea_izquierda3` varchar(1024) NOT NULL,
  `linea_derecha1` varchar(1024) NOT NULL,
  `linea_derecha2` varchar(1024) NOT NULL,
  `linea_derecha3` varchar(1024) NOT NULL,
  `linea_derecha4` varchar(1024) NOT NULL,
  `articulo` varchar(1024) NOT NULL,
  `aplica_iva` varchar(255) NOT NULL,
  `pedidos_activos` varchar(11) NOT NULL,
  `anticipos_activo` varchar(11) NOT NULL,
  `consecutivo_sc` int(11) NOT NULL,
  `consecutivo_notas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `t_config_tienda`
--

INSERT INTO `t_config_tienda` (`Id_Config_Tienda`, `Consecutivo_Factura`, `Consecutivo_ReciboCaja`, `Consecutivo_Salidas`, `Consecutivo_PlanSepare`, `Resolucion_tienda`, `autorizado_hasta`, `prefijo`, `impuesto`, `condiciones`, `Tienda_Id_Tienda`, `linea_izquierda1`, `linea_izquierda2`, `linea_izquierda3`, `linea_derecha1`, `linea_derecha2`, `linea_derecha3`, `linea_derecha4`, `articulo`, `aplica_iva`, `pedidos_activos`, `anticipos_activo`, `consecutivo_sc`, `consecutivo_notas`) VALUES
(1, 2131, 2316, 1008, 4008, '18762002539041 del 2017/03/15', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 5000', 'CG', '1.16', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ning??n tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el env??o el d??a pactado con el cliente lo cual el cliente puede verificar en la copia de la gu??a que se le har??a llegar para constancia de la fecha de env??o. Nuestras garant??as son por calidad de confecci??n y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los env??os causados adicionalmente * El cliente cuenta con 8 d??as para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devoluci??n de la prenda. Si en com??n acuerdo se pacta un posible ajuste este tendr?? un valor adicional y los costos de env??o corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garant??a por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el d??a Pactado y med??rsela para la verificaci??n de y aceptaci??n de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 d??as despu??s de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 4, '12646038', 'Valledupar (Cesar)', 'Alexander Baute Agamez', 'No somos Grandes contribuyentes - IVA R??gimen Com??n', 'Actividad Econ??mica Principal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000', 'Resoluci??n DIAN No.240000037455 del 2016/02/29', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 5000', 'Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio seg??n art. 774 Cod. Comercio. Es exigible a su vencimiento y causa un inter??s de mora mensual liquidado a la tasa m??xima permitida de conformidad con los art. 883 y 884 C??d', 'Si', 'No', '', 0, 0),
(6, 24760, 8960, 2273, 1007, '240000037455 del 2016/02/29', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 10000', '', '1.19', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ningun tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el envio el dia pactado con el cliente lo cual el cliente puede verificar en la copia de la guia que se le haria llegar para constancia de la fecha de envio. Nuestras garantias son por calidad de confeccion y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los envios causados adicionalmente * El cliente cuenta con 8 dias para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devolucion de la prenda. Si en comun acuerdo se pacta un posible ajuste este tendra un valor adicional y los costos de envio corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garantia por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el dia Pactado y medirsela para la verificacion de y aceptacion de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 dias despues de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 1, '12646038', 'Valledupar (Cesar)', 'Alexander Baute Agamez', 'No somos Grandes contribuyentes - IVA Regimen Comun', 'Actividad Economica Princip enal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000', 'Resolucion DIAN No.240000037455 del 2016/02/29', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 10000', 'Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio segun art. 774 Cod. Comercio. Es exigible a su vencimiento y causa un interes de mora mensual liquidado a la tasa maxima permitida de conformidad con los art. 883 y 884 Cod', 'Si', 'Si', 'No', 17113, 1683),
(7, 4999, 21728, 2215, 2028, '0', '', '', '0.00', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ning??n tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el env??o el d??a pactado con el cliente lo cual el cliente puede verificar en la copia de la gu??a que se le har??a llegar para constancia de la fecha de env??o. Nuestras garant??as son por calidad de confecci??n y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los env??os causados adicionalmente * El cliente cuenta con 8 d??as para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devoluci??n de la prenda. Si en com??n acuerdo se pacta un posible ajuste este tendr?? un valor adicional y los costos de env??o corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garant??a por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el d??a Pactado y med??rsela para la verificaci??n de y aceptaci??n de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 d??as despu??s de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 2, 'NIT.1.003.375.874-1', 'Barranquilla (Atlantico)', 'VALENTINA CASTILLO SALEM', 'No somos Responsables de IVA - Regimen Simplificado', 'Actividad Economica Principal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000', '', '', 'Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio seg??n art. 774 Cod. Comercio. Es exigible a su vencimiento y causa un inter??s de mora mensual liquidado a la tasa m??xima permitida de conformidad con los art. 883 y 884 C??d', 'Si', 'No', 'No', 749, 1),
(8, 3758, 30287, 12, 3014, '18762002539041 del 2017/03/15', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 5000', 'CM', '1.19', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ning??n tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el env??o el d??a pactado con el cliente lo cual el cliente puede verificar en la copia de la gu??a que se le har??a llegar para constancia de la fecha de env??o. Nuestras garant??as son por calidad de confecci??n y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los env??os causados adicionalmente * El cliente cuenta con 8 d??as para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devoluci??n de la prenda. Si en com??n acuerdo se pacta un posible ajuste este tendr?? un valor adicional y los costos de env??o corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garant??a por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el d??a Pactado y med??rsela para la verificaci??n de y aceptaci??n de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 d??as despu??s de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 3, '12646038', 'Valledupar (Cesar)', 'Alexander Baute Agamez', 'No somos Grandes contribuyentes - IVA R??gimen Com??n', 'Actividad Econ??mica Principal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000', 'Resoluci??n DIAN No.18762002539041 del 2017/03/15', 'Autoriza Impresi??n por Computador Del No. 0001 hasta el No. 5000', 'Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio seg??n art. 774 Cod. Comercio. Es exigible a su vencimiento y causa un inter??s de mora mensual liquidado a la tasa m??xima permitida de conformidad con los art. 883 y 884 C??d', 'Si', 'Si', 'No', 0, 0),
(9, 5017, 50198, 4, 5003, '0', '', '', '0.00', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ning??n tipo de responsabilidad con el cliente, siempre y cuando ALL???BAUTE haya  realizado el env??o el d??a pactado con el cliente lo cual el cliente puede verificar en la copia de la gu??a que se le har?? llegar para constancia de la fecha de env??o.??? Nuestras garant??as son por calidad de confecci??n y calidad de los materiales. ??? En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los env??os causados adicionalmente ???El cliente cuenta con 8 d??as para el cambio si este es justificado por alguna de las razones anteriores. ??? En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devoluci??n de la prenda. Si en com??n acuerdo se pacta un posible ajuste este tendr?? un valor adicional y los costos de env??o corren por cuenta del cliente. ???Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. ???No damos garant??a por mal uso o lavado inadecuado del producto.???Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el d??a Pactado y med??rsela para la verificaci??n de y aceptaci??n de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 d??as despu??s de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 5, '', '', '', '', '', '', '', '', '', 'No', '', 0, 0),
(10, 0, 0, 0, 6000, 'No aplica', '', '', '0.00', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ning??n tipo de responsabilidad con el cliente, siempre y cuando ALL???BAUTE haya  realizado el env??o el d??a pactado con el cliente lo cual el cliente puede verificar en la copia de la gu??a que se le har?? llegar para constancia de la fecha de env??o.??? Nuestras garant??as son por calidad de confecci??n y calidad de los materiales. ??? En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los env??os causados adicionalmente ???El cliente cuenta con 8 d??as para el cambio si este es justificado por alguna de las razones anteriores. ??? En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devoluci??n de la prenda. Si en com??n acuerdo se pacta un posible ajuste este tendr?? un valor adicional y los costos de env??o corren por cuenta del cliente. ???Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. ???No damos garant??a por mal uso o lavado inadecuado del producto.???Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el d??a Pactado y med??rsela para la verificaci??n de y aceptaci??n de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 d??as despu??s de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 7, '', '', '', '', '', '', '', '', 'Si', 'Si', 'No', 0, 0),
(11, 5, 2, 0, 8000, 'No aplica', '', '00', '0.00', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ningun tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el envio el dia pactado con el cliente lo cual el cliente puede verificar en la copia de la guia que se le haria llegar para constancia de la fecha de envio. Nuestras garantias son por calidad de confeccion y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los envios causados adicionalmente * El cliente cuenta con 8 dias para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devolucion de la prenda. Si en comun acuerdo se pacta un posible ajuste este tendra un valor adicional y los costos de envio corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garantia por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el dia Pactado y medirsela para la verificacion de y aceptacion de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 dias despues de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 8, '12646038', 'NEIVA', 'Alexander Baute Agamez', '', '', '', '', '', 'Si', 'No', 'No', 3, 0),
(12, 12461, 27779, 2272, 1008, '240000037455 del 2016/02/29', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 10000', '', '1.19', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ningun tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el envio el dia pactado con el cliente lo cual el cliente puede verificar en la copia de la guia que se le haria llegar para constancia de la fecha de envio. Nuestras garantias son por calidad de confeccion y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los envios causados adicionalmente * El cliente cuenta con 8 dias para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devolucion de la prenda. Si en comun acuerdo se pacta un posible ajuste este tendra un valor adicional y los costos de envio corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garantia por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el dia Pactado y medirsela para la verificacion de y aceptacion de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 dias despues de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 11, '12646038', 'Valledupar (Cesar)', 'Alexander Baute Agamez', 'No somos Grandes contribuyentes - IVA Regimen Comun', 'Actividad Economica Principal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000', 'Resolucion DIAN No.240000037455 del 2016/02/29', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 10000', 'Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio segun art. 774 Cod. Comercio. Es exigible a su vencimiento y causa un interes de mora mensual liquidado a la tasa maxima permitida de conformidad con los art. 883 y 884 Cod', 'Si', 'Si', 'No', 12461, 1683),
(13, 1, 1, 1, 1, '18762002539041 del 2017/03/15', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 5000', 'CM', '1.19', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ning??n tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el env??o el d??a pactado con el cliente lo cual el cliente puede verificar en la copia de la gu??a que se le har??a llegar para constancia de la fecha de env??o. Nuestras garant??as son por calidad de confecci??n y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los env??os causados adicionalmente * El cliente cuenta con 8 d??as para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devoluci??n de la prenda. Si en com??n acuerdo se pacta un posible ajuste este tendr?? un valor adicional y los costos de env??o corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garant??a por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el d??a Pactado y med??rsela para la verificaci??n de y aceptaci??n de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 d??as despu??s de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 12, '12646038', 'Valledupar (Cesar)', 'Alexander Baute Agamez', 'No somos Grandes contribuyentes - IVA R??gimen Com??n', 'Actividad Econ??mica Principal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000', 'Resoluci??n DIAN No.18762002539041 del 2017/03/15', 'Autoriza Impresi??n por Computador Del No. 0001 hasta el No. 5000', 'Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio seg??n art. 774 Cod. Comercio. Es exigible a su vencimiento y causa un inter??s de mora mensual liquidado a la tasa m??xima permitida de conformidad con los art. 883 y 884 C??d', 'Si', 'Si', 'No', 1, 1),
(14, 1, 1, 1, 1, '18762002539041 del 2017/03/15', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 5000', 'CM', '1.19', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ning??n tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el env??o el d??a pactado con el cliente lo cual el cliente puede verificar en la copia de la gu??a que se le har??a llegar para constancia de la fecha de env??o. Nuestras garant??as son por calidad de confecci??n y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los env??os causados adicionalmente * El cliente cuenta con 8 d??as para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devoluci??n de la prenda. Si en com??n acuerdo se pacta un posible ajuste este tendr?? un valor adicional y los costos de env??o corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garant??a por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el d??a Pactado y med??rsela para la verificaci??n de y aceptaci??n de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 d??as despu??s de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 13, '12646038', 'Valledupar (Cesar)', 'Alexander Baute Agamez', 'No somos Grandes contribuyentes - IVA R??gimen Com??n', 'Actividad Econ??mica Principal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000', 'Resoluci??n DIAN No.18762002539041 del 2017/03/15', 'Autoriza Impresi??n por Computador Del No. 0001 hasta el No. 5000', 'Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio seg??n art. 774 Cod. Comercio. Es exigible a su vencimiento y causa un inter??s de mora mensual liquidado a la tasa m??xima permitida de conformidad con los art. 883 y 884 C??d', 'Si', 'No', 'No', 1, 1),
(15, 1, 1, 3, 1, '18762002539041 del 2017/03/15', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 5000', 'CM', '1.19', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ning??n tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el env??o el d??a pactado con el cliente lo cual el cliente puede verificar en la copia de la gu??a que se le har??a llegar para constancia de la fecha de env??o. Nuestras garant??as son por calidad de confecci??n y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los env??os causados adicionalmente * El cliente cuenta con 8 d??as para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devoluci??n de la prenda. Si en com??n acuerdo se pacta un posible ajuste este tendr?? un valor adicional y los costos de env??o corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garant??a por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el d??a Pactado y med??rsela para la verificaci??n de y aceptaci??n de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 d??as despu??s de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 14, '12646038', 'Valledupar (Cesar)', 'Alexander Baute Agamez', 'No somos Grandes contribuyentes - IVA R??gimen Com??n', 'Actividad Econ??mica Principal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000', 'Resoluci??n DIAN No.18762002539041 del 2017/03/15', 'Autoriza Impresi??n por Computador Del No. 0001 hasta el No. 5000', 'Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio seg??n art. 774 Cod. Comercio. Es exigible a su vencimiento y causa un inter??s de mora mensual liquidado a la tasa m??xima permitida de conformidad con los art. 883 y 884 C??d', 'Si', 'Si', 'No', 1, 1),
(16, 0, 1, 0, 6000, 'No aplica', '', '', '0.00', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ning??n tipo de responsabilidad con el cliente, siempre y cuando ALL???BAUTE haya  realizado el env??o el d??a pactado con el cliente lo cual el cliente puede verificar en la copia de la gu??a que se le har?? llegar para constancia de la fecha de env??o.??? Nuestras garant??as son por calidad de confecci??n y calidad de los materiales. ??? En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los env??os causados adicionalmente ???El cliente cuenta con 8 d??as para el cambio si este es justificado por alguna de las razones anteriores. ??? En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devoluci??n de la prenda. Si en com??n acuerdo se pacta un posible ajuste este tendr?? un valor adicional y los costos de env??o corren por cuenta del cliente. ???Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. ???No damos garant??a por mal uso o lavado inadecuado del producto.???Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el d??a Pactado y med??rsela para la verificaci??n de y aceptaci??n de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 d??as despu??s de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 15, '', 'CUCUTA', '', '', '', '', '', '', 'Si', 'No', 'No', 0, 0),
(17, 395, 154, 2, 1, '18762002539041 del 2017/03/15', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 5000', 'CM', '1.19', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ning??n tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el env??o el d??a pactado con el cliente lo cual el cliente puede verificar en la copia de la gu??a que se le har??a llegar para constancia de la fecha de env??o. Nuestras garant??as son por calidad de confecci??n y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los env??os causados adicionalmente * El cliente cuenta con 8 d??as para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devoluci??n de la prenda. Si en com??n acuerdo se pacta un posible ajuste este tendr?? un valor adicional y los costos de env??o corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garant??a por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el d??a Pactado y med??rsela para la verificaci??n de y aceptaci??n de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 d??as despu??s de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 9, '12646038', 'Sincelejo', 'Alexander Baute Agamez', 'No somos Grandes contribuyentes - IVA R??gimen Com??n', 'Actividad Econ??mica Principal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000', 'Resoluci??n DIAN No.18762002539041 del 2017/03/15', 'Autoriza Impresi??n por Computador Del No. 0001 hasta el No. 5000', 'Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio seg??n art. 774 Cod. Comercio. Es exigible a su vencimiento y causa un inter??s de mora mensual liquidado a la tasa m??xima permitida de conformidad con los art. 883 y 884 C??d', 'Si', 'No', 'No', 395, 1),
(18, 1619, 1518, 60, 1, '18762002539041 del 2017/03/15', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 5000', '', '1.19', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ning??n tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el env??o el d??a pactado con el cliente lo cual el cliente puede verificar en la copia de la gu??a que se le har??a llegar para constancia de la fecha de env??o. Nuestras garant??as son por calidad de confecci??n y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los env??os causados adicionalmente * El cliente cuenta con 8 d??as para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devoluci??n de la prenda. Si en com??n acuerdo se pacta un posible ajuste este tendr?? un valor adicional y los costos de env??o corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garant??a por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el d??a Pactado y med??rsela para la verificaci??n de y aceptaci??n de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 d??as despu??s de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 17, '12646038', 'Valledupar', 'Alexander Baute Agamez', 'No somos Grandes contribuyentes - IVA R??gimen Com??n', 'Actividad Económica Principal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000', 'Resolucion DIAN No.18762002539041 del 2017/03/15', 'Autoriza Impresión por Computador Del No. 0001 hasta el No. 5000', 'Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio según art. 774 Cod. Comercio. Es exigible a su vencimiento y causa un interés de mora mensual liquidado a la tasa máxima permitida de conformidad con los art. 883 y 884 C??d', 'Si', 'Si', 'No', 1619, 1683),
(19, 1, 1, 379, 1, '240000037455 del 2016/02/29', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 10000', '', '1.19', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ningun tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el envio el dia pactado con el cliente lo cual el cliente puede verificar en la copia de la guia que se le haria llegar para constancia de la fecha de envio. Nuestras garantias son por calidad de confeccion y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los envios causados adicionalmente * El cliente cuenta con 8 dias para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devolucion de la prenda. Si en comun acuerdo se pacta un posible ajuste este tendra un valor adicional y los costos de envio corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garantia por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el dia Pactado y medirsela para la verificacion de y aceptacion de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 dias despues de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 10, '12646038', 'Valledupar (Cesar)', 'Alexander Baute Agamez', 'No somos Grandes contribuyentes - IVA Regimen Comun', 'Actividad Economica Princip enal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000', 'Resolucion DIAN No.240000037455 del 2016/02/29', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 10000', 'Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio segun art. 774 Cod. Comercio. Es exigible a su vencimiento y causa un interes de mora mensual liquidado a la tasa maxima permitida de conformidad con los art. 883 y 884 Cod', 'Si', 'Si', 'No', 1, 1),
(20, 25, 30290, 2269, 1, '18762002539041 del 2017/03/15', 'Autoriza Impresion por Computador Del No. 0001 hasta el No. 5000', '', '1.19', 'Los  posibles retrasos  en la entrega del pedido causados  por responsabilidad  de la empresa  transportadora , no nos compromete a asumir ning??n tipo de responsabilidad con el cliente, siempre y cuando ALL-BAUTE haya  realizado el env??o el d??a pactado con el cliente lo cual el cliente puede verificar en la copia de la gu??a que se le har??a llegar para constancia de la fecha de env??o. Nuestras garant??as son por calidad de confecci??n y calidad de los materiales.  En caso de que el cliente pida la prenda en una talla y esta no le quede, se hace cambio de talla siempre que la prenda recibida por el cliente no haya sido usada y el cliente corre con los gastos de los env??os causados adicionalmente * El cliente cuenta con 8 d??as para el cambio si este es justificado por alguna de las razones anteriores. * En caso de que el cliente haya enviado una muestra para las medidas nosotros realizamos la prenda con estas medidas, en caso de que no le quede la prenda estamos absueltos de toda responsabilidad para cambio o devoluci??n de la prenda. Si en com??n acuerdo se pacta un posible ajuste este tendr?? un valor adicional y los costos de env??o corren por cuenta del cliente. *Recomendamos leer las instrucciones de lavado impresas en la etiqueta interna de la prenda. *No damos garant??a por mal uso o lavado inadecuado del producto.*Si el cliente manda a hacer una prenda sobre medidas debe ir por ella el d??a Pactado y med??rsela para la verificaci??n de y aceptaci??n de la prenda , en caso de que el cliente no se mida la prenda en la tienda cuenta con 5 d??as despu??s de recibida para hacer cualquier ajuste, si se pasa de este tiempo, no nos hacemos responsables si la prenda no le queda bien, debido a que este puede tener un cambio de talla.', 18, '12646038', 'Montería', 'Alexander Baute Agamez', 'No somos Grandes contribuyentes - IVA R??gimen Com??n', 'Actividad Económica Principal 4771 Act. ICA - Principal 4771 tarifa ICA 10 * 1000', 'Resolucion DIAN No.18762002539041 del 2017/03/15', 'Autoriza Impresión por Computador Del No. 0001 hasta el No. 5000', 'Esta factura de venta se asimila en todos sus efectos a la Letra de Cambio según art. 774 Cod. Comercio. Es exigible a su vencimiento y causa un interés de mora mensual liquidado a la tasa máxima permitida de conformidad con los art. 883 y 884 C??d', 'Si', 'Si', 'No', 25, 1674);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_contacto_usuario`
--

CREATE TABLE `t_contacto_usuario` (
  `Id_Contacto` int(11) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `Tel` varchar(255) NOT NULL,
  `Fax` varchar(255) NOT NULL,
  `Cel` varchar(255) NOT NULL,
  `Cel2` varchar(255) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Usuario_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_detalle_despachos`
--

CREATE TABLE `t_detalle_despachos` (
  `Id_Detalle_Despacho` int(11) NOT NULL,
  `Despacho_Cod_Despacho` int(11) NOT NULL,
  `Fecha_Envia_Despacho` datetime NOT NULL,
  `Fecha_Recibe_Despacho` datetime NOT NULL,
  `Envia_Id_Usuario` int(11) NOT NULL,
  `Recibe_Id_Usuario` int(11) NOT NULL,
  `Url_Despacho` text NOT NULL,
  `Cant_Enviada` int(11) NOT NULL,
  `Solicitud_Produccion` int(11) NOT NULL,
  `Solicitud_Cliente` int(11) NOT NULL,
  `Estado_Detalle_Despacho` int(11) NOT NULL,
  `Transportadora` varchar(255) NOT NULL,
  `Num_Guia` varchar(255) NOT NULL,
  `Observa_Despacho` varchar(1024) NOT NULL,
  `Publica_Despacho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_devoluciones`
--

CREATE TABLE `t_devoluciones` (
  `id` int(11) NOT NULL,
  `Num_factura` int(11) NOT NULL,
  `Ref_Devolucion` varchar(255) NOT NULL,
  `Ref_Completa` varchar(255) NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `total_devolucion` int(11) NOT NULL,
  `fecha_devolucion` datetime NOT NULL,
  `Cambio_id_Usuario` int(11) NOT NULL,
  `Observa_Usuario` varchar(1024) NOT NULL,
  `Venta_Id_Venta` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `fecha_guardada` datetime NOT NULL,
  `notacredito_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_devoluciones_detalle`
--

CREATE TABLE `t_devoluciones_detalle` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `cant_dev` int(11) NOT NULL,
  `cod_ref` varchar(250) NOT NULL,
  `valor_ref` int(11) NOT NULL,
  `fecha_dev` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_devolucion_dinero`
--

CREATE TABLE `t_devolucion_dinero` (
  `id_devolucion_dinero` int(11) NOT NULL,
  `ingreso_id_ingreso` int(11) NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL,
  `fecha_devolucion` datetime NOT NULL,
  `motivo_devolucion` varchar(512) NOT NULL,
  `autoriza_id_usuario` int(11) NOT NULL,
  `devolucion_id_usuario` int(11) NOT NULL,
  `valor_devolucion` int(11) NOT NULL,
  `marca_temporal` datetime NOT NULL,
  `tienda_id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_devolucion_ordenes`
--

CREATE TABLE `t_devolucion_ordenes` (
  `Id_Devolucion_Orden` int(11) NOT NULL,
  `Pedido_Id_Pedido` int(11) NOT NULL,
  `Solicitud_Id_Solicitud` int(11) NOT NULL,
  `Motivo_Dev` varchar(2048) NOT NULL,
  `Fecha_Devolucion` datetime NOT NULL,
  `Reporte_Id_Usuario` int(11) NOT NULL,
  `Bodega_Id_Bodega` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_estado_llamadas`
--

CREATE TABLE `t_estado_llamadas` (
  `Id_Estado_Llamada` int(11) NOT NULL,
  `Nom_Estado_Llamada` varchar(255) NOT NULL,
  `Desc_Llamada` varchar(255) NOT NULL,
  `Publica_Estado_Llamada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_estado_llamadas`
--

INSERT INTO `t_estado_llamadas` (`Id_Estado_Llamada`, `Nom_Estado_Llamada`, `Desc_Llamada`, `Publica_Estado_Llamada`) VALUES
(1, 'Notificado a Tienda', 'Notificado a Tienda', 1),
(2, 'No Contesta', 'No Contesta', 1),
(3, 'Numero Errado', 'Numero Errado', 1),
(4, 'Numero Ocupado', 'Numero Ocupado', 1),
(5, 'Buzon de Voz', 'Buzon de Voz', 1),
(6, 'Telefono Apagado', 'Telefono Apagado', 1),
(7, 'Llamada Efectiva', 'Llamada Efectiva', 1),
(8, 'Llamar mas tarde', 'Llamar mas tarde', 1),
(9, 'Llamar Ma??ana', 'Llamar Ma??ana', 1),
(10, 'Llamar en una semana', 'Llamar en una semana', 1),
(11, 'Venta Realizada', 'Venta Realizada', 1),
(12, 'Cliente Contactado', 'Cliente Contactado', 1),
(13, 'Cliente no interesado', 'Cliente no interesado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_estado_pedidos`
--

CREATE TABLE `t_estado_pedidos` (
  `Id_Estado_Pedido` int(11) NOT NULL,
  `Nom_Estado_Pedido` varchar(255) NOT NULL,
  `Desc_Estado` varchar(1024) NOT NULL,
  `Color_Estado` varchar(255) NOT NULL,
  `Rol_Id_Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_estado_pedidos`
--

INSERT INTO `t_estado_pedidos` (`Id_Estado_Pedido`, `Nom_Estado_Pedido`, `Desc_Estado`, `Color_Estado`, `Rol_Id_Rol`) VALUES
(1, 'Solicitado a Taller', 'Estado inicial de la orden de corte', '#D15B47', 2),
(2, 'Insumo no disponible', 'No hay posibilidad de encontrar el insumo', '#D15B47', 2),
(3, 'Pen. compra Insumos', 'Solicitado al departamento de compras ', '#f39c12', 2),
(4, 'Insumo solicitado', 'Pendiente llegada de insumo por parte de proveedor', '#f39c12', 2),
(5, 'Sastre asignado', 'Se pasan los insumos al sastre para que  elabore la prenda', '#8C9DE8', 2),
(6, 'Acabados', 'Control de calidad de la prenda', '#00a65a', 2),
(7, 'Centro. Dis', 'Prendas listas para enviar a la tienda', '#00a65a', 2),
(8, 'En Transito', 'Prenda en tr??nsito a la tienda de destino ', '#00a65a', 0),
(9, 'Pedido Recibido', 'Llega a la tienda', '#00a65a', 0),
(10, 'Pedido Entregado', 'Entregado a Cliente', '#00a65a', 0),
(11, 'Solicitud de Traslado', 'Solicitud de traslado de una prenda a otra tienda con existencias', '', 0),
(12, 'Enviado a Taller Ppal', 'Pedido enviado de taller Maquila a taller Principal', '#f39c12', 2),
(13, 'Devoluci??n a Taller', 'La orden se devuelve a taller por imperfectos en la produccion', '#D15B47', 3),
(14, 'Orden no Entregada', 'El producto no cumpli?? con las expectativas del cliente y se deja en inventario terminado', '', 0),
(15, 'Pendiente Muestra', 'Pendiente muestra por parte de cliente', '#f39c12', 2),
(16, 'Corte Asignado', 'Se pasa a corte la prenda', '#f39c12', 2),
(17, 'Concluido Admin', 'Pedidos depurados en sistema', '#f39c12', 1),
(18, 'Prenda por estampar', 'La prenda se encuntra lista para estampar', '#0BC2AE', 2),
(19, 'Pendiente una prenda', 'Al conjunto le falta terminar una de las prendas', '#EC04BE', 2),
(20, 'En Bordado', 'La prenda se envia a Bordado', '#F2C4F8', 2),
(21, 'Pendiente Molderia', 'La prenda se encuentra pendiente por Molde', '#F9590E', 2),
(22, 'Enviado al SR Ernesto', 'Se envía tela o corte para confección al sr Ernesto.', '#FB775B', 2),
(23, 'En plancha', 'Prenda en planchado', '#FBA65B', 2),
(24, 'En Stock', 'Prenda lista Con stock', '#FA7C50', 2),
(25, 'Enviado a tienda', 'Prenda enviada a la tienda', '#8144FA', 2),
(26, 'Enviado a Alain', 'Prenda enviada a Alain para confección en Valledupar', '#56E4FD', 2),
(27, 'Enviado a Luz mila', 'Prenda enviada a Delma para confección en Valledupar', '#56E4FD', 2),
(28, 'Enviado a Nando', 'Se envían a Maquila para confección y entrega en Valledupar', '#A84BFB', 2),
(29, 'Enviado a maquila Maritza', 'Se envían a Maquila a Maritza', '#A84BFB', 2),
(30, 'Enviado a maquila Karen Tellez', 'Se envían a Maquila a Karen Tellez Maquila Dama', '#A84BFB', 2),
(31, 'Enviado a Johan', 'Se envían a Maquila a Johan', '#A84BFB', 2),
(32, 'Enviado a Jurgen', 'Se envían a Jurgen estampado', '#A84BFB', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_estado_usuario`
--

CREATE TABLE `t_estado_usuario` (
  `Id_Estado_Usuario` int(11) NOT NULL,
  `Descrip_Estado_Usuario` varchar(255) NOT NULL,
  `Nombre_Estado_Usuario` varchar(255) NOT NULL,
  `Estado_TekMaster_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_estado_usuario`
--

INSERT INTO `t_estado_usuario` (`Id_Estado_Usuario`, `Descrip_Estado_Usuario`, `Nombre_Estado_Usuario`, `Estado_TekMaster_Usuario`) VALUES
(1, 'Activo', 'Activo', 1),
(2, 'Inactivo', 'Inactivo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_facturas`
--

CREATE TABLE `t_facturas` (
  `Id_Factura` int(11) NOT NULL,
  `Fecha_Factura` datetime NOT NULL,
  `Num_Factura` int(11) NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Subtotal_Factura` int(11) NOT NULL,
  `Iva_Factura` int(11) NOT NULL,
  `Total_Factura` int(11) NOT NULL,
  `Estado_Factura` int(11) NOT NULL,
  `Factura_Paga` int(11) NOT NULL,
  `Marca_Temporal` datetime NOT NULL,
  `Usuario_Vendedor` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Observa_Factura` text NOT NULL,
  `Usuario_Anula` int(11) NOT NULL,
  `Fecha_Anula` datetime NOT NULL,
  `estado_sc` int(11) NOT NULL,
  `num_consecutivo_sc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_frecuencia_clientes`
--

CREATE TABLE `t_frecuencia_clientes` (
  `id_registro` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `usuario_id_usuario` int(11) NOT NULL,
  `tienda_id_tienda` int(11) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_gastos`
--

CREATE TABLE `t_gastos` (
  `Id_gasto` int(11) NOT NULL,
  `Fecha_gasto` datetime NOT NULL,
  `Beneficiario` varchar(250) NOT NULL,
  `Rubro_id_rubro` int(11) NOT NULL,
  `Sub_rubro` int(11) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `Url_soporte` varchar(500) NOT NULL,
  `Valor_gasto` bigint(20) NOT NULL,
  `Marca_temporal` datetime NOT NULL,
  `Usuario_id_usuario` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Tienda_Aplica` int(11) NOT NULL,
  `Area_Id_Area` int(11) NOT NULL,
  `tipo_gasto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ingresos`
--

CREATE TABLE `t_ingresos` (
  `Id_Ingreso` int(11) NOT NULL,
  `Cod_Recibo_Caja` int(11) NOT NULL,
  `Pedido_Id_Pedido` int(11) NOT NULL,
  `Factura_Cod_Factura` int(11) NOT NULL,
  `consecutivosc_id_consecutivosc` int(11) NOT NULL,
  `Separe_Cod_Separe` int(11) NOT NULL,
  `Cartera_Id_Cartera` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Ingreso_Id_Usuario` int(11) NOT NULL,
  `Medio_Pago` int(11) NOT NULL,
  `Num_Transaccion` varchar(255) NOT NULL,
  `Url_Ingreso` text NOT NULL,
  `Valor_Ingreso` int(11) NOT NULL,
  `valor_devuelto` int(11) NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Concepto_Ingreso` varchar(1024) NOT NULL,
  `Ingreso_Contabilizado` int(11) NOT NULL,
  `Estado_Ingreso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ingreso_dinero`
--

CREATE TABLE `t_ingreso_dinero` (
  `id_ingresodinero` int(11) NOT NULL,
  `Fecha_ingreso` datetime NOT NULL,
  `fuente` int(11) NOT NULL,
  `Descripcion` varchar(1024) NOT NULL,
  `Valor_ingresodinero` int(11) NOT NULL,
  `Marca_temporal` datetime NOT NULL,
  `Usuario_id_usuario` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Area_Id_Area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_insumos`
--

CREATE TABLE `t_insumos` (
  `Id_Insumo` int(11) NOT NULL,
  `Categoria_Id_Categoria_Insumo` int(11) NOT NULL,
  `SubCategoria_Id_SubCategoria_Insumo` int(11) NOT NULL,
  `Cod_Insumo` varchar(255) NOT NULL,
  `Cod_Proveedor` varchar(255) NOT NULL,
  `Nom_Insumo` varchar(255) NOT NULL,
  `Unidad_Insumo` varchar(255) NOT NULL,
  `Tipo_Insumo` varchar(255) NOT NULL,
  `Url_Insumo` varchar(255) NOT NULL,
  `Detalle_Insumo` text NOT NULL,
  `Color_Ppal` varchar(255) NOT NULL,
  `Proveedor_Id_Proveedor` int(11) NOT NULL,
  `Costo_Insumo` int(11) NOT NULL,
  `Concatenar_Bus` text NOT NULL,
  `ref_activa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_insumos_ref`
--

CREATE TABLE `t_insumos_ref` (
  `Id_Insumo_Ref` int(11) NOT NULL,
  `Cod_Insumo` varchar(255) NOT NULL,
  `Costo_Insumo_Ref` int(11) NOT NULL,
  `Cant_Solicitada` decimal(10,2) NOT NULL,
  `Referencia_Cod_Referencia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario`
--

CREATE TABLE `t_inventario` (
  `Id` int(11) NOT NULL,
  `Id_Tienda` int(11) NOT NULL,
  `Referencia` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Referencia_Completa` varchar(250) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Id_Talla` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventarionueva`
--

CREATE TABLE `t_inventarionueva` (
  `Id` int(11) NOT NULL,
  `Id_Tienda` int(11) NOT NULL,
  `Referencia` varchar(250) NOT NULL,
  `Referencia_Completa` varchar(250) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Id_Talla` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_bar`
--

CREATE TABLE `t_inventario_bar` (
  `Id` int(11) NOT NULL,
  `Id_Tienda` int(11) NOT NULL,
  `Referencia` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Referencia_Completa` varchar(250) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Id_Talla` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_mont`
--

CREATE TABLE `t_inventario_mont` (
  `Id` int(11) NOT NULL,
  `Id_Tienda` int(11) NOT NULL,
  `Referencia` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Referencia_Completa` varchar(250) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Id_Talla` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_nov`
--

CREATE TABLE `t_inventario_nov` (
  `Id` int(11) NOT NULL,
  `Id_Tienda` int(11) NOT NULL,
  `Referencia` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Referencia_Completa` varchar(250) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Id_Talla` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_ref`
--

CREATE TABLE `t_inventario_ref` (
  `Id_Registro_Inv` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Solicitud_Prod` int(11) NOT NULL,
  `Solicitud_Cl` int(11) NOT NULL,
  `Pedido_Translado` int(11) NOT NULL,
  `Inv_Ref` varchar(255) NOT NULL,
  `Talla_Id_Talla` int(11) NOT NULL,
  `Ref_Completa` varchar(255) NOT NULL,
  `Cantidad_Inv` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Fecha_Salida` datetime NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Tipo_Mov_Inv` varchar(255) NOT NULL,
  `N_Factura` varchar(255) NOT NULL,
  `N_Remision` int(11) NOT NULL,
  `Responsable_Id_Usuario` int(11) NOT NULL,
  `Fecha_Registro_Modasof` datetime NOT NULL,
  `cliente` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_ref_entradas_despachos`
--

CREATE TABLE `t_inventario_ref_entradas_despachos` (
  `Id_Registro_Inv` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Solicitud_Prod` int(11) NOT NULL,
  `Solicitud_Cl` int(11) NOT NULL,
  `Pedido_Translado` int(11) NOT NULL,
  `Inv_Ref` varchar(255) NOT NULL,
  `Talla_Id_Talla` int(11) NOT NULL,
  `Ref_Completa` varchar(255) NOT NULL,
  `Cantidad_Inv` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Fecha_Salida` datetime NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Tipo_Mov_Inv` varchar(255) NOT NULL,
  `N_Factura` varchar(255) NOT NULL,
  `N_Remision` int(11) NOT NULL,
  `Responsable_Id_Usuario` int(11) NOT NULL,
  `Fecha_Registro_Modasof` datetime NOT NULL,
  `cliente` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_ref_entradas_devoluciones`
--

CREATE TABLE `t_inventario_ref_entradas_devoluciones` (
  `Id_Registro_Inv` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Solicitud_Prod` int(11) NOT NULL,
  `Solicitud_Cl` int(11) NOT NULL,
  `Pedido_Translado` int(11) NOT NULL,
  `Inv_Ref` varchar(255) NOT NULL,
  `Talla_Id_Talla` int(11) NOT NULL,
  `Ref_Completa` varchar(255) NOT NULL,
  `Cantidad_Inv` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Fecha_Salida` datetime NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Tipo_Mov_Inv` varchar(255) NOT NULL,
  `N_Factura` varchar(255) NOT NULL,
  `N_Remision` int(11) NOT NULL,
  `Responsable_Id_Usuario` int(11) NOT NULL,
  `Fecha_Registro_Modasof` datetime NOT NULL,
  `cliente` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_ref_entradas_traslados`
--

CREATE TABLE `t_inventario_ref_entradas_traslados` (
  `Id_Registro_Inv` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Solicitud_Prod` int(11) NOT NULL,
  `Solicitud_Cl` int(11) NOT NULL,
  `Pedido_Translado` int(11) NOT NULL,
  `Inv_Ref` varchar(255) NOT NULL,
  `Talla_Id_Talla` int(11) NOT NULL,
  `Ref_Completa` varchar(255) NOT NULL,
  `Cantidad_Inv` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Fecha_Salida` datetime NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Tipo_Mov_Inv` varchar(255) NOT NULL,
  `N_Factura` varchar(255) NOT NULL,
  `N_Remision` int(11) NOT NULL,
  `Responsable_Id_Usuario` int(11) NOT NULL,
  `Fecha_Registro_Modasof` datetime NOT NULL,
  `cliente` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_ref_inicial`
--

CREATE TABLE `t_inventario_ref_inicial` (
  `Id_Registro_Inv` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Solicitud_Prod` int(11) NOT NULL,
  `Solicitud_Cl` int(11) NOT NULL,
  `Pedido_Translado` int(11) NOT NULL,
  `Inv_Ref` varchar(255) NOT NULL,
  `Talla_Id_Talla` int(11) NOT NULL,
  `Ref_Completa` varchar(255) NOT NULL,
  `Cantidad_Inv` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Fecha_Salida` datetime NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Tipo_Mov_Inv` varchar(255) NOT NULL,
  `N_Factura` varchar(255) NOT NULL,
  `N_Remision` int(11) NOT NULL,
  `Responsable_Id_Usuario` int(11) NOT NULL,
  `Fecha_Registro_Modasof` datetime NOT NULL,
  `cliente` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_ref_salidas_traslados`
--

CREATE TABLE `t_inventario_ref_salidas_traslados` (
  `Id_Registro_Inv` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Solicitud_Prod` int(11) NOT NULL,
  `Solicitud_Cl` int(11) NOT NULL,
  `Pedido_Translado` int(11) NOT NULL,
  `Inv_Ref` varchar(255) NOT NULL,
  `Talla_Id_Talla` int(11) NOT NULL,
  `Ref_Completa` varchar(255) NOT NULL,
  `Cantidad_Inv` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Fecha_Salida` datetime NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Tipo_Mov_Inv` varchar(255) NOT NULL,
  `N_Factura` varchar(255) NOT NULL,
  `N_Remision` int(11) NOT NULL,
  `Responsable_Id_Usuario` int(11) NOT NULL,
  `Fecha_Registro_Modasof` datetime NOT NULL,
  `cliente` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_ref_ventas`
--

CREATE TABLE `t_inventario_ref_ventas` (
  `Id_Registro_Inv` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Solicitud_Prod` int(11) NOT NULL,
  `Solicitud_Cl` int(11) NOT NULL,
  `Pedido_Translado` int(11) NOT NULL,
  `Inv_Ref` varchar(255) NOT NULL,
  `Talla_Id_Talla` int(11) NOT NULL,
  `Ref_Completa` varchar(255) NOT NULL,
  `Cantidad_Inv` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Fecha_Salida` datetime NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Tipo_Mov_Inv` varchar(255) NOT NULL,
  `N_Factura` varchar(255) NOT NULL,
  `N_Remision` int(11) NOT NULL,
  `Responsable_Id_Usuario` int(11) NOT NULL,
  `Fecha_Registro_Modasof` datetime NOT NULL,
  `cliente` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_segura`
--

CREATE TABLE `t_inventario_segura` (
  `Id` int(11) NOT NULL,
  `Id_Tienda` int(11) NOT NULL,
  `Referencia` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Referencia_Completa` varchar(250) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Id_Talla` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_separe`
--

CREATE TABLE `t_inventario_separe` (
  `Id_Registro_Inv` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Solicitud_Prod` int(11) NOT NULL,
  `Solicitud_Cl` int(11) NOT NULL,
  `Pedido_Translado` int(11) NOT NULL,
  `Inv_Ref` varchar(255) NOT NULL,
  `Talla_Id_Talla` int(11) NOT NULL,
  `Ref_Completa` varchar(255) NOT NULL,
  `Cantidad_Inv` int(11) NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Fecha_Salida` datetime NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Tipo_Mov_Inv` varchar(255) NOT NULL,
  `N_Factura` varchar(255) NOT NULL,
  `N_Remision` int(11) NOT NULL,
  `Responsable_Id_Usuario` int(11) NOT NULL,
  `Fecha_Registro_Modasof` datetime NOT NULL,
  `cliente` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_telas`
--

CREATE TABLE `t_inventario_telas` (
  `Id_inventario_tela` int(11) NOT NULL,
  `taller_id_taller` int(11) NOT NULL,
  `Insumo_Id_Insumo` int(11) NOT NULL,
  `Cod_Insumo_Cod` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Cantidad_Inv` decimal(10,2) NOT NULL,
  `Medida_Inv` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Responsable_Id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_telas_res`
--

CREATE TABLE `t_inventario_telas_res` (
  `Id_inventario_tela` int(11) NOT NULL,
  `taller_id_taller` int(11) NOT NULL,
  `Insumo_Id_Insumo` int(11) NOT NULL,
  `Cod_Insumo_Cod` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Cantidad_Inv` decimal(10,2) NOT NULL,
  `Medida_Inv` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Fecha_Ingreso` datetime NOT NULL,
  `Responsable_Id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_llamadas`
--

CREATE TABLE `t_llamadas` (
  `Id_Llamada` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Canal_Lead` varchar(255) NOT NULL,
  `Nombre_Lead` varchar(255) NOT NULL,
  `Celular_Lead` varchar(255) NOT NULL,
  `Fecha_Notificacion` datetime NOT NULL,
  `Observacion_Admin` text NOT NULL,
  `Estado_Llamada` int(11) NOT NULL,
  `Llamada_Pendiente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_medios_pago`
--

CREATE TABLE `t_medios_pago` (
  `Id_Medio_Pago` int(11) NOT NULL,
  `Nom_MedioPago` varchar(255) NOT NULL,
  `Estado_MedioPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_mov_cuentas`
--

CREATE TABLE `t_mov_cuentas` (
  `Id_Mov_Cuenta` int(11) NOT NULL,
  `Id_Cuenta_Sale` int(11) NOT NULL,
  `Id_Cuenta_Entra` int(11) NOT NULL,
  `Valor_Transferido` int(11) NOT NULL,
  `Fecha_Transf` datetime NOT NULL,
  `Url_Soporte_Trans` text NOT NULL,
  `Detalle` varchar(1024) NOT NULL,
  `Por_Medio_de` int(11) NOT NULL,
  `Marca_Temporal` datetime NOT NULL,
  `Egreso_Id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_mov_insumos`
--

CREATE TABLE `t_mov_insumos` (
  `Id_Mov_Insumos` int(11) NOT NULL,
  `Insumo_Cod_Insumo` varchar(255) NOT NULL,
  `Bodega_Id_Bodega_Recibe` int(11) NOT NULL,
  `Bodega_Id_Bodega_Retira` int(11) NOT NULL,
  `Cant_Mov` float NOT NULL,
  `Tipo_Mov_Insumo` varchar(255) NOT NULL,
  `Cod_Orden_Transf` int(11) NOT NULL,
  `OrdenCompra` int(11) NOT NULL,
  `Solicitud_Id_Solicitud` int(11) NOT NULL,
  `Usuario_Id_Usuario` int(11) NOT NULL,
  `Fecha_Solicitud` datetime NOT NULL,
  `Fecha_Realizado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_notificaciones`
--

CREATE TABLE `t_notificaciones` (
  `Id_Notifica` int(11) NOT NULL,
  `Not_Cod_Tarea` int(11) NOT NULL,
  `Usuario_Envia` int(11) NOT NULL,
  `Usuario_Recibe` int(11) NOT NULL,
  `Datos_Notifica` varchar(1000) NOT NULL,
  `Fecha_Notifica` datetime NOT NULL,
  `Estado_Notifica` int(11) NOT NULL,
  `Publicado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_notificaciones_push`
--

CREATE TABLE `t_notificaciones_push` (
  `Id_Not_Push` int(11) NOT NULL,
  `Usuario_Id_Usuario_Envia` int(11) NOT NULL,
  `Usuario_Id_Usuario_Recibe` int(11) NOT NULL,
  `Mensaje_Push` varchar(512) NOT NULL,
  `Fecha_Mensaje_Push` datetime NOT NULL,
  `Estado_Mensaje_Push` int(11) NOT NULL,
  `Leido_Mensaje_Push` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_orden_compra_insumos`
--

CREATE TABLE `t_orden_compra_insumos` (
  `Id_Orden_Compra` int(11) NOT NULL,
  `Forma_Pago` int(11) NOT NULL,
  `Estado_Pago` int(11) NOT NULL,
  `Cod_Orden_Prov` varchar(255) NOT NULL,
  `Cod_Orden_Modasof` varchar(255) NOT NULL,
  `Proveedor_Id_Proveedor` int(11) NOT NULL,
  `Fecha_Solicitud` datetime NOT NULL,
  `Marca_Temporal` datetime NOT NULL,
  `Usuario_Responsable` int(11) NOT NULL,
  `Bodega_Id_Bodega` int(11) NOT NULL,
  `Insumo_Cod_Insumo` int(11) NOT NULL,
  `Lote_Insumo` int(11) NOT NULL,
  `Cantidad_Solicitada` decimal(10,2) NOT NULL,
  `Costo_Insumo` int(11) NOT NULL,
  `Valor_Subtotal` int(11) NOT NULL,
  `Fecha_Est_Llegada` datetime NOT NULL,
  `Estado_Insumo` int(11) NOT NULL,
  `Fecha_Recibido` datetime NOT NULL,
  `Observa_Compra` text NOT NULL,
  `Soporte_Compra` varchar(1000) NOT NULL,
  `Observa_Soporte` text NOT NULL,
  `Cant_Recibida` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_pedido`
--

CREATE TABLE `t_pedido` (
  `Id_Pedido` int(11) NOT NULL,
  `Cod_Pedido` int(11) NOT NULL,
  `Pedido_Traslado_Numero` int(11) NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Fecha_Pedido` datetime NOT NULL,
  `Total_Pedido` int(11) NOT NULL,
  `Descuento` int(11) NOT NULL,
  `Estado_Pedido` int(11) NOT NULL,
  `Saldo_Abonado` int(11) NOT NULL,
  `Pedido_Id_Usuario` int(11) NOT NULL,
  `Fecha_Entrega` datetime NOT NULL,
  `Fecha_EntregaCliente` datetime NOT NULL,
  `Factura_Num_Factura` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `taller_id_taller` int(11) NOT NULL,
  `consecutivosc_id_consecutivosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_plansepare`
--

CREATE TABLE `t_plansepare` (
  `Id_Venta` int(11) NOT NULL,
  `Cant_Solicitada` int(11) NOT NULL,
  `Talla_Solicitada` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Referencia_Id_Referencia` varchar(255) NOT NULL,
  `Ref_Vendida` varchar(255) NOT NULL,
  `Fecha_Solicitud` datetime NOT NULL,
  `Vendedor_Id_Usuario` int(11) NOT NULL,
  `Valor_Prenda` int(11) NOT NULL,
  `Valor_Final` int(11) NOT NULL,
  `Observa_Cliente` text NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Factura_Id_Factura` int(11) NOT NULL,
  `Valida_Estado_Sol` int(11) NOT NULL,
  `Estado_Venta` int(11) NOT NULL,
  `Recibido_Despacho` int(11) NOT NULL,
  `Entregado_Despacho` int(11) NOT NULL,
  `Estado_Anulado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_proveedores`
--

CREATE TABLE `t_proveedores` (
  `Id_Proveedor` int(11) NOT NULL,
  `Nom_Prov` varchar(255) NOT NULL,
  `Nit_Prov` varchar(255) NOT NULL,
  `Dir_Prov` varchar(255) NOT NULL,
  `Local_Prov` varchar(255) NOT NULL,
  `Tel_Prov` varchar(255) NOT NULL,
  `Cel1_Prov` varchar(255) NOT NULL,
  `Whp_Prov` varchar(255) NOT NULL,
  `Email_Prov` varchar(255) NOT NULL,
  `Contacto_Prov` varchar(255) NOT NULL,
  `Ciudad_Id_Ciudad` varchar(255) NOT NULL,
  `Tipo_Insumo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_referencias`
--

CREATE TABLE `t_referencias` (
  `Id_Referencia` int(11) NOT NULL,
  `Cod_Referencia` varchar(255) NOT NULL,
  `Img_Referencia` text NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Coleccion_Id_Coleccion` int(11) NOT NULL,
  `Coleccion_Nom_Coleccion` varchar(255) NOT NULL,
  `Categoria_Id_Categoria_Prod` int(11) NOT NULL,
  `SubCategoria_Id_Subcategoria_Prod` int(11) NOT NULL,
  `Insumo_Ppal` varchar(255) NOT NULL,
  `Tipo_Tela` varchar(255) NOT NULL,
  `Color_Insumo_Ppal` int(11) NOT NULL,
  `Insumo_Sec` varchar(255) NOT NULL,
  `Estado_Ref` varchar(255) NOT NULL,
  `Costo_Proyectado_Pref` int(11) NOT NULL,
  `V_Mano_Obra_Ref` int(11) NOT NULL,
  `PVP_Ref` int(11) NOT NULL,
  `P_Mayor` int(11) NOT NULL,
  `Detalle_Referencia` varchar(3000) NOT NULL,
  `Ref_Publicada` int(11) NOT NULL,
  `Tipo_Referencia` int(11) NOT NULL,
  `Ref_Antigua` varchar(255) NOT NULL,
  `Detalle_Antiguo` text NOT NULL,
  `Creado_Por` int(11) NOT NULL,
  `Modificado_Por` int(11) NOT NULL,
  `ref_activa` int(11) NOT NULL,
  `Ref_generica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_registro_caja`
--

CREATE TABLE `t_registro_caja` (
  `Id_Registro_Caja` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) DEFAULT NULL,
  `Usuario_Id_Usuario` int(11) DEFAULT NULL,
  `Valor_Caja` int(11) DEFAULT NULL,
  `Valor_Confirmado` int(11) DEFAULT NULL,
  `Fecha_Registro` datetime DEFAULT NULL,
  `Dia_Registro` date DEFAULT NULL,
  `Tipo_Registro` int(11) DEFAULT NULL,
  `Reporte_Usuario` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_remisiones`
--

CREATE TABLE `t_remisiones` (
  `Id_Remision` int(11) NOT NULL,
  `Fecha_Remision` datetime NOT NULL,
  `Num_Remision` int(11) NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Subtotal_Remision` int(11) NOT NULL,
  `Iva_Remision` int(11) NOT NULL,
  `Total_Remision` int(11) NOT NULL,
  `Estado_Remision` int(11) NOT NULL,
  `Marca_Temporal` datetime NOT NULL,
  `Usuario_Vendedor` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Observa_Remision` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_rol_usuario`
--

CREATE TABLE `t_rol_usuario` (
  `Id_Rol` int(11) NOT NULL,
  `Descrip_Rol` varchar(255) NOT NULL,
  `Nombre_Rol` varchar(255) NOT NULL,
  `Estado_TekMaster_Rol` int(11) NOT NULL,
  `Actualizar_TekMaster` int(11) NOT NULL,
  `Editar_TekMaster` int(11) NOT NULL,
  `Eliminar_TekMaster` int(11) NOT NULL,
  `Insertar_TekMaster` int(11) NOT NULL,
  `Ver_TekMaster` int(11) NOT NULL,
  `Menu_Produccion` int(11) NOT NULL,
  `Menu_Clientes` int(11) NOT NULL,
  `Menu_Proveedores` int(11) NOT NULL,
  `Menu_Insumos` int(11) NOT NULL,
  `Menu_Compras` int(11) NOT NULL,
  `Menu_Sastres` int(11) NOT NULL,
  `Menu_Prod_Config` int(11) NOT NULL,
  `Menu_Prod_Colecciones` int(11) NOT NULL,
  `Menu_Prod_Crear` int(11) NOT NULL,
  `Menu_Galeria` int(11) NOT NULL,
  `Menu_CentroDist` int(11) NOT NULL,
  `Menu_Remisiones` int(11) NOT NULL,
  `Menu_Tiendas` int(11) NOT NULL,
  `Menu_Bodegas` int(11) NOT NULL,
  `Per_Config_Hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_rol_usuario`
--

INSERT INTO `t_rol_usuario` (`Id_Rol`, `Descrip_Rol`, `Nombre_Rol`, `Estado_TekMaster_Rol`, `Actualizar_TekMaster`, `Editar_TekMaster`, `Eliminar_TekMaster`, `Insertar_TekMaster`, `Ver_TekMaster`, `Menu_Produccion`, `Menu_Clientes`, `Menu_Proveedores`, `Menu_Insumos`, `Menu_Compras`, `Menu_Sastres`, `Menu_Prod_Config`, `Menu_Prod_Colecciones`, `Menu_Prod_Crear`, `Menu_Galeria`, `Menu_CentroDist`, `Menu_Remisiones`, `Menu_Tiendas`, `Menu_Bodegas`, `Per_Config_Hotel`) VALUES
(1, 'SUPER-ADMIN', 'SUPER-ADMIN', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'Jefe de Bodega', 'JEFE DE BODEGA', 1, 1, 0, 0, 0, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 0, 1, 0, 0, 0, 1),
(3, 'Administrador de Tienda ', 'ADMINISTRADOR', 1, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0),
(4, 'Operativo', 'SASTRE', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'COMPRAS', 'JEFE DE COMPRAS', 1, 1, 0, 0, 0, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'Visualizador de Ref', 'WebSite', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'Timeline Ordenes', 'Ordenes', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_rubros`
--

CREATE TABLE `t_rubros` (
  `Id_rubro` int(11) NOT NULL,
  `Cod_Rubro` int(11) NOT NULL,
  `Nom_rubro` varchar(250) NOT NULL,
  `Rubro_publicado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_rubros`
--

INSERT INTO `t_rubros` (`Id_rubro`, `Cod_Rubro`, `Nom_rubro`, `Rubro_publicado`) VALUES
(1, 51, 'OPERACIONALES DE VENTA', 1),
(2, 52, 'GASTOS ADMINISTRATIVOS', 1),
(3, 53, 'NO OPERACIONALES', 1),
(4, 54, 'BANCOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_salidas_cc`
--

CREATE TABLE `t_salidas_cc` (
  `Id_Venta` int(11) NOT NULL,
  `Cant_Solicitada` int(11) NOT NULL,
  `Talla_Solicitada` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Referencia_Id_Referencia` varchar(255) NOT NULL,
  `Ref_Vendida` varchar(255) NOT NULL,
  `Fecha_Solicitud` datetime NOT NULL,
  `Vendedor_Id_Usuario` int(11) NOT NULL,
  `Valor_Prenda` int(11) NOT NULL,
  `Valor_Final` int(11) NOT NULL,
  `Observa_Cliente` text NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Factura_Id_Factura` int(11) NOT NULL,
  `Valida_Estado_Sol` int(11) NOT NULL,
  `Estado_Venta` int(11) NOT NULL,
  `Recibido_Despacho` int(11) NOT NULL,
  `Entregado_Despacho` int(11) NOT NULL,
  `proveedor_id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_salidas_genericas`
--

CREATE TABLE `t_salidas_genericas` (
  `id_salida_generica` int(11) NOT NULL,
  `fecha_salida` date NOT NULL,
  `taller_id` int(11) NOT NULL,
  `ref_id` varchar(50) NOT NULL,
  `talla_id` int(11) NOT NULL,
  `nom_talla` varchar(25) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `pedido_numero` varchar(50) NOT NULL,
  `creado_por` int(11) NOT NULL,
  `marca_temporal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_salidas_remisiones`
--

CREATE TABLE `t_salidas_remisiones` (
  `Id_Venta` int(11) NOT NULL,
  `Cant_Solicitada` int(11) NOT NULL,
  `Talla_Solicitada` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Referencia_Id_Referencia` varchar(255) NOT NULL,
  `Ref_Vendida` varchar(255) NOT NULL,
  `Fecha_Solicitud` datetime NOT NULL,
  `Vendedor_Id_Usuario` int(11) NOT NULL,
  `Valor_Prenda` int(11) NOT NULL,
  `Valor_Final` int(11) NOT NULL,
  `Observa_Cliente` text NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Factura_Id_Factura` int(11) NOT NULL,
  `Valida_Estado_Sol` int(11) NOT NULL,
  `Estado_Venta` int(11) NOT NULL,
  `Recibido_Despacho` int(11) NOT NULL,
  `Entregado_Despacho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_seguimiento_llamadas`
--

CREATE TABLE `t_seguimiento_llamadas` (
  `Id_Seg_Llamada` int(11) NOT NULL,
  `Llamada_Id_llamada` int(11) NOT NULL,
  `Vendedor_Id_Usuario` int(11) NOT NULL,
  `Comentario_Llamada` text NOT NULL,
  `Fecha_Comentario` datetime NOT NULL,
  `Estado_Seg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_separados`
--

CREATE TABLE `t_separados` (
  `Id_Separe` int(11) NOT NULL,
  `Fecha_Separe` datetime NOT NULL,
  `Num_Separe` int(11) NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Subtotal_Separe` int(11) NOT NULL,
  `Iva_Separe` int(11) NOT NULL,
  `Total_Separe` int(11) NOT NULL,
  `Estado_Separe` int(11) NOT NULL,
  `Separe_Paga` int(11) NOT NULL,
  `Marca_Temporal` datetime NOT NULL,
  `Usuario_Vendedor` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Observa_Separe` text NOT NULL,
  `Usuario_Anula` int(11) NOT NULL,
  `Fecha_Anula` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_solicitudes_prod`
--

CREATE TABLE `t_solicitudes_prod` (
  `Id_Solicitud_Prod` int(11) NOT NULL,
  `Cod_Solicitud_Prod` int(11) NOT NULL,
  `Bodega_Id_Bodega` int(11) NOT NULL,
  `Cant_Solicitada` int(11) NOT NULL,
  `Color_Solicitado` int(11) NOT NULL,
  `Talla_Solicitada` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Referencia_Id_Referencia` varchar(255) NOT NULL,
  `Estado_Solicitud_Prod` int(11) NOT NULL,
  `Fecha_Solicitud` datetime NOT NULL,
  `Sastre_Id_Usuario` int(11) NOT NULL,
  `Pedido_Id_Pedido` int(11) NOT NULL,
  `Solicitud_Id_Usuario` int(11) NOT NULL,
  `Existencias_Ref` int(11) NOT NULL,
  `despachado` varchar(20) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_subcategorias_insumos`
--

CREATE TABLE `t_subcategorias_insumos` (
  `Id_SubCategoria_Insumo` int(11) NOT NULL,
  `Categoria_Id_Categoria_Insumo` int(11) NOT NULL,
  `Nom_SubCategoriaIns` varchar(255) NOT NULL,
  `Subcategoria_Insumo_Publicada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_subcategorias_insumos`
--

INSERT INTO `t_subcategorias_insumos` (`Id_SubCategoria_Insumo`, `Categoria_Id_Categoria_Insumo`, `Nom_SubCategoriaIns`, `Subcategoria_Insumo_Publicada`) VALUES
(1, 1, 'LINO', 1),
(2, 1, 'ALGODON', 1),
(3, 1, 'SEDA', 1),
(4, 5, 'CUERO', 1),
(5, 1, 'ALGODON PIMA', 1),
(6, 1, 'OXFORD', 1),
(7, 1, 'DRILL', 1),
(8, 1, 'JEAN', 1),
(9, 3, 'NACAR', 1),
(10, 6, 'MANILLA', 1),
(11, 3, 'PLASTICO', 1),
(12, 4, 'MARQUILLA', 1),
(13, 3, 'SHAROSKY', 1),
(14, 2, 'POLIESTER', 1),
(16, 7, 'CUERO', 1),
(17, 8, 'POLIESTER', 1),
(18, 1, 'PYQUE LYCRADO', 1),
(19, 1, 'DURAZNO', 1),
(20, 9, 'CUERO', 1),
(21, 1, 'RAYON', 1),
(22, 1, 'CHAMBRAY', 1),
(23, 1, 'PANO ', 1),
(24, 1, 'PANO ESTAMPADO', 1),
(25, 1, 'BENGALINA', 1),
(26, 1, 'ANTIFLUIDO', 1),
(28, 1, 'FRANELA', 1),
(29, 1, 'PODESUA SEDA', 1),
(30, 1, 'TERCIOPELO', 1),
(31, 1, 'MALLA', 1),
(32, 1, 'TAFETA', 1),
(33, 1, 'LYCRA', 1),
(34, 1, 'BLONDA ', 1),
(35, 1, 'GABARDINA', 1),
(36, 1, 'CRINOLINA', 1),
(37, 1, 'ESPITA', 1),
(38, 10, 'FIELTRO', 1),
(39, 10, 'PIEL DE CAMELLO', 1),
(40, 1, 'PANA', 1),
(41, 5, 'TENNIS', 1),
(42, 5, 'GAMUZA', 1),
(43, 11, 'ALGODON Modasof', 1),
(44, 1, 'RIP', 1),
(47, 5, 'ALPARGATA', 1),
(48, 5, 'CHAROL', 1),
(49, 14, 'CUERO', 1),
(50, 1, 'DACRON', 1),
(51, 15, 'GARRA', 1),
(53, 1, 'SIDO', 1),
(54, 1, 'SEDA FORRO VESTIDOS', 1),
(55, 17, 'ALGODON', 1),
(56, 7, 'CHAROL', 1),
(57, 7, 'GAMUZA', 1),
(58, 18, 'CORBATA', 1),
(59, 19, 'CORBATIN', 1),
(60, 15, 'JEANS', 1),
(61, 20, 'BERMUDA DE BA??O', 1),
(62, 20, 'BERMUDA', 1),
(63, 21, 'PAQUETE', 1),
(64, 1, 'ALGODON BORDADO Modasof', 1),
(65, 22, 'ALGODON', 1),
(66, 23, 'DRIL', 1),
(67, 24, 'CUERO', 1),
(68, 1, 'GAMUZA', 1),
(69, 25, 'GANCHO PANTALON', 1),
(70, 1, 'CHANTU', 1),
(71, 25, 'CUELLOS Y PUNOS', 1),
(72, 10, 'ENTRETELA', 1),
(73, 1, 'ENTRETELA', 1),
(74, 1, 'BUCLE', 1),
(75, 1, 'YAKAR', 1),
(76, 1, 'BURDA', 1),
(77, 1, 'PUNTA ROMA', 1),
(78, 1, 'NOCHE DE VIENA', 1),
(79, 26, 'MANCORNA', 1),
(80, 4, 'SENCAMER', 1),
(81, 6, 'HERRAJE CINTURONES', 1),
(82, 27, 'BORDADO', 1),
(83, 1, 'CREPE ', 1),
(84, 1, 'SEDA', 1),
(85, 1, 'SEDA', 1),
(86, 1, 'ALGODON BORDADO', 1),
(87, 28, 'BORDADO', 1),
(88, 25, 'APLIQUES', 1),
(89, 25, 'APLIQUES', 1),
(90, 25, 'APLIQUES', 1),
(91, 29, 'ELASTICO', 1),
(92, 25, 'CLIP', 1),
(93, 30, 'ALGODON Modasof', 1),
(94, 1, 'cambrela', 1),
(95, 8, 'slaider', 1),
(96, 8, 'slaider', 1),
(97, 25, 'CAJA ALFILERES', 1),
(98, 25, 'PULIDOR', 1),
(99, 25, 'COLA DE RATON', 1),
(100, 25, 'HILADILLA', 1),
(101, 25, 'AGUJAS RESPUESTO MAQUINA', 1),
(102, 25, 'AGUJAS RESPUESTO MAQUINA', 1),
(103, 25, 'metro', 1),
(104, 25, 'ABREOJAL', 1),
(105, 1, 'INTERLON', 1),
(106, 25, 'PEGANTE DE BOTA', 1),
(107, 1, 'FRANCHESCA', 1),
(108, 1, 'KARLA', 1),
(109, 1, 'KARLA', 1),
(110, 5, 'Nobu', 1),
(111, 5, 'Sint?tico', 1),
(112, 5, 'Trento', 1),
(113, 5, 'Yute', 1),
(114, 1, 'BARBIE', 1),
(115, 1, 'TULL', 1),
(116, 1, 'ORGANZA', 1),
(117, 32, 'BOLSA', 1),
(118, 25, 'Transporte', 1),
(119, 1, 'MICROFIBRA', 1),
(120, 1, 'OJALILLO', 1),
(121, 1, 'LYCRA-DEPORTIVA', 1),
(122, 25, 'SESGO', 1),
(123, 25, 'Elastico', 1),
(124, 25, 'MAYA', 1),
(125, 1, 'URBANO', 1),
(126, 1, 'BOSSE', 1),
(127, 1, 'NILO EGYPCIA', 1),
(129, 25, 'ENCAJE', 1),
(130, 1, 'ROJO FUEGO', 1),
(131, 1, 'kiana', 1),
(132, 8, 'NIQUE FIJA', 1),
(133, 8, 'NIQUE FIJA 4.5 10CM', 1),
(134, 8, 'NIQUE FIJA 4.5 20CM', 1),
(135, 34, 'TOP MANGA SIZAS', 1),
(136, 34, 'STRAPLE ', 1),
(137, 34, 'TIRAS', 1),
(138, 36, 'ALGODON', 1),
(139, 37, 'VERDE MILITAR', 1),
(140, 37, 'BLANCO', 1),
(141, 37, 'NEGRO', 1),
(142, 38, 'CAJA', 1),
(143, 39, 'ESTAMPADA', 1),
(144, 40, 'TARJETA', 1),
(145, 1, 'Lentejuela', 1),
(146, 1, 'CHIFON', 1),
(147, 1, 'CUERO', 1),
(148, 1, 'CUERINA', 1),
(149, 1, 'LAME DE SEDA', 1),
(150, 42, 'swarovski', 1),
(151, 1, 'SEDA LORENZA', 1),
(152, 1, 'GUIPUR', 1),
(153, 1, 'BROCADO ', 1),
(154, 1, 'GASAR', 1),
(155, 1, 'PLUMAS', 1),
(156, 1, 'ESCARCHA', 1),
(157, 1, 'GEORGETTE', 1),
(158, 43, 'TEJIDO HILO', 1),
(159, 1, 'GORGONA (UNIFORMES)', 1),
(160, 1, 'LINO CAMISERO', 1),
(161, 1, 'LINO PANTALONERO', 1),
(162, 1, 'DEGRADADO', 1),
(163, 1, 'TERRACOTA', 1),
(164, 44, 'PLASTICA', 1),
(165, 45, 'PAPEL', 1),
(166, 46, 'PLASTICO', 1),
(167, 47, 'PLASTICO', 1),
(168, 1, 'STEPWAY', 1),
(169, 1, 'BELINO', 1),
(170, 1, 'SAFARI', 1),
(171, 48, 'PIEDRAS DECORATIVAS', 1),
(172, 25, 'AJUSTE PRENDAS', 1),
(173, 49, 'SOMBRERO', 1),
(174, 50, 'PONCHO', 1),
(175, 49, 'MEDIAS', 1),
(176, 51, 'NILO O BURDA', 1),
(177, 52, 'NILO O BURDA', 1),
(178, 53, 'NILO O BURDA', 1),
(179, 54, 'FIBRA SINTETICA', 1),
(180, 55, 'TODAS LAS TALLAS', 1),
(182, 55, 'TALLA XS', 1),
(185, 57, 'LAVADO Y PLANCHADO', 1),
(186, 57, 'PRECIO', 1),
(187, 58, 'SINTETICO', 1),
(188, 59, 'BOLSA PLASTICA, CARTON, CLIP(3), CUELLO, MARIPOSA, ETIQUETA NEGRA Modasof', 1),
(189, 60, 'BOLSA TRANSPARENTE,ETIQUETA NEGRA Modasof', 1),
(190, 61, 'POLIESTER CRUDO PUNTERA MARCADA ModasofAUTE A TONO', 1),
(191, 61, 'POLIESTER NEGRO PUNTERA MARCADA ModasofAUTE A TONO', 1),
(192, 1, 'LINO ESTAMPADO', 1),
(193, 62, 'CUERO ', 1),
(194, 6, 'HERRAJE ZAPATO', 1),
(195, 3, 'ACERO INOXIDABLE /ALUMINIO', 1),
(196, 48, 'CAUCHO Modasof /FIRMA/ModasofAUTE', 1),
(197, 63, 'URBANO ', 1),
(198, 53, 'CREPE', 1),
(199, 17, 'PYQUE', 1),
(200, 65, 'LINO ', 1),
(201, 65, 'LINO ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_subcategoria_producto`
--

CREATE TABLE `t_subcategoria_producto` (
  `Id_SubCat_Producto` int(11) NOT NULL,
  `Cod_SubCat_Producto` varchar(255) NOT NULL,
  `Nom_SubCat_Producto` varchar(512) NOT NULL,
  `SubCat_Producto_Publicada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_subcategoria_producto`
--

INSERT INTO `t_subcategoria_producto` (`Id_SubCat_Producto`, `Cod_SubCat_Producto`, `Nom_SubCat_Producto`, `SubCat_Producto_Publicada`) VALUES
(1, 'HO', 'HOMBRE', 1),
(2, 'MU', 'MUJER', 1),
(3, 'KH', 'KIDS HOMBRE', 1),
(4, 'KM', 'KIDS MUJER', 1),
(5, 'UX', 'UNISEX', 1),
(6, 'KU', 'KIDS UNISEX', 1),
(7, 'SH', 'SHORT CARNAVAL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_subrubros`
--

CREATE TABLE `t_subrubros` (
  `Id_subrubro` int(11) NOT NULL,
  `Cod_Subrubro` int(11) NOT NULL,
  `Rubro_id_rubro` int(11) NOT NULL,
  `Nom_Subrubro` varchar(50) NOT NULL,
  `Subrubro_publicado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_subrubros`
--

INSERT INTO `t_subrubros` (`Id_subrubro`, `Cod_Subrubro`, `Rubro_id_rubro`, `Nom_Subrubro`, `Subrubro_publicado`) VALUES
(1, 5105, 1, 'GASTOS DE MENSAJER??A', 1),
(2, 5110, 1, 'ALMUERZOS', 1),
(3, 5115, 1, 'IMPREVISTOS EN GENERAL', 1),
(4, 5120, 1, 'SUMINISTROS (Articulos de Aseo )', 1),
(5, 5125, 1, 'COMUNICACION (Recargas a celular, Planes)', 1),
(6, 5130, 1, 'CAFETERIA', 1),
(7, 5135, 1, 'PAPELERIA', 1),
(8, 5140, 1, 'GASTOS LEGALES', 0),
(9, 5145, 1, 'MANTENIMIENTO Y REPARACIONES', 0),
(10, 5150, 1, 'ADECUACION E INSTALACI?????N', 0),
(11, 5155, 1, 'GASTOS DE VIAJE', 0),
(12, 5160, 1, 'DEPRECIACIONES', 0),
(13, 5165, 1, 'AMORTIZACIONES', 0),
(14, 5195, 1, 'DIVERSOS', 0),
(15, 5199, 1, 'PROVISIONES', 0),
(16, 5205, 2, 'GASTOS DE OFICINA (servicios pub, arriendo, etc)', 1),
(17, 5210, 2, 'GASTOS DE REPRESENTACI??N', 1),
(18, 5215, 2, 'GASTOS PERSONALES', 1),
(19, 5220, 2, 'SALUD OCUPACIONAL', 1),
(20, 5225, 2, 'PRESTAMOS A EMPLEADOS', 1),
(21, 5230, 2, 'IMPUESTOS', 1),
(22, 5235, 2, 'SEGUROS', 1),
(23, 5240, 2, 'NOMINA, MdO', 1),
(24, 5245, 2, 'MANTENIMIENTO Y REPARACIONES', 0),
(25, 5250, 2, 'ADECUACION E INSTALACION', 0),
(26, 5255, 2, 'GASTOS DE VIAJE', 0),
(27, 525505, 2, 'ALOJAMIENTO Y MANUTENCION', 0),
(28, 525510, 2, 'PASAJES FLUVIALES Y/O MARITIMOS', 0),
(29, 525515, 2, 'PASAJES AEREOSS', 0),
(30, 525520, 2, 'PASAJES TERRESTRES', 0),
(31, 525525, 2, 'PASAJES FERREOS', 0),
(32, 525595, 2, 'OTROS', 0),
(33, 525599, 2, 'AJUSTES POR INFLACION', 0),
(34, 5260, 2, 'DEPRECIACIONES', 0),
(35, 526005, 2, 'CONSTRUCCIONES Y EDIFICACIONES', 0),
(36, 526010, 2, 'MAQUINARIA Y EQUIPO', 0),
(37, 526015, 2, 'EQUIPO DE OFICINA', 0),
(38, 526020, 2, 'EQUIPO DE COMPUTACION Y COMUNICACION', 0),
(39, 526025, 2, 'EQUIPO MEDICO ', 0),
(40, 526030, 2, 'EQUIPO DE HOTELES Y RESTAURANTES', 0),
(41, 526035, 2, 'FLOTA Y EQUIPO DE TRANSPORTE', 0),
(42, 526040, 2, 'FLOTA Y EQUIPO FLUVIAL Y/O MARITIMO', 0),
(43, 526045, 2, 'FLOTA Y EQUIPO AEREO', 0),
(44, 526050, 2, 'FLOTA Y EQUIPO FERREO', 0),
(45, 526055, 2, 'ACUEDUCTOS, PLANTAS Y REDES', 0),
(46, 526060, 2, 'ARMAMENTO DE VIGILANCIA', 0),
(47, 526065, 2, 'ENVASES Y EMPAQUES', 0),
(48, 526099, 2, 'AJUSTES POR INFLACION', 0),
(49, 5265, 2, 'AMORTIZACIONES', 0),
(50, 526505, 2, 'VIAS DE COMUNICACION', 0),
(51, 526510, 2, 'INTANGIBLES', 0),
(52, 526515, 2, 'CARGOS DIFERIDOS', 0),
(53, 526595, 2, 'OTRAS', 0),
(54, 526599, 2, 'AJUSTES POR INFLACION', 0),
(55, 5270, 2, 'FINANCIEROS ', 0),
(56, 527001, 2, 'a 527098', 0),
(57, 527099, 2, 'AJUSTES POR INFLACION', 0),
(58, 5295, 2, 'DIVERSOS', 0),
(59, 529505, 2, 'COMISIONES', 0),
(60, 529510, 2, 'LIBROS, SUSCRIPCIONES, PERIODICOS Y REVISTAS', 0),
(61, 529515, 2, 'MUSICA AMBIENTAL', 0),
(62, 529520, 2, 'GASTOS DE REPRESENTACION Y RELACIONES PUBLICAS', 0),
(63, 529525, 2, 'ELEMENTOS DE ASEO Y CAFETERIA', 0),
(64, 529530, 2, 'UTILES, PAPELERIA Y FOTOCOPIAS', 0),
(65, 529535, 2, 'COMBUSTIBLES Y LUBRICANTES', 0),
(66, 529540, 2, 'ENVASES Y EMPAQUES', 0),
(67, 529545, 2, 'TAXIS Y BUSES', 0),
(68, 529550, 2, 'ESTAMPILLAS', 0),
(69, 529555, 2, 'MICROFILMACION', 0),
(70, 529560, 2, 'CASINO Y RESTAURANTE', 0),
(71, 529565, 2, 'PARQUEADEROS', 0),
(72, 529570, 2, 'INDEMNIZACION POR DA??OS A TERCEROS', 0),
(73, 529575, 2, 'POLVORA Y SIMILARES', 0),
(74, 529595, 2, 'OTROS', 0),
(75, 529599, 2, 'AJUSTES POR INFLACION', 0),
(76, 5299, 2, 'PROVISIONES', 0),
(77, 529905, 2, 'INVERSIONES', 0),
(78, 529910, 2, 'DEUDORES', 0),
(79, 529915, 2, 'INVENTARIOS', 0),
(80, 529920, 2, 'PROPIEDADES, PLANTA Y EQUIPO', 0),
(81, 529995, 2, 'OTROS ACTIVOS', 0),
(82, 529999, 2, 'AJUSTES POR INFLACION', 0),
(83, 5305, 3, 'INSUMOS TALLER', 1),
(84, 530505, 3, 'GASTOS BANCARIOS', 0),
(85, 530510, 3, 'REAJUSTE MONETARIO ', 0),
(86, 530515, 3, 'COMISIONES', 0),
(87, 530520, 3, 'INTERESES', 0),
(88, 530525, 3, 'DIFERENCIA EN CAMBIO', 0),
(89, 530530, 3, 'GASTOS EN NEGOCIACION CERTIFICADOS DE CAMBIO', 0),
(90, 530535, 3, 'DESCUENTOS COMERCIALES CONDICIONADOS', 0),
(91, 530540, 3, 'GASTOS MANEJO Y EMISION DE BONOS', 0),
(92, 530545, 3, 'PRIMA AMORTIZADA', 0),
(93, 530595, 3, 'OTROS', 0),
(94, 530599, 3, 'AJUSTES POR INFLACION', 0),
(95, 5310, 3, 'PERDIDA EN VENTA Y RETIRO DE BIENES', 0),
(96, 531005, 3, 'VENTA DE INVERSIONES', 0),
(97, 531010, 3, 'VENTA DE CARTERA', 0),
(98, 531015, 3, 'VENTA DE PROPIEDADES PLANTA Y EQUIPO', 0),
(99, 531020, 3, 'VENTA DE INTANGIBLES', 0),
(100, 531025, 3, 'VENTA DE OTROS ACTIVOS', 0),
(101, 531030, 3, 'RETIRO DE PROPIEDADES PLANTA Y EQUIPO', 0),
(102, 531035, 3, 'RETIRO DE OTROS ACTIVOS', 0),
(103, 531040, 3, 'PERDIDAS POR SINIESTROS', 0),
(104, 531095, 3, 'OTROS', 0),
(105, 531099, 3, 'AJUSTES POR INFLACION', 0),
(106, 5315, 3, 'GASTOS EXTRAORDINARIOS', 0),
(107, 531505, 3, 'COSTAS Y PROCESOS JUDICIALES', 0),
(108, 531510, 3, 'ACTIVIDADES CULTURALES Y CIVICAS', 0),
(109, 531515, 3, 'COSTOS Y GASTOS DE EJERCICIOS ANTERIORES', 0),
(110, 531520, 3, 'IMPUESTOS ASUMIDOS', 0),
(111, 531595, 3, 'OTROS', 0),
(112, 531599, 3, 'AJUSTES POR INFLACION', 0),
(113, 5395, 3, 'GASTOS DIVERSOS', 0),
(114, 539505, 3, 'DEMANDAS LABORALES', 0),
(115, 539510, 3, 'DEMANDAS POR INCUMPLIMIENTO DE CONTRATOS', 0),
(116, 539515, 3, 'INDEMNIZACIONES', 0),
(117, 539520, 3, 'MULTAS, SANCIONES Y LITIGIOS', 0),
(118, 539525, 3, 'DONACIONES', 0),
(119, 539530, 3, 'CONSTITUCION DE GARANTIAS', 0),
(120, 539535, 3, 'AMORTIZACION DE BIENES ENTREGADOS EN COMODATO', 0),
(121, 539595, 3, 'OTROS', 0),
(122, 539599, 3, 'AJUSTES POR INFLACION', 0),
(123, 5401, 4, 'CHEQUERAS', 0),
(124, 5396, 3, 'DIVERSOS', 1),
(125, 5300, 2, 'MANO DE OBRA PRODUCCION', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tallas`
--

CREATE TABLE `t_tallas` (
  `Id_Talla` int(11) NOT NULL,
  `Nom_Talla` varchar(255) NOT NULL,
  `talla_publicada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_tallas`
--

INSERT INTO `t_tallas` (`Id_Talla`, `Nom_Talla`, `talla_publicada`) VALUES
(1, '28', 1),
(2, '30', 1),
(3, '32', 1),
(4, '34', 1),
(5, '36', 1),
(6, '38', 1),
(7, '40', 1),
(8, '42', 1),
(9, 'L', 1),
(10, 'M', 1),
(11, 'S', 1),
(12, 'XL', 1),
(13, 'XXL', 1),
(14, 'SM', 0),
(15, '44', 1),
(16, 'U', 1),
(17, 'XS', 1),
(18, '37', 1),
(19, '44', 1),
(20, '43', 1),
(21, '2', 1),
(22, '4', 1),
(23, '6', 1),
(24, '8', 1),
(25, '10', 1),
(26, '12', 1),
(27, '14', 1),
(28, '16', 1),
(29, '18', 1),
(30, '39', 1),
(31, '41', 1),
(32, '25', 1),
(33, '24', 1),
(34, '27', 1),
(35, '33', 1),
(36, 'XXXL', 1),
(37, '26', 1),
(38, '29', 1),
(39, '31', 1),
(40, '35', 1),
(41, '0 a 3', 1),
(42, '3 a 6', 1),
(43, '6 a 9', 1),
(44, '9 a 12', 1),
(45, '12 a 18', 1),
(46, '18 a 24', 1),
(47, '45', 1),
(48, '23', 1),
(49, '49', 1),
(50, 'XXXXL', 1),
(51, '22', 1),
(52, '46', 1),
(53, 'XL R', 1),
(54, 'XXL R', 1),
(55, 'XXXL R', 1),
(56, '50', 1),
(57, '42 1/2', 1),
(58, 'S/M', 1),
(59, 'L/XL', 1),
(60, '5', 1),
(61, '9/11', 1),
(62, '10/12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_temporal_codigos`
--

CREATE TABLE `t_temporal_codigos` (
  `id` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `nom_tienda` varchar(255) NOT NULL,
  `id_ref` int(11) NOT NULL,
  `img_ref` varchar(255) NOT NULL,
  `cod_ref` varchar(50) NOT NULL,
  `detalle_ref` varchar(255) NOT NULL,
  `talla_id` int(5) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `valor_unidad` int(20) NOT NULL,
  `valor_total` int(20) NOT NULL,
  `fecha_ingreso` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL,
  `talla` varchar(5) NOT NULL,
  `status_recibido` varchar(255) NOT NULL COMMENT 'SI FUE O NO, RECIBIDO EN LA TIENDA',
  `codigo_generado` varchar(255) NOT NULL COMMENT 'codigo aleatorio para poder tratar los datos',
  `id_despacho` int(11) NOT NULL COMMENT 'ID DEL DESPACHO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='TABLA TEMPORAL DESPACHO INVENTARIO';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_temporal_inventario`
--

CREATE TABLE `t_temporal_inventario` (
  `id` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `nom_tienda` varchar(255) NOT NULL,
  `id_ref` int(11) NOT NULL,
  `img_ref` varchar(255) NOT NULL,
  `cod_ref` varchar(50) NOT NULL,
  `detalle_ref` varchar(255) NOT NULL,
  `talla_id` int(5) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `valor_unidad` int(20) NOT NULL,
  `valor_total` int(20) NOT NULL,
  `fecha_ingreso` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL,
  `talla` varchar(5) NOT NULL,
  `status_recibido` varchar(255) NOT NULL COMMENT 'SI FUE O NO, RECIBIDO EN LA TIENDA',
  `codigo_generado` varchar(255) NOT NULL COMMENT 'codigo aleatorio para poder tratar los datos',
  `id_despacho` int(11) NOT NULL COMMENT 'ID DEL DESPACHO',
  `cliente` varchar(255) NOT NULL,
  `id_solicitud_prod` varchar(10) NOT NULL,
  `id_cliente_sol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='TABLA TEMPORAL DESPACHO INVENTARIO';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_temporal_inventario_despachos`
--

CREATE TABLE `t_temporal_inventario_despachos` (
  `id_despacho` int(11) NOT NULL,
  `total_despacho` int(11) NOT NULL,
  `fecha_despacho` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `Nom_tienda` varchar(255) NOT NULL,
  `fecha_recepcion` datetime NOT NULL,
  `id_user_recepcion` int(11) NOT NULL,
  `status_despacho` varchar(20) NOT NULL COMMENT 'DESPACHADO, RECIBIDO',
  `observaciones` longtext NOT NULL,
  `cliente` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_temporal_ref`
--

CREATE TABLE `t_temporal_ref` (
  `Id_Temporal` int(11) NOT NULL,
  `Cod_Temporal` varchar(255) NOT NULL,
  `Nom_Temporal` varchar(255) NOT NULL,
  `Img_Temporal` varchar(255) NOT NULL,
  `Cant_Temporal` float NOT NULL,
  `Unidad_Temporal` varchar(255) NOT NULL,
  `Prom_Temporal` int(11) NOT NULL,
  `Valor_Temporal` int(11) NOT NULL,
  `Orden_Temporal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_temporal_ref2`
--

CREATE TABLE `t_temporal_ref2` (
  `Id_Temporal` int(11) NOT NULL,
  `Cod_Temporal` varchar(255) NOT NULL,
  `Nom_Temporal` varchar(255) NOT NULL,
  `Img_Temporal` varchar(255) NOT NULL,
  `Cant_Temporal` float NOT NULL,
  `Unidad_Temporal` varchar(255) NOT NULL,
  `Prom_Temporal` int(11) NOT NULL,
  `Valor_Temporal` int(11) NOT NULL,
  `Orden_Temporal` int(11) NOT NULL,
  `Referencia_Temporal` varchar(255) NOT NULL,
  `key_temp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Tabla temporal modificar insumos de referencia';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_temporal_sol`
--

CREATE TABLE `t_temporal_sol` (
  `Id_Temporal_Sol` int(11) NOT NULL,
  `Bodega_Id_Bodega` int(11) NOT NULL,
  `Cant_Solicitada` int(11) NOT NULL,
  `Talla_Solicitada` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Referencia_Id_Referencia` varchar(255) NOT NULL,
  `Fecha_Solicitud` datetime NOT NULL,
  `Fecha_Observacion` datetime NOT NULL,
  `Observa_Id_Usuario` int(11) NOT NULL,
  `Solicitud_Id_Usuari` int(11) NOT NULL,
  `Sastre_Id_Usuario` int(11) NOT NULL,
  `Vendedor_Id_Usuario` int(11) NOT NULL,
  `Valor_Prenda` int(11) NOT NULL,
  `Valor_Final` int(11) NOT NULL,
  `Valor_Adicional` int(11) NOT NULL,
  `Observa_Cliente` text NOT NULL,
  `Dispon_Insumo` varchar(255) NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Pedido_Id_Pedido` int(11) NOT NULL,
  `Fecha_Entrega` datetime NOT NULL,
  `Fecha_EntregaCliente` datetime NOT NULL,
  `Estado_Solicitud_Cliente` int(11) NOT NULL,
  `Valida_Estado_Sol` int(11) NOT NULL,
  `Estado_Depacho` int(11) NOT NULL,
  `Recibido_Despacho` int(11) NOT NULL,
  `Entregado_Despacho` int(11) NOT NULL,
  `Solicitud_Facturada` int(11) NOT NULL,
  `Factura_Num_Factura` int(11) NOT NULL,
  `consecutivosc_id_consecutivosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_temporal_traslados`
--

CREATE TABLE `t_temporal_traslados` (
  `Id_Temporal_Sol` int(11) NOT NULL,
  `Cant_Solicitada` int(11) NOT NULL,
  `Talla_Solicitada` int(11) NOT NULL,
  `Solicita_Id_Tienda` int(11) NOT NULL,
  `Envia_Id_Tienda` int(11) NOT NULL,
  `Referencia_Id_Referencia` varchar(255) NOT NULL,
  `Fecha_Solicitud` datetime NOT NULL,
  `Fecha_Observacion` datetime NOT NULL,
  `Observa_Id_Usuario` int(11) NOT NULL,
  `Solicitud_Id_Usuari` int(11) NOT NULL,
  `Sastre_Id_Usuario` int(11) NOT NULL,
  `Vendedor_Id_Usuario` int(11) NOT NULL,
  `Valor_Prenda` int(11) NOT NULL,
  `Valor_Final` int(11) NOT NULL,
  `Observa_Cliente` text NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Pedido_Id_Pedido` int(11) NOT NULL,
  `Traslado_Numero` int(11) NOT NULL,
  `Fecha_Entrega` datetime NOT NULL,
  `Estado_Solicitud_Cliente` int(11) NOT NULL,
  `Valida_Estado_Sol` int(11) NOT NULL,
  `Estado_Depacho` int(11) NOT NULL,
  `Recibido_Despacho` int(11) NOT NULL,
  `Entregado_Despacho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tiendas`
--

CREATE TABLE `t_tiendas` (
  `Id_Tienda` int(11) NOT NULL,
  `Cod_Tienda` varchar(255) NOT NULL,
  `Nom_Tienda` varchar(255) NOT NULL,
  `Dir_Tienda` varchar(255) NOT NULL,
  `Cel_Tienda` varchar(255) NOT NULL,
  `Tel_Tienda` varchar(255) NOT NULL,
  `Ciudad_Id_Ciudad` int(11) NOT NULL,
  `Estado_Tienda` int(11) NOT NULL,
  `vista_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_tiendas`
--

INSERT INTO `t_tiendas` (`Id_Tienda`, `Cod_Tienda`, `Nom_Tienda`, `Dir_Tienda`, `Cel_Tienda`, `Tel_Tienda`, `Ciudad_Id_Ciudad`, `Estado_Tienda`, `vista_tienda`) VALUES
(1, 'A', 'VALLEDUPAR', 'CRA 11 # 8-36', '(316) 844-4534', '(035) 582-0046', 9, 1, 0),
(2, 'C', 'BARRANQUILLA', 'CRA 45 # 82-195', '(300) 288-6406', '(035) 352-9749', 2, 0, 1),
(3, 'J', 'MONTERIA', 'CARRERA 10 #7C - 60', '(300) 000-0000', '(035) 301-0101', 10, 0, 1),
(4, 'E', 'CC GUATAPURI', 'CCO GUATAPURI LOCAL-1023', '(318) 897-1031', '(035) 572-4061', 9, 0, 1),
(5, 'F', 'CONFECCIONES Modasof', 'PRODUCCI', '(317) 700-6102', '(317) 700-6102', 3, 0, 1),
(7, 'G', 'RIOHACHA', 'KR7 A # 15-47 CASA 16', '(310) 322-0836', '(310) 322-0836', 14, 0, 1),
(8, 'H', 'NEIVA', 'CALLE 7 26 - 48 BARRIO LA GAITANA ', '(316) 695-8030', '(038) 870-2464', 13, 0, 1),
(9, 'K', 'SINCELEJO', 'BARRIO BOSTON CALLE 32', '317 8880783', '317 8880783', 22, 1, 0),
(10, 'D', 'BODEGA Modasof', 'TALLER BARRANQUILLA', '(317) 700-6102', '(317) 700-6102', 9, 1, 0),
(11, 'B', 'BARRANQUILLA 2021', 'CRA 11 # 8-36', '(300) 288-6406', '(035) 771-6161', 2, 1, 0),
(12, 'O', 'PANAMA', 'PANAMA', '(507) 691-0674', '(507) 691-0674', 1121, 1, 0),
(13, 'N', 'MARACAIBO', 'MARACAIBO', '(222) 222-2222', '(222) 222-2222', 1122, 1, 0),
(14, 'M', 'CARTAGENA', 'CARTAGENA', '(333) 333-3333', '(333) 333-3333', 4, 1, 0),
(15, 'L', 'CUCUTA', 'CUCUTA', '(444) 444-4444', '(444) 444-4444', 18, 1, 0),
(17, 'I', 'WEB', 'WEB', '(317) 700-6102', '(317) 700-6102', 9, 1, 0),
(18, 'C', 'MONTERIA 2024', 'CARRERA 10 #7C - 60', '(316) 524-8018', '(316) 524-8018', 10, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_traslados`
--

CREATE TABLE `t_traslados` (
  `id_traslado` int(11) NOT NULL,
  `fecha_solicitud` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_despacho` datetime NOT NULL,
  `fecha_recibido` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_tienda_desde` varchar(3) NOT NULL,
  `id_tienda_hasta` varchar(3) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_traslados_detalle`
--

CREATE TABLE `t_traslados_detalle` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `cod_referencia` varchar(255) NOT NULL,
  `cod_ref_completa` varchar(255) NOT NULL,
  `talla_id` varchar(10) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_traslado` int(11) NOT NULL,
  `aprobado` varchar(2) NOT NULL,
  `status` varchar(30) NOT NULL,
  `id_tienda_desde` varchar(3) NOT NULL,
  `id_tienda_hasta` varchar(3) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_trazabilidad_prod`
--

CREATE TABLE `t_trazabilidad_prod` (
  `Id_Trazabilidad_Prod` int(11) NOT NULL,
  `Solicitud_Cod_Solicitud_Prod` int(11) NOT NULL,
  `Fecha_Cambio_Estado` datetime NOT NULL,
  `Estado_Reportado` varchar(255) NOT NULL,
  `Dias_Transcurridos` int(11) NOT NULL,
  `Num_Prendas` int(11) NOT NULL,
  `Tipo_Prenda` int(11) NOT NULL,
  `Usuario_Id_Usuario` int(11) NOT NULL,
  `Sastre_Asignado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_trazabilidad_prod_cl`
--

CREATE TABLE `t_trazabilidad_prod_cl` (
  `Id_Trazabilidad_Prod` int(11) NOT NULL,
  `Solicitud_Cod_Solicitud_Prod` int(11) NOT NULL,
  `Fecha_Cambio_Estado` datetime NOT NULL,
  `Estado_Reportado` varchar(255) NOT NULL,
  `Dias_Transcurridos` int(11) NOT NULL,
  `Num_Prendas` int(11) NOT NULL,
  `Tipo_Prenda` int(11) NOT NULL,
  `Usuario_Id_Usuario` int(11) NOT NULL,
  `Sastre_Asignado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `Id_Usuario` int(11) NOT NULL,
  `Nombres` varchar(255) NOT NULL,
  `Apellidos` varchar(255) NOT NULL,
  `Documento` varchar(255) NOT NULL,
  `User_Name` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `Empresa` varchar(255) NOT NULL,
  `Img_Perfil` varchar(255) NOT NULL,
  `Rol_id_Rol` int(11) NOT NULL,
  `Estado_id_estado_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `t_usuarios`
--

INSERT INTO `t_usuarios` (`Id_Usuario`, `Nombres`, `Apellidos`, `Documento`, `User_Name`, `Pass`, `Empresa`, `Img_Perfil`, `Rol_id_Rol`, `Estado_id_estado_usuario`) VALUES
(1, 'Fredy Orlando', 'Gonzalez Pe??a', '80761478', 'fredyg', '4efab85aba90f0bec0c50ffa1da54808', 'Teksystem', 'Images/Perfiles/3666-producto-sin-imagen.png', 1, 1),
(6, 'Pepito', 'Perez', '', 'bodega1@hotmail.com', '12345', '', 'Images/Perfiles/1526-craneo-de-vikingo-con-alas-de-casco_8395-64.jpg', 2, 2),
(7, 'ga', 'fa', '', 'ag@gmail.com', '2324', '', 'Images/Perfiles/5341-icono.png', 1, 2),
(9, 'Sastre', 'Lopez', '', 'sastre@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'images/Perfiles/7287-User-Default.jpg', 4, 2),
(10, 'Carlos ', 'Martinez', '', 'camar@gmail.com', 'd79c8788088c2193f0244d8f1f36d2db', '', 'images/Perfiles/7287-User-Default.jpg', 4, 2),
(11, 'Alex', 'Baute', '', 'Modasofaute@hotmail.com', 'd7d832b61e397a9fa1132a48480e4a2b', '', 'Images/Perfiles/8384-BF70020C-E8BF-4E20-9521-A84D8048C5D2.jpeg', 1, 1),
(12, 'INES', 'MAZO', '', 'Ines', '89c2280ad2d1afdfadf693cf68ed2db8', '', 'Images/Perfiles/4962-Ines.jpeg', 2, 1),
(13, 'AMAURY', 'PINTO', '', 'Amaury', '123456', '', 'images/Perfiles/7287-User-Default.jpg', 3, 2),
(14, 'AMAURY', 'AMAURY', '', 'amaury@gmail.com', '123', '', 'Images/Perfiles/1234-Amaury.jpeg', 3, 2),
(15, 'Vanessa Paola', 'Padilla Gonzalez', '', 'Vanesa.p', 'bc506ef4c91bd961b2a9593ce3e8e6ef', '', 'Images/Perfiles/9171-WhatsApp Image 2021-08-11 at 4.49.37 PM.jpeg', 2, 1),
(16, 'Teksystem', 'Soluciones Informaticas', '', 'teksystem.co@gmail.com', '4efab85aba90f0bec0c50ffa1da54808', '', 'Images/Perfiles/1382-8689-logoTek.png', 3, 2),
(17, 'ALVARO', 'CASTILLO', '', 'Alvaro.c', '3012281945', '', 'images/Perfiles/7287-User-Default.jpg', 2, 2),
(18, 'LIGIA', 'VASQUES', '', 'Ligia.v', '3013226722', '', 'images/Perfiles/7287-User-Default.jpg', 2, 1),
(22, 'KAREN', 'CARRASCAL', '', 'karen.c', '7a21de11b3b7f9153571d7de6d45e9b6', '', 'Images/Perfiles/9537-Karen-Perfil.jpg', 1, 1),
(23, 'MARIA', 'FERNANDA', '', 'Maria.F', '3143195107', '', 'images/Perfiles/7287-User-Default.jpg', 2, 2),
(24, 'LISETH', 'TEJADA', '', 'liseth.t', '995e1fda4a2b5f55ef0df50868bf2a8f', '', 'Images/Perfiles/7506-IMG_20180508_134710.jpg', 3, 2),
(25, 'Mary', 'Ojeda', '', 'Mary.o', '6a1eeaa8444a5a8b5467e993053e7b7b', '', 'Images/Perfiles/9288-MaryO.jpeg', 3, 2),
(26, 'Yulianis', 'Molina', '', 'yulianismolina20@hotmail.com', '08b2e863dfa530889404eafe370a9f1a', '', 'Images/Perfiles/9550-PerfilYulianis.jpg', 3, 2),
(27, 'KAREN', 'GELES', '', 'karen.g', '0998ef2b6cb299a5257ede7e54079cde', '', 'Images/Perfiles/4939-PerfilKaren.jpg', 3, 2),
(28, 'DAVID ', 'PERONA', '', 'elmasdavid@hotmail.com', '10658185232', '', 'images/Perfiles/7287-User-Default.jpg', 3, 2),
(29, 'Ariana ', 'Monterrosa', '', 'barranquillaModasof@gmail.com', 'e0b895bfcb169f57a27824f3acda8e6f', '', 'Images/Perfiles/1069-PerfilArianna.jpg', 3, 1),
(30, 'AMANDA', 'DURAN', '', 'amaliduvi93@gmail.com', '90a21180c8ff73b0f44656c9cd47748a', '', 'Images/Perfiles/5403-logo-chat.png', 3, 2),
(31, 'Pablo', 'Contramaestre', '', 'pcontramaestre@gmail.com', 'f6633746527ecf50fe686f31df85d294', '', 'Images/Perfiles/6452-WhatsApp Image 2018-06-26 at 12.36.54.jpeg', 1, 2),
(32, 'MAYERLY', 'BENAVIDES', '', 'mayerly.benavides@teksystem.co', '7a70f313c72f08915cebc64d0d6a9291', '', 'Images/Perfiles/1273-IMG_20191214_144444.jpg', 1, 1),
(33, 'Amalia', 'Geles', '', 'A.geles', 'b88b03d971a80243917fa90725bbf23a', '', 'Images/Perfiles/5403-logo-chat.png', 1, 1),
(34, 'Pruebas', 'pruebas', '', 'pp@ff.com', 'e10adc3949ba59abbe56e057f20f883e', '', 'images/Perfiles/7287-User-Default.jpg', 1, 2),
(35, 'JEFE', 'PROD', '', 'jefe@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', 'Images/Perfiles/5403-logo-chat.png', 2, 1),
(36, 'Vendedor', 'Pruebas', '', 'ventas@gmail.com', '97db1846570837fce6ff62a408f1c26a', '', 'Images/Perfiles/5403-logo-chat.png', 3, 2),
(37, 'HERNANDO', 'CARBALLO', '', 'nando-1306@hotmail.com', '12bbbc16687301a3dac3d4a60bb94e3a', '', 'images/Perfiles/7287-User-Default.jpg', 3, 2),
(38, 'Ines', 'Ventas', '', 'VentasTaller', 'd76f8bddec056c9c3b4899169788b257', '', 'Images/Perfiles/5403-logo-chat.png', 3, 2),
(39, 'MAIRA ALEJANDRA', 'RAUDALES', '', 'MALEJARAUDALES@HOTMAIL.COM', '99a8e8c39570616385a3d698989d264e', '', 'Images/Perfiles/5403-logo-chat.png', 1, 1),
(40, 'Web', 'Site', '', 'webSite', 'd876ca6c4f5e015f2c46db65bb727229', '', 'Images/Perfiles/5403-logo-chat.png', 6, 1),
(41, 'Taller', 'Online', '', 'taller', '54f664c70c22054ea0d8d26fc3997ce7', '', 'Images/Perfiles/5403-logo-chat.png', 7, 1),
(42, 'taller2', 'online', '', 'taller2', '81dc9bdb52d04dc20036dbd8313ed055', '', 'Images/Perfiles/5403-logo-chat.png', 7, 1),
(43, 'ALEXANDRA', 'BENAVIDES', '', 'mabema11@hotmail.com', '7a70f313c72f08915cebc64d0d6a9291', '', 'Images/Perfiles/3705-4.jpg', 3, 1),
(44, 'YEANA', 'VANESA', '', 'Yeana', 'e10adc3949ba59abbe56e057f20f883e', '', 'Images/Perfiles/5403-logo-chat.png', 3, 2),
(45, 'Yarilis Esther', 'Molina Martinez', '', 'yarilis3107@gmail.com', '5c5d9b02dcacf477af536512c38e21fa', '', 'Images/Perfiles/5403-logo-chat.png', 3, 1),
(46, 'Jorge', 'Carrascal', '', 'Jorgeandrescarrascal@gmail.com', '04997e265d3d615cb72b8d118ba2dc65', '', 'Images/Perfiles/9328-jorge.jpeg', 3, 0),
(47, 'Andrea', 'Berrio', '', 'Andre@Berrio', '375d272c08022816402f1798f7a5f478', '', 'Images/Perfiles/5403-logo-chat.png', 6, 1),
(48, 'Taller Ariana ', 'Barranquilla', '', 'ariana@taller', 'e10adc3949ba59abbe56e057f20f883e', '', 'Images/Perfiles/5403-logo-chat.png', 2, 1),
(49, 'Tienda Monteria', 'Monteria', '', 'monteria@Modasofaute.com', 'e1f78bdd9ee1f5dc3ed6d881a0427e47', '', 'Images/Perfiles/5403-logo-chat.png', 3, 1),
(50, 'Ventas Karen', 'Modasofaute', '', 'Karen@ventas', '48cea5edef5e553d524c40c7875ddba2', '', 'Images/Perfiles/7163-Karen Carrascal.jpeg', 3, 1),
(51, 'Ventas Ines', 'Modasofaute', '', 'Ines@ventas', 'e10adc3949ba59abbe56e057f20f883e', '', 'Images/Perfiles/5403-logo-chat.png', 3, 2),
(52, 'Vanessa Paola', 'Padilla Gonzalez', '', 'vanepaopadilla19@gmail.com', 'bc506ef4c91bd961b2a9593ce3e8e6ef', '', 'Images/Perfiles/2912-WhatsApp Image 2021-08-17 at 4.11.27 PM.jpeg', 3, 2),
(53, 'Lleana', 'Vanessa', '', 'lleanavanessa@hotmail.com', '5cdb67c5ea5b05e42b4f5c8e15ab57d9', '', 'Images/Perfiles/5403-logo-chat.png', 3, 2),
(54, 'Rodrigo David', 'Arregoces Cifuentes', '', 'GerenciaModasofaute@gmail.com', 'e0d2aacd8064654e9ff4203cfff093ec', '', 'Images/Perfiles/2937-8F05672E-FD72-4D94-B244-6CE655BC1EE0.jpeg', 1, 1),
(55, 'Keiner', 'Mendoza', '', 'Bumeranla@gmail.com', '3ce504f32a7a64d5f5601f46fdc31b74', '', 'Images/Perfiles/5403-logo-chat.png', 6, 1),
(56, 'Liseth taller', 'Tejada', '', 'lisethtaller@Modasof', 'fcea920f7412b5da7be0cf42b8c93759', '', 'Images/Perfiles/1865-WhatsApp Image 2020-05-06 at 12.45.51 PM.jpeg', 2, 1),
(57, 'Anyela', 'Palacio', '', 'solbarriosrivadeneira@gmail.com', 'b7246bf64febc4a35cebe2e24ea38b37', '', 'Images/Perfiles/7362-Riohacha.jpeg', 3, 1),
(58, 'Rodrigo ventas', 'Arregoces Ventas', '', 'VentasGerencia@gmail.com', 'e0d2aacd8064654e9ff4203cfff093ec', '', 'Images/Perfiles/8799-B20588D5-1133-46F5-AA8C-AB3771DE72A5.jpeg', 3, 1),
(59, 'Alex Ventas', 'Baute', '', 'VentasAlex@gmail.com', 'd7d832b61e397a9fa1132a48480e4a2b', '', 'Images/Perfiles/5403-logo-chat.png', 3, 1),
(60, 'Jurgen', 'Hassler', '', 'designs.Modasof@gmail.com', '4a37a95dae5e806ac0e067ccfbad14fa', '', 'images/Perfiles/7287-User-Default.jpg', 2, 1),
(61, 'Ventas Yarili', 'Molina', '', 'ventasyarili@Modasof.com', 'cd26449908556605a05bae6a442baa9b', '', 'images/Perfiles/7287-User-Default.jpg', 3, 1),
(62, 'Angie Mendoza', 'Dise?adora', '', 'angiehelenam', '71dd52ce8552c8daa9938869a14baac1', '', 'images/Perfiles/7287-User-Default.jpg', 2, 1),
(63, 'Rita', 'Barros', '', 'milumejiab@gmail.com', '138b5402e3f69de37404c5ffddff369d', '', 'images/Perfiles/7287-User-Default.jpg', 3, 1),
(64, 'ventas Pagina Web', 'WEB', '', 'ventasweb@Modasof.com', 'cccf66179eb1337211c027ad9670c881', '', 'Images/Perfiles/3420-usuario ventas web.jpeg', 3, 1),
(65, 'Gerencia Monteria', 'Cristian', '', 'Grupoempresarialmartinezpuche@gmail.com', 'e1f78bdd9ee1f5dc3ed6d881a0427e47', '', 'images/Perfiles/7287-User-Default.jpg', 3, 2),
(66, 'Andrea', 'Neiva', '', 'andrea@ventasneiva', '84f9e097ab7909d77684c6c3148d6142', '', 'images/Perfiles/7287-User-Default.jpg', 3, 1),
(67, 'KarenTaller', 'Carrascal', '', 'Karentaller@Modasof.com', '7a21de11b3b7f9153571d7de6d45e9b6', '', 'images/Perfiles/7287-User-Default.jpg', 2, 2),
(68, 'Fredy Ventas', 'Gonzalez', '', 'fredyventas@Modasof', '167f7366cb219911964d8f94ea5602a1', '', 'images/Perfiles/7287-User-Default.jpg', 3, 2),
(69, 'Rayzha ', 'Ahumada Ochoa', '', 'rayzhaahumada33@gmail.com', 'b50663736d3114ef57986d93495d9e0e', '', 'Images/Perfiles/9537-SAVE_20210217_143332.jpg', 3, 2),
(70, 'Isabella ', 'Fuentes', '', 'isabellafuente@Modasof.com', 'dabecdf191eb86e4c78b9388814d3a56', '', 'Images/Perfiles/9966-WhatsApp Image 2021-06-24 at 12.50.19 PM.jpeg', 3, 2),
(71, 'Mauren', 'Aduen', '', 'maurenaduen@Modasof.com', 'a20199abebd4dd0ce14a2951a9266049', '', 'Images/Perfiles/8247-WhatsApp Image 2021-06-24 at 12.49.54 PM.jpeg', 3, 1),
(72, 'RAFAEL ', 'GAMARRA', '', 'Admintallerbquilla@Modasof.com', 'd59c2d4f2332745900db42d437760b89', '', 'Images/Perfiles/9546-SAVE_20220810_122940.jpg', 2, 1),
(73, 'RAFAEL ', 'GAMARRA', '', 'ventasrafael@Modasof.com', 'd59c2d4f2332745900db42d437760b89', '', 'Images/Perfiles/2600-SAVE_20220810_122940.jpg', 3, 1),
(74, 'CARMEN ', 'BORRAS', '', 'Klba20@hotmail.com', 'd2fee9337c5447d1ad1d28bec0e9fc01', '', 'Images/Perfiles/7518-Carmen Modasof VAlledupar.jpeg', 3, 1),
(75, 'Jorge taller', 'Carrascal', '', 'jorge.taller@Modasof.com', '06effaad1f3efd2c2bbc64a85913c395', '', 'images/Perfiles/7287-User-Default.jpg', 2, 1),
(76, 'Lucia', 'Sinning', '', 'Luciasinning@Modasof.com', 'ebe7777771ffd70825e9961adc271c30', '', 'Images/Perfiles/4941-Lucia Sinning.jpeg', 3, 2),
(77, 'Hernando', 'Caraballo', '', 'hernandoventas@Modasof.com', '3abbd475c2b43fc9a6835b243aa57a42', '', 'Images/Perfiles/9331-SAVE_20211108_164644.jpg', 3, 1),
(78, 'Seylin', 'Campo', '', 'seylin.campo@Modasof.com', 'e3e62464a81b1e0d815385e1f9aa12dc', '', 'Images/Perfiles/2938-Seylin.jpeg', 3, 1),
(79, 'Angie', 'Olmos', '', 'DesingModasofbq@gmail.com', '071556d98b5b2971cacc94bd219db7d8', '', 'Images/Perfiles/1161-SAVE_20211223_120207.jpg', 2, 1),
(80, 'KARINA', 'BENT', '', 'Karibent92@gmail.com', '4fbaa08bd17306d4b109dcf56bb3da4b', '', 'images/Perfiles/7287-User-Default.jpg', 3, 1),
(81, 'DANIEL', 'PADILLA GUERRA', '', 'padilladaniel605@gmail.com', 'e531aa0b3b02871eda90bb7d67d93094', '', 'images/Perfiles/7287-User-Default.jpg', 2, 2),
(82, 'David', 'Lopez', '', 'Davidventas@Modasof-out', '45a170c85686894cb3a102b44010ab77', '', 'Images/Perfiles/867-David Valledupar.jpeg', 3, 1),
(83, 'CAMILA ', 'RINCON', '', 'ebrandsbymp@gmail.com', '2cbc7e287050caf230aa3d6594b955cd', '', 'Images/Perfiles/4079-cartagena.jpg', 3, 1),
(84, 'CAMILA', 'RINCON', '', 'mbolivarrincon4@hotmail.com', '014b1bcc760415cb90387b6d0a05a24c', '', 'images/Perfiles/7287-User-Default.jpg', 0, 1),
(85, 'Carlos', 'Perez', '', 'VentasMaracaibo', '6625e6de7f63e024871a410862ee6e69', '', 'Images/Perfiles/4094-Carlos Perez Maracaibo.jpeg', 3, 1),
(86, 'Karen taller', 'Carrascal', '', 'karentaller@Modasof', 'fc765ba2169b46d0202acd208175b118', '', 'images/Perfiles/7287-User-Default.jpg', 2, 1),
(87, 'RUBY', 'MENDOZA', '', 'VentasCucuta@Modasof', '2a5c89c13f59b9a3a6d7702add190100', '', 'images/Perfiles/7287-User-Default.jpg', 3, 1),
(88, 'Ventas ', 'Sincelejo', '', 'VentasSincelejo@Modasof', '23b8557027f0742b3fa190726b62d6da', '', 'images/Perfiles/7287-User-Default.jpg', 3, 1),
(89, 'SILVIO', 'VANEGAS', '', 'silviotaller@Modasof', '0d87ae599b79952c16484067690b683c', '', 'images/Perfiles/7287-User-Default.jpg', 2, 1),
(90, 'Angie ventas', 'Olmos', '', 'angieventas@Modasof', '071556d98b5b2971cacc94bd219db7d8', '', 'Images/Perfiles/2079-WhatsApp Image 2023-01-25 at 5.55.36 PM.jpeg', 3, 1),
(91, 'Daniel admin', 'Padilla Guerra', '', 'daniel.admin@Modasof.com', 'be472154285a4b1dc95955a7b84d34df', '', 'images/Perfiles/7287-User-Default.jpg', 1, 2),
(92, 'Ena Clara', 'Duque Herrera', '', 'enaduque@hotmail.com', '9a182dc20aac71a7ea13c74fe3365f45', '', 'images/Perfiles/7287-User-Default.jpg', 3, 2),
(93, 'Valeria', 'Tamayo Geles', '', 'valeriatamayog2014@gmail.com', 'b69a65876f57f794fffb0824c48161cc', '', 'Images/Perfiles/2668-191d0a4e-bba2-4ccb-95b7-db048e47389a.jpg', 3, 1),
(94, 'Danny Alejandra', 'Esquivel', '', 'alejandraesquivelb@gmail.com', 'be442389518d7c83a52656768a2bfb8c', '', 'images/Perfiles/7287-User-Default.jpg', 3, 1),
(95, 'Benny junior', 'Hereira Villegas', '', 'Benny@Modasof.com', '7df837c9c1f93561031f0dee060f7139', '', 'images/Perfiles/7287-User-Default.jpg', 2, 1),
(96, 'Sebastian ', 'Cantillo', '', 'sebastiantaller@Modasof', '6ebb5bae4b245b3dbdd89fe2c1e23189', '', 'images/Perfiles/7287-User-Default.jpg', 2, 1),
(97, 'Benny', 'tienda Bodega', '', 'bodega@Modasof.com', 'f0fb3748c37597951ee4a46161f72f89', '', 'images/Perfiles/7287-User-Default.jpg', 3, 1),
(98, 'Maria', 'Ortega', '', 'maria.ventas@Modasof.com', 'f0e3ec475d9a8d52897779eecf79a3d0', '', 'Images/Perfiles/6986-maria barranquilla.jpg', 3, 1),
(99, 'Genesis', 'Mendoza', '', 'genemb8@gmail.com', 'b58a0a7648a1643f7351c9dcf2bbc660', '', 'Images/Perfiles/857-genesis.jpg', 3, 1),
(100, 'Angelica', 'Basas Flores', '', 'angelicaventas@Modasof.com', 'e1e7772ff1ac45ff720ff56e49ec9ef8', '', 'images/Perfiles/7287-User-Default.jpg', 3, 1),
(101, 'Yisela Marcela', 'Otero', '', 'yiselaventas@Modasof.com', 'f7af0a2ccb2620d068de7efe31f60514', '', 'images/Perfiles/7287-User-Default.jpg', 3, 1),
(102, 'Juan David?', 'Benitez?Calle', '', 'proclajum@gmail.com', 'd4c5d5997d928dceb90d7d1437491e31', '', 'images/Perfiles/7287-User-Default.jpg', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios_activos`
--

CREATE TABLE `t_usuarios_activos` (
  `id` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `otros` varchar(250) NOT NULL,
  `start` varchar(250) NOT NULL,
  `expire` varchar(250) NOT NULL,
  `ip` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `t_usuarios_activos`
--

INSERT INTO `t_usuarios_activos` (`id`, `Id_Usuario`, `codigo`, `otros`, `start`, `expire`, `ip`) VALUES
(2, 43, '7fcjfhfukrmp5r86jn26nkiueq', 'mabema11@hotmail.com', '1706581701', '1706725701', ''),
(3, 1, 'j7at2kv3gttrfk2ogdmrvc1f69', 'fredyg', '1706619947', '1706763947', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios_log`
--

CREATE TABLE `t_usuarios_log` (
  `id` int(11) NOT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `accion` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `observacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `t_usuarios_log`
--

INSERT INTO `t_usuarios_log` (`id`, `Id_Usuario`, `accion`, `fecha`, `observacion`) VALUES
(1, 1, 'Logeado como administrador', '2024-01-25 17:15:09', 'login.php'),
(2, 1, 'Entrada a Pagina Principal', '2024-01-25 17:15:09', 'index.php'),
(3, 1, 'Entrada a Pagina Principal', '2024-01-25 17:24:09', 'index.php'),
(4, 1, 'Entrada a Pagina Principal', '2024-01-25 17:24:10', 'index.php'),
(5, 1, 'Entrada a Pagina Principal', '2024-01-25 17:26:00', 'index.php'),
(6, 1, 'Entrada a Pagina Principal', '2024-01-25 17:27:52', 'index.php'),
(7, 1, 'Entrada a Pagina Principal', '2024-01-25 17:27:57', 'index.php'),
(8, 1, 'Entrada a Pagina Principal', '2024-01-25 17:28:02', 'index.php'),
(9, 1, 'Entrada a Pagina Principal', '2024-01-25 17:28:12', 'index.php'),
(10, 1, 'Entrada a Pagina Principal', '2024-01-25 17:28:24', 'index.php'),
(11, 1, 'Logeado como administrador', '2024-01-26 07:46:34', 'login.php'),
(12, 1, 'Entrada a Pagina Principal', '2024-01-26 07:46:34', 'index.php'),
(13, 1, 'Logeado como administrador', '2024-01-27 07:15:20', 'login.php'),
(14, 1, 'Entrada a Pagina Principal', '2024-01-27 07:15:20', 'index.php'),
(15, 1, 'Entrada a Pagina Principal', '2024-01-27 07:17:26', 'index.php'),
(16, 1, 'Entrada a Pagina Principal', '2024-01-27 07:17:29', 'index.php'),
(17, 1, 'Entrada a Pagina Principal', '2024-01-27 07:17:37', 'index.php'),
(18, 1, 'Entrada a Pagina Principal', '2024-01-27 07:18:02', 'index.php'),
(19, 1, 'Entrada a Pagina Principal', '2024-01-27 07:19:20', 'index.php'),
(20, 1, 'Logeado como administrador', '2024-01-29 20:08:21', 'login.php'),
(21, 1, 'Entrada a Pagina Principal', '2024-01-29 20:08:21', 'index.php'),
(22, 1, 'Entrada a Pagina Principal', '2024-01-29 20:11:34', 'index.php'),
(23, 1, 'Entrada a Pagina Principal', '2024-01-29 20:11:59', 'index.php'),
(24, 1, 'Entrada a Pagina Principal', '2024-01-29 20:12:07', 'index.php'),
(25, 1, 'Entrada a Pagina Principal', '2024-01-29 20:12:46', 'index.php'),
(26, 1, 'Entrada a Pagina Principal', '2024-01-29 20:12:57', 'index.php'),
(27, 1, 'Entrada a Pagina Principal', '2024-01-29 20:13:06', 'index.php'),
(28, 1, 'Entrada a Pagina Principal', '2024-01-29 20:13:21', 'index.php'),
(29, 1, 'Entrada a Pagina Principal', '2024-01-29 20:13:40', 'index.php'),
(30, 1, 'Entrada a Pagina Principal', '2024-01-29 20:13:42', 'index.php'),
(31, 1, 'Entrada a Pagina Principal', '2024-01-29 20:14:00', 'index.php'),
(32, 1, 'Entrada a Pagina Principal', '2024-01-29 20:14:01', 'index.php'),
(33, 1, 'Entrada a Pagina Principal', '2024-01-29 20:14:07', 'index.php'),
(34, 1, 'Entrada a Pagina Principal', '2024-01-29 20:14:36', 'index.php'),
(35, 1, 'Entrada a Pagina Principal', '2024-01-29 20:15:14', 'index.php'),
(36, 1, 'Entrada a Pagina Principal', '2024-01-29 21:14:12', 'index.php'),
(37, 1, 'Entrada a Pagina Principal', '2024-01-29 21:14:21', 'index.php'),
(38, 1, 'Entrada a Pagina Principal', '2024-01-29 21:14:31', 'index.php'),
(39, 1, 'Entrada a Pagina Principal', '2024-01-29 21:15:16', 'index.php'),
(40, 1, 'Entrada a Pagina Principal', '2024-01-29 21:15:17', 'index.php'),
(41, 1, 'Logeado como administrador', '2024-01-29 21:15:34', 'login.php'),
(42, 1, 'Entrada a Pagina Principal', '2024-01-29 21:15:34', 'index.php'),
(43, 1, 'Entrada a Pagina Principal', '2024-01-29 21:20:27', 'index.php'),
(44, 43, 'Logeado como Rol 3', '2024-01-29 21:28:21', 'login.php'),
(45, 43, 'Ingreso a la pagina principal de tiendas', '2024-01-29 21:28:21', '/copia_Modasof/Administrator/index-tiendas.php'),
(46, 1, 'Logeado como administrador', '2024-01-29 21:29:56', 'login.php'),
(47, 1, 'Logeado como administrador', '2024-01-29 21:32:11', 'login.php'),
(48, 1, 'Logeado como administrador', '2024-01-29 21:33:38', 'login.php'),
(49, 1, 'Entrada a Perfil del Usuario', '2024-01-29 22:16:40', 'perfil.php'),
(50, 1, 'Entrada a Perfil del Usuario', '2024-01-30 08:01:40', 'perfil.php'),
(51, 1, 'Logeado como administrador', '2024-01-30 08:05:47', 'login.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios_tienda`
--

CREATE TABLE `t_usuarios_tienda` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tienda_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ventas`
--

CREATE TABLE `t_ventas` (
  `Id_Venta` int(11) NOT NULL,
  `Cant_Solicitada` int(11) NOT NULL,
  `Talla_Solicitada` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Referencia_Id_Referencia` varchar(255) NOT NULL,
  `Ref_Vendida` varchar(255) NOT NULL,
  `Fecha_Solicitud` datetime NOT NULL,
  `Vendedor_Id_Usuario` int(11) NOT NULL,
  `Valor_Prenda` int(11) NOT NULL,
  `Valor_Final` int(11) NOT NULL,
  `Observa_Cliente` text NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Factura_Id_Factura` int(11) NOT NULL,
  `Valida_Estado_Sol` int(11) NOT NULL,
  `Estado_Venta` int(11) NOT NULL,
  `Recibido_Despacho` int(11) NOT NULL,
  `Entregado_Despacho` int(11) NOT NULL,
  `Estado_Anulado` int(11) NOT NULL,
  `Estado_Devolucion` int(11) NOT NULL,
  `consecutivosc_id_consecutivosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ventas_27022023`
--

CREATE TABLE `t_ventas_27022023` (
  `Id_Venta` int(11) NOT NULL,
  `Cant_Solicitada` int(11) NOT NULL,
  `Talla_Solicitada` int(11) NOT NULL,
  `Tienda_Id_Tienda` int(11) NOT NULL,
  `Referencia_Id_Referencia` varchar(25) NOT NULL,
  `Ref_Vendida` varchar(25) NOT NULL,
  `Fecha_Solicitud` datetime NOT NULL,
  `Vendedor_Id_Usuario` int(11) NOT NULL,
  `Valor_Prenda` int(11) NOT NULL,
  `Valor_Final` int(11) NOT NULL,
  `Observa_Cliente` varchar(80) NOT NULL,
  `Cliente_Id_Cliente` int(11) NOT NULL,
  `Factura_Id_Factura` int(11) NOT NULL,
  `Valida_Estado_Sol` int(11) NOT NULL,
  `Estado_Venta` int(11) NOT NULL,
  `Recibido_Despacho` int(11) NOT NULL,
  `Entregado_Despacho` int(11) NOT NULL,
  `Estado_Anulado` int(11) NOT NULL,
  `Estado_Devolucion` int(11) NOT NULL,
  `consecutivosc_id_consecutivosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ingreso_temporal_usuario`
--
ALTER TABLE `ingreso_temporal_usuario`
  ADD PRIMARY KEY (`Id_Ingreso_Tempora`);

--
-- Indices de la tabla `t_actualizacion_ordenes`
--
ALTER TABLE `t_actualizacion_ordenes`
  ADD PRIMARY KEY (`Id_Actualizacion_Orden`);

--
-- Indices de la tabla `t_ajustes_inventario_ref`
--
ALTER TABLE `t_ajustes_inventario_ref`
  ADD PRIMARY KEY (`Id_Registro_Ajuste_Ref`);

--
-- Indices de la tabla `t_ajustes_inventario_telas`
--
ALTER TABLE `t_ajustes_inventario_telas`
  ADD PRIMARY KEY (`Id_Registro_Ajuste`);

--
-- Indices de la tabla `t_areas`
--
ALTER TABLE `t_areas`
  ADD PRIMARY KEY (`Id_Area`);

--
-- Indices de la tabla `t_atributos_categoria_ins`
--
ALTER TABLE `t_atributos_categoria_ins`
  ADD PRIMARY KEY (`Id_Atributo_Categoria`),
  ADD KEY `Categoria_Id_Categoria_Insumo` (`Categoria_Id_Categoria_Insumo`);

--
-- Indices de la tabla `t_bodegas`
--
ALTER TABLE `t_bodegas`
  ADD PRIMARY KEY (`Id_Bodega`);

--
-- Indices de la tabla `t_bonos`
--
ALTER TABLE `t_bonos`
  ADD PRIMARY KEY (`Id_bono`);

--
-- Indices de la tabla `t_cartera`
--
ALTER TABLE `t_cartera`
  ADD PRIMARY KEY (`Id_Cartera`);

--
-- Indices de la tabla `t_categorias_insumos`
--
ALTER TABLE `t_categorias_insumos`
  ADD PRIMARY KEY (`Id_Categoria_Insumo`);

--
-- Indices de la tabla `t_categoria_producto`
--
ALTER TABLE `t_categoria_producto`
  ADD PRIMARY KEY (`Id_Cat_Producto`);

--
-- Indices de la tabla `t_causales`
--
ALTER TABLE `t_causales`
  ADD PRIMARY KEY (`id_causal`);

--
-- Indices de la tabla `t_cc`
--
ALTER TABLE `t_cc`
  ADD PRIMARY KEY (`Id_Remision`),
  ADD KEY `indexfacturasusuario` (`Usuario_Vendedor`),
  ADD KEY `indexfacturastienda` (`Tienda_Id_Tienda`);

--
-- Indices de la tabla `t_ciudades`
--
ALTER TABLE `t_ciudades`
  ADD PRIMARY KEY (`Id_Ciudad`);

--
-- Indices de la tabla `t_clientes`
--
ALTER TABLE `t_clientes`
  ADD PRIMARY KEY (`Id_Cliente`),
  ADD KEY `indexclientesciudad` (`Ciudad_Id_Ciudad`),
  ADD KEY `indexclientesusuario` (`Ingresado_Por`);

--
-- Indices de la tabla `t_colecciones`
--
ALTER TABLE `t_colecciones`
  ADD PRIMARY KEY (`Id_Coleccion`);

--
-- Indices de la tabla `t_colores`
--
ALTER TABLE `t_colores`
  ADD PRIMARY KEY (`Id_Color`);

--
-- Indices de la tabla `t_colores_ref`
--
ALTER TABLE `t_colores_ref`
  ADD PRIMARY KEY (`Id_Color_Ref`);

--
-- Indices de la tabla `t_comentarios_produccion`
--
ALTER TABLE `t_comentarios_produccion`
  ADD PRIMARY KEY (`Id_Comentario_Produccion`);

--
-- Indices de la tabla `t_comentarios_produccion_cliente`
--
ALTER TABLE `t_comentarios_produccion_cliente`
  ADD PRIMARY KEY (`Id_Comentario_Produccion`);

--
-- Indices de la tabla `t_config`
--
ALTER TABLE `t_config`
  ADD PRIMARY KEY (`Desarrollador`);

--
-- Indices de la tabla `t_config_tienda`
--
ALTER TABLE `t_config_tienda`
  ADD PRIMARY KEY (`Id_Config_Tienda`),
  ADD KEY `Tienda_Id_Tienda` (`Tienda_Id_Tienda`);

--
-- Indices de la tabla `t_contacto_usuario`
--
ALTER TABLE `t_contacto_usuario`
  ADD PRIMARY KEY (`Id_Contacto`),
  ADD KEY `Usuario_id_usuario` (`Usuario_id_usuario`);

--
-- Indices de la tabla `t_detalle_despachos`
--
ALTER TABLE `t_detalle_despachos`
  ADD PRIMARY KEY (`Id_Detalle_Despacho`);

--
-- Indices de la tabla `t_devoluciones`
--
ALTER TABLE `t_devoluciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_devoluciones_detalle`
--
ALTER TABLE `t_devoluciones_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_devolucion_dinero`
--
ALTER TABLE `t_devolucion_dinero`
  ADD PRIMARY KEY (`id_devolucion_dinero`);

--
-- Indices de la tabla `t_devolucion_ordenes`
--
ALTER TABLE `t_devolucion_ordenes`
  ADD PRIMARY KEY (`Id_Devolucion_Orden`);

--
-- Indices de la tabla `t_estado_llamadas`
--
ALTER TABLE `t_estado_llamadas`
  ADD PRIMARY KEY (`Id_Estado_Llamada`);

--
-- Indices de la tabla `t_estado_pedidos`
--
ALTER TABLE `t_estado_pedidos`
  ADD PRIMARY KEY (`Id_Estado_Pedido`);

--
-- Indices de la tabla `t_estado_usuario`
--
ALTER TABLE `t_estado_usuario`
  ADD PRIMARY KEY (`Id_Estado_Usuario`);

--
-- Indices de la tabla `t_facturas`
--
ALTER TABLE `t_facturas`
  ADD PRIMARY KEY (`Id_Factura`),
  ADD KEY `indexfacturasusuario` (`Usuario_Vendedor`),
  ADD KEY `indexfacturastienda` (`Tienda_Id_Tienda`),
  ADD KEY `indexfacturasestadosc` (`estado_sc`);

--
-- Indices de la tabla `t_frecuencia_clientes`
--
ALTER TABLE `t_frecuencia_clientes`
  ADD PRIMARY KEY (`id_registro`);

--
-- Indices de la tabla `t_gastos`
--
ALTER TABLE `t_gastos`
  ADD PRIMARY KEY (`Id_gasto`),
  ADD KEY `Rubro_id_rubro` (`Rubro_id_rubro`);

--
-- Indices de la tabla `t_ingresos`
--
ALTER TABLE `t_ingresos`
  ADD PRIMARY KEY (`Id_Ingreso`),
  ADD KEY `indexingresosmedio` (`Medio_Pago`),
  ADD KEY `indeingresostienda` (`Tienda_Id_Tienda`) USING BTREE,
  ADD KEY `indexingresosusuario` (`Ingreso_Id_Usuario`);

--
-- Indices de la tabla `t_ingreso_dinero`
--
ALTER TABLE `t_ingreso_dinero`
  ADD PRIMARY KEY (`id_ingresodinero`);

--
-- Indices de la tabla `t_insumos`
--
ALTER TABLE `t_insumos`
  ADD PRIMARY KEY (`Id_Insumo`),
  ADD KEY `CategoriaIns_Id_CategoriaIns` (`Categoria_Id_Categoria_Insumo`);

--
-- Indices de la tabla `t_insumos_ref`
--
ALTER TABLE `t_insumos_ref`
  ADD PRIMARY KEY (`Id_Insumo_Ref`),
  ADD KEY `indexinsumos` (`Referencia_Cod_Referencia`);

--
-- Indices de la tabla `t_inventario`
--
ALTER TABLE `t_inventario`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `t_inventarionueva`
--
ALTER TABLE `t_inventarionueva`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `t_inventario_bar`
--
ALTER TABLE `t_inventario_bar`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `t_inventario_mont`
--
ALTER TABLE `t_inventario_mont`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `t_inventario_nov`
--
ALTER TABLE `t_inventario_nov`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `t_inventario_ref`
--
ALTER TABLE `t_inventario_ref`
  ADD PRIMARY KEY (`Id_Registro_Inv`);

--
-- Indices de la tabla `t_inventario_ref_entradas_despachos`
--
ALTER TABLE `t_inventario_ref_entradas_despachos`
  ADD PRIMARY KEY (`Id_Registro_Inv`);

--
-- Indices de la tabla `t_inventario_ref_entradas_devoluciones`
--
ALTER TABLE `t_inventario_ref_entradas_devoluciones`
  ADD PRIMARY KEY (`Id_Registro_Inv`);

--
-- Indices de la tabla `t_inventario_ref_entradas_traslados`
--
ALTER TABLE `t_inventario_ref_entradas_traslados`
  ADD PRIMARY KEY (`Id_Registro_Inv`);

--
-- Indices de la tabla `t_inventario_ref_inicial`
--
ALTER TABLE `t_inventario_ref_inicial`
  ADD PRIMARY KEY (`Id_Registro_Inv`);

--
-- Indices de la tabla `t_inventario_ref_salidas_traslados`
--
ALTER TABLE `t_inventario_ref_salidas_traslados`
  ADD PRIMARY KEY (`Id_Registro_Inv`);

--
-- Indices de la tabla `t_inventario_ref_ventas`
--
ALTER TABLE `t_inventario_ref_ventas`
  ADD PRIMARY KEY (`Id_Registro_Inv`);

--
-- Indices de la tabla `t_inventario_segura`
--
ALTER TABLE `t_inventario_segura`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `t_inventario_separe`
--
ALTER TABLE `t_inventario_separe`
  ADD PRIMARY KEY (`Id_Registro_Inv`);

--
-- Indices de la tabla `t_inventario_telas`
--
ALTER TABLE `t_inventario_telas`
  ADD PRIMARY KEY (`Id_inventario_tela`);

--
-- Indices de la tabla `t_inventario_telas_res`
--
ALTER TABLE `t_inventario_telas_res`
  ADD PRIMARY KEY (`Id_inventario_tela`);

--
-- Indices de la tabla `t_llamadas`
--
ALTER TABLE `t_llamadas`
  ADD PRIMARY KEY (`Id_Llamada`);

--
-- Indices de la tabla `t_medios_pago`
--
ALTER TABLE `t_medios_pago`
  ADD PRIMARY KEY (`Id_Medio_Pago`);

--
-- Indices de la tabla `t_mov_cuentas`
--
ALTER TABLE `t_mov_cuentas`
  ADD PRIMARY KEY (`Id_Mov_Cuenta`);

--
-- Indices de la tabla `t_mov_insumos`
--
ALTER TABLE `t_mov_insumos`
  ADD PRIMARY KEY (`Id_Mov_Insumos`);

--
-- Indices de la tabla `t_notificaciones`
--
ALTER TABLE `t_notificaciones`
  ADD PRIMARY KEY (`Id_Notifica`);

--
-- Indices de la tabla `t_notificaciones_push`
--
ALTER TABLE `t_notificaciones_push`
  ADD PRIMARY KEY (`Id_Not_Push`);

--
-- Indices de la tabla `t_orden_compra_insumos`
--
ALTER TABLE `t_orden_compra_insumos`
  ADD PRIMARY KEY (`Id_Orden_Compra`);

--
-- Indices de la tabla `t_pedido`
--
ALTER TABLE `t_pedido`
  ADD PRIMARY KEY (`Id_Pedido`),
  ADD KEY `indexpedidousuario` (`Pedido_Id_Usuario`),
  ADD KEY `indexpedidotienda` (`Tienda_Id_Tienda`),
  ADD KEY `Fk_Cliente_id_cliente` (`Cliente_Id_Cliente`);

--
-- Indices de la tabla `t_plansepare`
--
ALTER TABLE `t_plansepare`
  ADD PRIMARY KEY (`Id_Venta`);

--
-- Indices de la tabla `t_proveedores`
--
ALTER TABLE `t_proveedores`
  ADD PRIMARY KEY (`Id_Proveedor`);

--
-- Indices de la tabla `t_referencias`
--
ALTER TABLE `t_referencias`
  ADD PRIMARY KEY (`Id_Referencia`),
  ADD UNIQUE KEY `indeximagen` (`Img_Referencia`(1000)),
  ADD KEY `CodigoRef` (`Cod_Referencia`),
  ADD KEY `indexreferecategoria` (`Categoria_Id_Categoria_Prod`),
  ADD KEY `indexreferesubcategoria` (`SubCategoria_Id_Subcategoria_Prod`),
  ADD KEY `indexreferetela` (`Tipo_Tela`);

--
-- Indices de la tabla `t_registro_caja`
--
ALTER TABLE `t_registro_caja`
  ADD PRIMARY KEY (`Id_Registro_Caja`);

--
-- Indices de la tabla `t_remisiones`
--
ALTER TABLE `t_remisiones`
  ADD PRIMARY KEY (`Id_Remision`),
  ADD KEY `indexfacturasusuario` (`Usuario_Vendedor`),
  ADD KEY `indexfacturastienda` (`Tienda_Id_Tienda`);

--
-- Indices de la tabla `t_rol_usuario`
--
ALTER TABLE `t_rol_usuario`
  ADD PRIMARY KEY (`Id_Rol`);

--
-- Indices de la tabla `t_rubros`
--
ALTER TABLE `t_rubros`
  ADD PRIMARY KEY (`Id_rubro`);

--
-- Indices de la tabla `t_salidas_cc`
--
ALTER TABLE `t_salidas_cc`
  ADD PRIMARY KEY (`Id_Venta`);

--
-- Indices de la tabla `t_salidas_genericas`
--
ALTER TABLE `t_salidas_genericas`
  ADD PRIMARY KEY (`id_salida_generica`);

--
-- Indices de la tabla `t_salidas_remisiones`
--
ALTER TABLE `t_salidas_remisiones`
  ADD PRIMARY KEY (`Id_Venta`);

--
-- Indices de la tabla `t_seguimiento_llamadas`
--
ALTER TABLE `t_seguimiento_llamadas`
  ADD PRIMARY KEY (`Id_Seg_Llamada`);

--
-- Indices de la tabla `t_separados`
--
ALTER TABLE `t_separados`
  ADD PRIMARY KEY (`Id_Separe`);

--
-- Indices de la tabla `t_solicitudes_prod`
--
ALTER TABLE `t_solicitudes_prod`
  ADD PRIMARY KEY (`Id_Solicitud_Prod`);

--
-- Indices de la tabla `t_subcategorias_insumos`
--
ALTER TABLE `t_subcategorias_insumos`
  ADD PRIMARY KEY (`Id_SubCategoria_Insumo`),
  ADD KEY `Categoria_Id_Categoria_Insumo` (`Categoria_Id_Categoria_Insumo`);

--
-- Indices de la tabla `t_subcategoria_producto`
--
ALTER TABLE `t_subcategoria_producto`
  ADD PRIMARY KEY (`Id_SubCat_Producto`);

--
-- Indices de la tabla `t_subrubros`
--
ALTER TABLE `t_subrubros`
  ADD PRIMARY KEY (`Id_subrubro`),
  ADD KEY `Rubro_id_rubro` (`Rubro_id_rubro`);

--
-- Indices de la tabla `t_tallas`
--
ALTER TABLE `t_tallas`
  ADD PRIMARY KEY (`Id_Talla`);

--
-- Indices de la tabla `t_temporal_codigos`
--
ALTER TABLE `t_temporal_codigos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_temporal_inventario`
--
ALTER TABLE `t_temporal_inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sqlcostos` (`id_ref`),
  ADD KEY `indexdespachostipo` (`cliente`),
  ADD KEY `indexdespachostalla` (`talla_id`),
  ADD KEY `indexdespachosusuario` (`id_user`);

--
-- Indices de la tabla `t_temporal_inventario_despachos`
--
ALTER TABLE `t_temporal_inventario_despachos`
  ADD PRIMARY KEY (`id_despacho`);

--
-- Indices de la tabla `t_temporal_ref`
--
ALTER TABLE `t_temporal_ref`
  ADD PRIMARY KEY (`Id_Temporal`);

--
-- Indices de la tabla `t_temporal_ref2`
--
ALTER TABLE `t_temporal_ref2`
  ADD PRIMARY KEY (`Id_Temporal`);

--
-- Indices de la tabla `t_temporal_sol`
--
ALTER TABLE `t_temporal_sol`
  ADD PRIMARY KEY (`Id_Temporal_Sol`),
  ADD KEY `indextemporalsolref` (`Referencia_Id_Referencia`),
  ADD KEY `indextemporalsoltienda` (`Tienda_Id_Tienda`),
  ADD KEY `indextemporalsolestado` (`Estado_Solicitud_Cliente`),
  ADD KEY `indextemporalsolusuario` (`Vendedor_Id_Usuario`),
  ADD KEY `indextemporalsoltallas` (`Talla_Solicitada`);

--
-- Indices de la tabla `t_temporal_traslados`
--
ALTER TABLE `t_temporal_traslados`
  ADD PRIMARY KEY (`Id_Temporal_Sol`);

--
-- Indices de la tabla `t_tiendas`
--
ALTER TABLE `t_tiendas`
  ADD PRIMARY KEY (`Id_Tienda`);

--
-- Indices de la tabla `t_traslados`
--
ALTER TABLE `t_traslados`
  ADD UNIQUE KEY `id_traslado` (`id_traslado`);

--
-- Indices de la tabla `t_traslados_detalle`
--
ALTER TABLE `t_traslados_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_trazabilidad_prod`
--
ALTER TABLE `t_trazabilidad_prod`
  ADD PRIMARY KEY (`Id_Trazabilidad_Prod`);

--
-- Indices de la tabla `t_trazabilidad_prod_cl`
--
ALTER TABLE `t_trazabilidad_prod_cl`
  ADD PRIMARY KEY (`Id_Trazabilidad_Prod`);

--
-- Indices de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD KEY `Rol_id_Rol` (`Rol_id_Rol`),
  ADD KEY `Estado_id_estado_usuario` (`Estado_id_estado_usuario`);

--
-- Indices de la tabla `t_usuarios_activos`
--
ALTER TABLE `t_usuarios_activos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_usuarios_log`
--
ALTER TABLE `t_usuarios_log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_usuarios_tienda`
--
ALTER TABLE `t_usuarios_tienda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t_ventas`
--
ALTER TABLE `t_ventas`
  ADD PRIMARY KEY (`Id_Venta`),
  ADD KEY `indexventasref` (`Referencia_Id_Referencia`);

--
-- Indices de la tabla `t_ventas_27022023`
--
ALTER TABLE `t_ventas_27022023`
  ADD PRIMARY KEY (`Id_Venta`),
  ADD KEY `indexventasref` (`Referencia_Id_Referencia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ingreso_temporal_usuario`
--
ALTER TABLE `ingreso_temporal_usuario`
  MODIFY `Id_Ingreso_Tempora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_actualizacion_ordenes`
--
ALTER TABLE `t_actualizacion_ordenes`
  MODIFY `Id_Actualizacion_Orden` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_ajustes_inventario_ref`
--
ALTER TABLE `t_ajustes_inventario_ref`
  MODIFY `Id_Registro_Ajuste_Ref` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_ajustes_inventario_telas`
--
ALTER TABLE `t_ajustes_inventario_telas`
  MODIFY `Id_Registro_Ajuste` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_areas`
--
ALTER TABLE `t_areas`
  MODIFY `Id_Area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `t_atributos_categoria_ins`
--
ALTER TABLE `t_atributos_categoria_ins`
  MODIFY `Id_Atributo_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `t_bodegas`
--
ALTER TABLE `t_bodegas`
  MODIFY `Id_Bodega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `t_bonos`
--
ALTER TABLE `t_bonos`
  MODIFY `Id_bono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_cartera`
--
ALTER TABLE `t_cartera`
  MODIFY `Id_Cartera` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_categorias_insumos`
--
ALTER TABLE `t_categorias_insumos`
  MODIFY `Id_Categoria_Insumo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_categoria_producto`
--
ALTER TABLE `t_categoria_producto`
  MODIFY `Id_Cat_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `t_causales`
--
ALTER TABLE `t_causales`
  MODIFY `id_causal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_cc`
--
ALTER TABLE `t_cc`
  MODIFY `Id_Remision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_ciudades`
--
ALTER TABLE `t_ciudades`
  MODIFY `Id_Ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1123;

--
-- AUTO_INCREMENT de la tabla `t_clientes`
--
ALTER TABLE `t_clientes`
  MODIFY `Id_Cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_colecciones`
--
ALTER TABLE `t_colecciones`
  MODIFY `Id_Coleccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_colores`
--
ALTER TABLE `t_colores`
  MODIFY `Id_Color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `t_colores_ref`
--
ALTER TABLE `t_colores_ref`
  MODIFY `Id_Color_Ref` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_comentarios_produccion`
--
ALTER TABLE `t_comentarios_produccion`
  MODIFY `Id_Comentario_Produccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_comentarios_produccion_cliente`
--
ALTER TABLE `t_comentarios_produccion_cliente`
  MODIFY `Id_Comentario_Produccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_config_tienda`
--
ALTER TABLE `t_config_tienda`
  MODIFY `Id_Config_Tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `t_contacto_usuario`
--
ALTER TABLE `t_contacto_usuario`
  MODIFY `Id_Contacto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_detalle_despachos`
--
ALTER TABLE `t_detalle_despachos`
  MODIFY `Id_Detalle_Despacho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_devoluciones`
--
ALTER TABLE `t_devoluciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_devoluciones_detalle`
--
ALTER TABLE `t_devoluciones_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_devolucion_dinero`
--
ALTER TABLE `t_devolucion_dinero`
  MODIFY `id_devolucion_dinero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_devolucion_ordenes`
--
ALTER TABLE `t_devolucion_ordenes`
  MODIFY `Id_Devolucion_Orden` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_estado_llamadas`
--
ALTER TABLE `t_estado_llamadas`
  MODIFY `Id_Estado_Llamada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `t_estado_pedidos`
--
ALTER TABLE `t_estado_pedidos`
  MODIFY `Id_Estado_Pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `t_estado_usuario`
--
ALTER TABLE `t_estado_usuario`
  MODIFY `Id_Estado_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `t_facturas`
--
ALTER TABLE `t_facturas`
  MODIFY `Id_Factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_frecuencia_clientes`
--
ALTER TABLE `t_frecuencia_clientes`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_gastos`
--
ALTER TABLE `t_gastos`
  MODIFY `Id_gasto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_ingresos`
--
ALTER TABLE `t_ingresos`
  MODIFY `Id_Ingreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_ingreso_dinero`
--
ALTER TABLE `t_ingreso_dinero`
  MODIFY `id_ingresodinero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_insumos`
--
ALTER TABLE `t_insumos`
  MODIFY `Id_Insumo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_insumos_ref`
--
ALTER TABLE `t_insumos_ref`
  MODIFY `Id_Insumo_Ref` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario`
--
ALTER TABLE `t_inventario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventarionueva`
--
ALTER TABLE `t_inventarionueva`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_bar`
--
ALTER TABLE `t_inventario_bar`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_mont`
--
ALTER TABLE `t_inventario_mont`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_nov`
--
ALTER TABLE `t_inventario_nov`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_ref`
--
ALTER TABLE `t_inventario_ref`
  MODIFY `Id_Registro_Inv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_ref_entradas_despachos`
--
ALTER TABLE `t_inventario_ref_entradas_despachos`
  MODIFY `Id_Registro_Inv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_ref_entradas_devoluciones`
--
ALTER TABLE `t_inventario_ref_entradas_devoluciones`
  MODIFY `Id_Registro_Inv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_ref_entradas_traslados`
--
ALTER TABLE `t_inventario_ref_entradas_traslados`
  MODIFY `Id_Registro_Inv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_ref_inicial`
--
ALTER TABLE `t_inventario_ref_inicial`
  MODIFY `Id_Registro_Inv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_ref_salidas_traslados`
--
ALTER TABLE `t_inventario_ref_salidas_traslados`
  MODIFY `Id_Registro_Inv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_ref_ventas`
--
ALTER TABLE `t_inventario_ref_ventas`
  MODIFY `Id_Registro_Inv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_segura`
--
ALTER TABLE `t_inventario_segura`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_separe`
--
ALTER TABLE `t_inventario_separe`
  MODIFY `Id_Registro_Inv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_telas`
--
ALTER TABLE `t_inventario_telas`
  MODIFY `Id_inventario_tela` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_telas_res`
--
ALTER TABLE `t_inventario_telas_res`
  MODIFY `Id_inventario_tela` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_llamadas`
--
ALTER TABLE `t_llamadas`
  MODIFY `Id_Llamada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_medios_pago`
--
ALTER TABLE `t_medios_pago`
  MODIFY `Id_Medio_Pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_mov_cuentas`
--
ALTER TABLE `t_mov_cuentas`
  MODIFY `Id_Mov_Cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_mov_insumos`
--
ALTER TABLE `t_mov_insumos`
  MODIFY `Id_Mov_Insumos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_notificaciones`
--
ALTER TABLE `t_notificaciones`
  MODIFY `Id_Notifica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_notificaciones_push`
--
ALTER TABLE `t_notificaciones_push`
  MODIFY `Id_Not_Push` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_orden_compra_insumos`
--
ALTER TABLE `t_orden_compra_insumos`
  MODIFY `Id_Orden_Compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_pedido`
--
ALTER TABLE `t_pedido`
  MODIFY `Id_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_plansepare`
--
ALTER TABLE `t_plansepare`
  MODIFY `Id_Venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_proveedores`
--
ALTER TABLE `t_proveedores`
  MODIFY `Id_Proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_referencias`
--
ALTER TABLE `t_referencias`
  MODIFY `Id_Referencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_registro_caja`
--
ALTER TABLE `t_registro_caja`
  MODIFY `Id_Registro_Caja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_remisiones`
--
ALTER TABLE `t_remisiones`
  MODIFY `Id_Remision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_rol_usuario`
--
ALTER TABLE `t_rol_usuario`
  MODIFY `Id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `t_rubros`
--
ALTER TABLE `t_rubros`
  MODIFY `Id_rubro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `t_salidas_cc`
--
ALTER TABLE `t_salidas_cc`
  MODIFY `Id_Venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_salidas_genericas`
--
ALTER TABLE `t_salidas_genericas`
  MODIFY `id_salida_generica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_salidas_remisiones`
--
ALTER TABLE `t_salidas_remisiones`
  MODIFY `Id_Venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_seguimiento_llamadas`
--
ALTER TABLE `t_seguimiento_llamadas`
  MODIFY `Id_Seg_Llamada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_separados`
--
ALTER TABLE `t_separados`
  MODIFY `Id_Separe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_solicitudes_prod`
--
ALTER TABLE `t_solicitudes_prod`
  MODIFY `Id_Solicitud_Prod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_subcategorias_insumos`
--
ALTER TABLE `t_subcategorias_insumos`
  MODIFY `Id_SubCategoria_Insumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT de la tabla `t_subcategoria_producto`
--
ALTER TABLE `t_subcategoria_producto`
  MODIFY `Id_SubCat_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `t_subrubros`
--
ALTER TABLE `t_subrubros`
  MODIFY `Id_subrubro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `t_tallas`
--
ALTER TABLE `t_tallas`
  MODIFY `Id_Talla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `t_temporal_codigos`
--
ALTER TABLE `t_temporal_codigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_temporal_inventario`
--
ALTER TABLE `t_temporal_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_temporal_inventario_despachos`
--
ALTER TABLE `t_temporal_inventario_despachos`
  MODIFY `id_despacho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_temporal_ref`
--
ALTER TABLE `t_temporal_ref`
  MODIFY `Id_Temporal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_temporal_ref2`
--
ALTER TABLE `t_temporal_ref2`
  MODIFY `Id_Temporal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_temporal_sol`
--
ALTER TABLE `t_temporal_sol`
  MODIFY `Id_Temporal_Sol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_temporal_traslados`
--
ALTER TABLE `t_temporal_traslados`
  MODIFY `Id_Temporal_Sol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_tiendas`
--
ALTER TABLE `t_tiendas`
  MODIFY `Id_Tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `t_traslados`
--
ALTER TABLE `t_traslados`
  MODIFY `id_traslado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_traslados_detalle`
--
ALTER TABLE `t_traslados_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_trazabilidad_prod`
--
ALTER TABLE `t_trazabilidad_prod`
  MODIFY `Id_Trazabilidad_Prod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_trazabilidad_prod_cl`
--
ALTER TABLE `t_trazabilidad_prod_cl`
  MODIFY `Id_Trazabilidad_Prod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `t_usuarios_activos`
--
ALTER TABLE `t_usuarios_activos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `t_usuarios_log`
--
ALTER TABLE `t_usuarios_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `t_usuarios_tienda`
--
ALTER TABLE `t_usuarios_tienda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_ventas`
--
ALTER TABLE `t_ventas`
  MODIFY `Id_Venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_ventas_27022023`
--
ALTER TABLE `t_ventas_27022023`
  MODIFY `Id_Venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_config_tienda`
--
ALTER TABLE `t_config_tienda`
  ADD CONSTRAINT `t_config_tienda_ibfk_1` FOREIGN KEY (`Tienda_Id_Tienda`) REFERENCES `t_tiendas` (`Id_Tienda`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
