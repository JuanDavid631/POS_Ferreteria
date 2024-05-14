-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2024 a las 08:55:26
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
-- Base de datos: `market-pos`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `pcr_ListarCategorias` ()   BEGIN
	SELECT  id_categoria, nombre_categoria, aplica_peso as medida, date(fecha_creacion_categoria) as fecha_creacion_categoria, fecha_actualizacion_categoria, '' as opciones
		FROM categorias c ORDER BY id_categoria DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_eliminar_venta` (IN `p_nro_boleta` VARCHAR(8))   BEGIN

DECLARE v_codigo VARCHAR(20);
DECLARE v_cantidad FLOAT;
DECLARE done INT DEFAULT FALSE;
DECLARE cursor_i CURSOR FOR 
SELECT codigo_producto,cantidad 
FROM venta_detalle 
WHERE CAST(nro_boleta AS CHAR CHARACTER SET utf8)  = CAST(p_nro_boleta AS CHAR CHARACTER SET utf8) ;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

OPEN cursor_i;
read_loop: LOOP
FETCH cursor_i INTO v_codigo, v_cantidad;

	IF done THEN
	  LEAVE read_loop;
	END IF;
    
    UPDATE PRODUCTOS 
       SET stock_producto = stock_producto + v_cantidad
    WHERE CAST(codigo_producto AS CHAR CHARACTER SET utf8) = CAST(v_codigo AS CHAR CHARACTER SET utf8);

END LOOP;
CLOSE cursor_i;

DELETE FROM venta_detalle WHERE CAST(nro_boleta AS CHAR CHARACTER SET utf8) = CAST(p_nro_boleta AS CHAR CHARACTER SET utf8) ;
DELETE FROM venta_cabecera WHERE CAST(nro_boleta AS CHAR CHARACTER SET utf8)  = CAST(p_nro_boleta AS CHAR CHARACTER SET utf8) ;

SELECT 'Se eliminó correctamente la venta';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductos` ()   BEGIN
	SELECT '' AS detalles, p.id, p.codigo_producto, c.id_categoria, c.nombre_categoria, p.descripcion_producto, 
		CONCAT('$ ', ROUND(p.precio_compra_producto, 0)) AS precio_compra,
		CONCAT('$ ', ROUND(p.precio_venta_producto, 0)) AS precio_venta,
		CONCAT('$ ', ROUND(p.utilidad, 0)) AS utilidad,
		CASE WHEN c.aplica_peso = 1 THEN CONCAT(p.stock_producto) ELSE CONCAT(p.stock_producto) END AS stock,
		CASE WHEN c.aplica_peso = 1 THEN CONCAT(p.minimo_stock_producto) ELSE CONCAT(p.minimo_stock_producto) END AS minimo_stock,
		CASE WHEN c.aplica_peso = 1 THEN CONCAT(p.ventas_producto, ' Kg(s)') ELSE CONCAT(p.ventas_producto, ' Und(s)') END AS ventas,
		p.fecha_creacion_producto,
		p.fecha_actualizacion_producto,
		'' AS opciones
		FROM productos p INNER JOIN categorias c ON p.id_categoria_producto = c.id_categoria ORDER BY p.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductosMasVendidos` ()   BEGIN
	SELECT p.codigo_producto, p.descripcion_producto, CONCAT(SUM(vd.cantidad), ' Und(s)') AS cantidad, SUM(ROUND(vd.total_venta, 0)) AS total_venta 
		FROM venta_detalle vd INNER JOIN productos p ON vd.codigo_producto = p.codigo_producto
		GROUP BY p.codigo_producto, p.descripcion_producto
		ORDER BY SUM(ROUND(vd.total_venta, 2)) DESC LIMIT 15;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductosPocoStock` ()   BEGIN
	SELECT p.codigo_producto, p.descripcion_producto, CONCAT(p.stock_producto, ' Und(s)') AS stock_producto, CONCAT(p.minimo_stock_producto, ' Und(s)') AS minimo_stock_producto FROM productos p
  WHERE p.stock_producto <= p.minimo_stock_producto ORDER BY p.stock_producto ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductosVentas` ()   BEGIN
	SELECT CONCAT(codigo_producto , ' - ' , c.nombre_categoria, ' - ', descripcion_producto, ' - $ ' , p.precio_venta_producto)  
		AS descripcion_producto FROM productos p INNER JOIN categorias c ON p.id_categoria_producto = c.id_categoria;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_modulosPerfiles` ()   BEGIN
	SELECT p.id_perfil, p.descripcion, p.estado, DATE(p.fecha_creacion) AS fecha_creacion, p.fecha_actualizacion, ' ' AS opciones
		FROM perfiles p ORDER BY p.id_perfil;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ObtenerDatosDashboard` ()   BEGIN
	DECLARE totalProductos int;
	DECLARE totalCompras float;
	DECLARE totalVentas float;
	DECLARE ganancias float;
	DECLARE productosPocoStock int;
	DECLARE ventasHoy float;

	SET totalProductos = (SELECT COUNT(*) FROM productos p);
	SET totalCompras = (SELECT SUM(p.precio_compra_producto * p.stock_producto) FROM productos p);
	SET totalVentas = (SELECT SUM(vc.total_venta) FROM venta_cabecera vc);
	SET ganancias = (SELECT SUM(vd.total_venta) - SUM(p.precio_compra_producto * vd.cantidad) FROM venta_detalle vd
					INNER JOIN productos p ON vd.codigo_producto = p.codigo_producto);
	SET productosPocoStock = (SELECT COUNT(1) FROM productos p WHERE p.stock_producto <= p.minimo_stock_producto);
	SET ventasHoy = (SELECT SUM(vc.total_venta) FROM venta_cabecera vc WHERE vc.fecha_venta = CURDATE());

	SELECT
		IFNULL(totalProductos, 0) AS totalProductos,
		IFNULL(ROUND(totalCompras, 2), 0) AS totalCompras,
		IFNULL(ROUND(totalVentas, 2), 0) AS totalVentas,
		IFNULL(ROUND(ganancias, 2), 0) AS ganancias,
		IFNULL(productosPocoStock, 0) AS productosPocoStock,
		IFNULL(ROUND(ventasHoy, 2), 0) AS ventasHoy;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_obtenerModulos` ()   BEGIN
	SELECT id AS id, (CASE WHEN (padre_id IS NULL OR padre_id = 0) THEN '#' ELSE padre_id END) AS parent, modulo AS text, vista
  FROM modulos m ORDER BY m.orden;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_obtenerNroBoleta` ()   BEGIN
	SELECT serie_boleta, IFNULL(LPAD(MAX(c.nro_correlativo_venta) + 1, 8, '0'), '00000001') nro_venta
  FROM empresa c;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ObtenerVentasMesActual` ()   BEGIN
	SELECT date(vc.fecha_venta) AS fecha_venta, SUM(ROUND(vc.total_venta, 0)) AS total_venta 
		FROM venta_cabecera vc WHERE date(vc.fecha_venta) >= date(last_day(now() - INTERVAL 1 month) + INTERVAL 1 day)
		AND date(vc.fecha_venta) <= last_day(date(CURRENT_DATE)) GROUP BY date(vc.fecha_venta);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_subMenuUsuario` (IN `idMenu` INT)   BEGIN
	SELECT m.id, m.modulo, m.icon_menu, m.vista
		FROM modulos m WHERE m.padre_id = idMenu
		ORDER BY m.id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` text DEFAULT NULL,
  `aplica_peso` int(11) NOT NULL,
  `fecha_creacion_categoria` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion_categoria` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `aplica_peso`, `fecha_creacion_categoria`, `fecha_actualizacion_categoria`) VALUES
(1, 'Liquidos', 1, '2024-04-27 10:00:00', '2024-04-27'),
(402, 'Pisos', 0, '2024-04-24 02:10:46', '2024-04-24'),
(403, 'Griferia', 0, '2024-04-24 02:10:46', '2024-04-24'),
(404, 'Accesorios', 0, '2024-04-24 02:10:46', '2024-04-24'),
(405, 'Iluminacion', 0, '2024-04-24 02:10:46', '2024-04-24'),
(406, 'Herramientas', 0, '2024-04-24 02:10:46', '2024-04-24'),
(407, 'Techos', 0, '2024-04-24 02:10:46', '2024-04-24'),
(408, 'Puertas', 0, '2024-04-24 02:10:46', '2024-04-24'),
(409, 'Ventanas', 0, '2024-04-24 02:10:46', '2024-04-24'),
(410, 'Maderas', 0, '2024-04-24 02:10:46', '2024-04-24'),
(411, 'Pilas', 0, '2024-04-24 02:10:46', '2024-04-24'),
(412, 'Multimedia', 0, '2024-04-24 02:10:46', '2024-04-24'),
(413, 'Sanitarios', 0, '2024-04-24 02:10:46', '2024-04-24'),
(414, 'Muebles_baño', 0, '2024-04-24 02:10:46', '2024-04-24'),
(415, 'Mamparas', 0, '2024-04-24 02:10:46', '2024-04-24'),
(416, 'Herramientas_Jardin', 0, '2024-04-24 02:10:46', '2024-04-24'),
(417, 'Cobertizos', 0, '2024-04-24 02:10:46', '2024-04-24'),
(418, 'Cerrajeria', 0, '2024-04-24 02:10:46', '2024-04-24'),
(419, 'Ruedas', 0, '2024-04-24 02:10:46', '2024-04-24'),
(420, 'Pintura', 0, '2024-04-24 02:10:46', '2024-04-24'),
(421, 'Pisos', 0, '2024-04-24 02:18:19', '2024-04-24'),
(422, 'Griferia', 0, '2024-04-24 02:18:19', '2024-04-24'),
(423, 'Accesorios', 0, '2024-04-24 02:18:19', '2024-04-24'),
(424, 'Iluminacion', 0, '2024-04-24 02:18:19', '2024-04-24'),
(425, 'Herramientas', 0, '2024-04-24 02:18:19', '2024-04-24'),
(426, 'Techos', 0, '2024-04-24 02:18:19', '2024-04-24'),
(427, 'Puertas', 0, '2024-04-24 02:18:19', '2024-04-24'),
(428, 'Ventanas', 0, '2024-04-24 02:18:19', '2024-04-24'),
(429, 'Maderas', 1, '2024-04-28 17:57:47', '2024-04-28'),
(430, 'Pilas', 0, '2024-04-24 02:18:19', '2024-04-24'),
(431, 'Multimedia', 0, '2024-04-24 02:18:19', '2024-04-24'),
(432, 'Sanitarios', 0, '2024-04-24 02:18:19', '2024-04-24'),
(433, 'Muebles_baño', 0, '2024-04-24 02:18:19', '2024-04-24'),
(434, 'Mamparas', 0, '2024-04-24 02:18:19', '2024-04-24'),
(435, 'Herramientas_Jardin', 0, '2024-04-24 02:18:19', '2024-04-24'),
(436, 'Cobertizos', 0, '2024-04-24 02:18:19', '2024-04-24'),
(437, 'Cerrajeria', 0, '2024-04-24 02:18:19', '2024-04-24'),
(438, 'Ruedas', 0, '2024-04-24 02:18:19', '2024-04-24'),
(439, 'Pintura', 1, '2024-04-28 17:57:32', '2024-04-28'),
(440, 'Pisos', 0, '2024-04-24 05:09:13', '2024-04-24'),
(441, 'Griferia', 0, '2024-04-24 05:09:13', '2024-04-24'),
(442, 'Accesorios', 0, '2024-04-24 05:09:13', '2024-04-24'),
(443, 'Iluminacion', 0, '2024-04-28 17:57:24', '2024-04-28'),
(444, 'Herramientas', 0, '2024-04-24 05:09:13', '2024-04-24'),
(446, 'Puertas', 0, '2024-04-24 05:09:13', '2024-04-24'),
(448, 'Maderas', 0, '2024-04-24 05:09:13', '2024-04-24'),
(449, 'Pilas', 0, '2024-04-24 05:09:13', '2024-04-24'),
(450, 'Multimedia', 0, '2024-04-24 05:09:13', '2024-04-24'),
(451, 'Sanitarios', 0, '2024-04-24 05:09:14', '2024-04-24'),
(452, 'Muebles_baño', 0, '2024-04-24 05:09:14', '2024-04-24'),
(453, 'Mamparas', 0, '2024-04-24 05:09:14', '2024-04-24'),
(456, 'Cerrajeria', 0, '2024-04-24 05:09:14', '2024-04-24'),
(460, 'Ruedas Muebles', 0, '2024-04-28 07:15:46', '2024-04-28'),
(461, 'Puertas', 0, '2024-04-28 07:28:36', '2024-04-28'),
(462, 'Luces de Neon', 0, '2024-04-30 01:03:53', '2024-04-30'),
(463, 'Liquidos infamables', 1, '2024-04-30 01:10:20', '2024-04-30'),
(482, 'Liquidos infamables', 1, '2024-04-30 01:11:02', '2024-04-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `razon_social` text NOT NULL,
  `ruc` bigint(20) NOT NULL,
  `direccion` text NOT NULL,
  `marca` text NOT NULL,
  `serie_boleta` varchar(4) NOT NULL,
  `nro_correlativo_venta` varchar(8) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `razon_social`, `ruc`, `direccion`, `marca`, `serie_boleta`, `nro_correlativo_venta`, `email`) VALUES
(1, 'Corona', 1014300829, 'Calle 80 #17 - 32, Barrio Polo', 'Corona Pisos', '0002', '00000037', 'ventas_pisos@corona.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `modulo` varchar(45) DEFAULT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `vista` varchar(45) DEFAULT NULL,
  `icon_menu` varchar(45) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `modulo`, `padre_id`, `vista`, `icon_menu`, `orden`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Tablero Principal', NULL, 'dashboard.php', 'fas fa-tachometer-alt', 0, NULL, NULL),
(2, 'Ventas', NULL, '', 'fas fa-store-alt', 1, NULL, NULL),
(3, 'Punto de Venta', 2, 'ventas.php', 'far fa-circle', 2, NULL, NULL),
(4, 'Administrar Ventas', 2, 'administrar_ventas.php', 'far fa-circle', 3, NULL, NULL),
(5, 'Productos', NULL, NULL, 'fas fa-cart-plus', 4, NULL, NULL),
(6, 'Inventario', 5, 'productos.php', 'far fa-circle', 5, NULL, NULL),
(7, 'Carga Masiva', 5, 'cargaMasiva_Productos.php', 'far fa-circle', 6, NULL, NULL),
(8, 'Categorías', 5, 'categorias.php', 'far fa-circle', 7, NULL, NULL),
(9, 'Compras', NULL, 'compras.php', 'fas fa-dolly', 9, NULL, NULL),
(10, 'Reportes', NULL, 'reportes.php', 'fas fa-chart-line', 10, NULL, NULL),
(11, 'Configuración', NULL, 'configuracion.php', 'fas fa-cogs', 11, NULL, NULL),
(12, 'Usuarios', NULL, 'usuarios.php', 'fas fa-users', 12, NULL, NULL),
(13, 'Modulos y Perfiles', NULL, 'modulos_perfiles.php', 'fas fa-tablet-alt', 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `descripcion`, `estado`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Administrador', 1, '2024-05-02 04:42:46', '2024-05-02 23:42:59'),
(2, 'Vendedor', 1, '2024-05-03 04:42:54', '2024-05-02 23:43:03'),
(3, 'Contabilidad', 1, '2024-05-03 06:26:01', '2024-05-03 01:26:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_modulo`
--

CREATE TABLE `perfil_modulo` (
  `idperfil_modulo` int(11) NOT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `vista_inicio` tinyint(4) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `perfil_modulo`
--

INSERT INTO `perfil_modulo` (`idperfil_modulo`, `id_perfil`, `id_modulo`, `vista_inicio`, `estado`) VALUES
(13, 1, 13, NULL, 1),
(42, 3, 1, 1, 1),
(62, 1, 1, 1, 1),
(63, 1, 3, 0, 1),
(64, 1, 2, 0, 1),
(65, 1, 4, 0, 1),
(66, 1, 6, 0, 1),
(67, 1, 5, 0, 1),
(68, 1, 7, 0, 1),
(69, 1, 8, 0, 1),
(70, 1, 9, 0, 1),
(71, 1, 11, 0, 1),
(72, 1, 12, 0, 1),
(73, 1, 10, 0, 1),
(74, 2, 3, 0, 1),
(75, 2, 2, 0, 1),
(76, 2, 6, 1, 1),
(77, 2, 5, 0, 1),
(78, 2, 4, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo_producto` bigint(13) NOT NULL,
  `id_categoria_producto` int(11) DEFAULT NULL,
  `descripcion_producto` text DEFAULT NULL,
  `precio_compra_producto` float NOT NULL,
  `precio_venta_producto` float NOT NULL,
  `utilidad` float NOT NULL,
  `stock_producto` float DEFAULT NULL,
  `minimo_stock_producto` float DEFAULT NULL,
  `ventas_producto` float DEFAULT NULL,
  `fecha_creacion_producto` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion_producto` date DEFAULT NULL,
  `precio_mayor_producto` float DEFAULT NULL,
  `precio_oferta_producto` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo_producto`, `id_categoria_producto`, `descripcion_producto`, `precio_compra_producto`, `precio_venta_producto`, `utilidad`, `stock_producto`, `minimo_stock_producto`, `ventas_producto`, `fecha_creacion_producto`, `fecha_actualizacion_producto`, `precio_mayor_producto`, `precio_oferta_producto`) VALUES
(522, 333000, 411, 'Pilas AAA', 3400, 5000, 0, 34, 11, 0, '2024-04-30 01:17:16', '2024-04-24', 3000, 2500),
(523, 222999, 411, 'Pilas A', 5050, 8900, 0, 23, 6, 0, '2024-04-30 01:17:16', '2024-04-24', 6900, 6400),
(529, 1370555, 418, 'Llaves de seguridad', 22000, 35000, 0, 20, 5, 0, '2024-04-30 01:17:16', '2024-04-24', 33000, 32500),
(530, 1638267, 418, 'Manijas de puertas', 5000, 9400, 0, 20, 3, 0, '2024-04-30 01:17:16', '2024-04-24', 7400, 6900),
(531, 1905978, 420, 'Pintura en agua', 68000, 89000, 0, 12, 2, 0, '2024-04-30 01:17:16', '2024-04-24', 87000, 86500),
(534, 2709114, 406, 'Destornilladores', 7000, 12000, 5000, 8, 10, 0, '2024-04-30 01:17:16', '2024-04-24', 10000, 9500),
(535, 1905978, 420, 'Pintura en agua', 68000, 89000, 0, 12, 2, 0, '2024-04-30 01:17:16', '2024-04-24', 87000, 86500),
(538, 2709114, 406, 'Destornilladores', 7000, 12000, 5000, 8, 10, 0, '2024-04-30 01:17:16', '2024-04-24', 10000, 9500),
(545, 333000, 411, 'Pilas AAA', 3400, 5000, 0, 34, 11, 0, '2024-04-30 01:17:16', '2024-04-24', 3000, 2500),
(546, 222999, 411, 'Pilas A', 5050, 8900, 0, 23, 6, 0, '2024-04-30 01:17:16', '2024-04-24', 6900, 6400),
(552, 1370555, 418, 'Llaves de seguridad', 22000, 35000, 0, 20, 5, 0, '2024-04-30 01:17:16', '2024-04-24', 33000, 32500),
(553, 1638267, 418, 'Manijas de puertas', 5000, 9400, 0, 20, 3, 0, '2024-04-30 01:17:16', '2024-04-24', 7400, 6900),
(554, 1905978, 420, 'Pintura en agua', 68000, 89000, 0, 12, 2, 0, '2024-04-30 01:17:16', '2024-04-24', 87000, 86500),
(557, 2709114, 406, 'Destornilladores', 7000, 12000, 5000, 8, 10, 0, '2024-04-30 01:17:16', '2024-04-24', 10000, 9500),
(558, 1905978, 420, 'Pintura en agua', 68000, 89000, 0, 12, 2, 0, '2024-04-30 01:17:16', '2024-04-24', 87000, 86500),
(561, 2709114, 406, 'Destornilladores', 7000, 12000, 5000, 8, 10, 0, '2024-04-30 01:17:16', '2024-04-24', 10000, 9500),
(568, 333000, 411, 'Pilas AAA', 3400, 5000, 0, 34, 11, 0, '2024-04-30 01:17:16', '2024-04-24', 3000, 2500),
(569, 222999, 411, 'Pilas A', 5050, 8900, 0, 23, 6, 0, '2024-04-30 01:17:16', '2024-04-24', 6900, 6400),
(575, 1370555, 418, 'Llaves de seguridad', 22000, 35000, 0, 20, 5, 0, '2024-04-30 01:17:16', '2024-04-24', 33000, 32500),
(576, 1638267, 418, 'Manijas de puertas', 5000, 9400, 0, 20, 3, 0, '2024-04-30 01:17:16', '2024-04-24', 7400, 6900),
(577, 1905978, 420, 'Pintura en agua', 68000, 89000, 0, 12, 2, 0, '2024-04-30 01:17:16', '2024-04-24', 87000, 86500),
(580, 2709114, 406, 'Destornilladores', 7000, 12000, 5000, 8, 10, 0, '2024-04-30 01:17:16', '2024-04-24', 10000, 9500),
(581, 1905978, 420, 'Pintura en agua', 68000, 89000, 0, 12, 2, 0, '2024-04-30 01:17:16', '2024-04-24', 87000, 86500),
(584, 2709114, 406, 'Destornilladores', 7000, 12000, 5000, 8, 10, 0, '2024-04-30 01:17:16', '2024-04-24', 10000, 9500),
(596, 101010, 405, 'Luces Techo Led', 12000, 24000, 12000, 28, 2, 30, '2024-05-02 23:31:26', '2024-04-28', 22000, 21500),
(597, 20202, 1, 'Varsol', 2000, 5000, 3000, 41, 8, 53, '2024-05-02 22:42:59', '2024-04-28', 3000, 2500),
(599, 303030, 456, 'Llaves de Seguridad', 20000, 45000, 25000, 7, 5, 16, '2024-04-30 01:17:16', '2024-04-30', 43000, 42500),
(623, 40404040, 463, 'Liquido Tiner', 3000, 5700, 0, 9, 3, 3, '2024-05-02 23:31:26', '2024-04-30', 3700, 3200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) DEFAULT NULL,
  `apellido_usuario` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `clave` text DEFAULT NULL,
  `id_perfil_usuario` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `usuario`, `clave`, `id_perfil_usuario`, `estado`) VALUES
(1, 'Juan', 'Montoya', 'jmontoya', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', 1, 1),
(2, 'Laura', 'Fernandez', 'lfernandez', '$2a$07$azybxcags23425sdg23sdeanQZqjaf6Birm2NvcYTNtJw24CsO5uq', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_cabecera`
--

CREATE TABLE `venta_cabecera` (
  `id_boleta` int(11) NOT NULL,
  `nro_boleta` varchar(8) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `subtotal` float NOT NULL,
  `igv` float NOT NULL,
  `total_venta` float DEFAULT NULL,
  `fecha_venta` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `venta_cabecera`
--

INSERT INTO `venta_cabecera` (`id_boleta`, `nro_boleta`, `descripcion`, `subtotal`, `igv`, `total_venta`, `fecha_venta`) VALUES
(46, '00000014', 'Venta realizada con Nro Boleta: 00000014', 0, 0, 120000, '2024-04-18 21:54:10'),
(47, '00000015', 'Venta realizada con Nro Boleta: 00000015', 0, 0, 240500, '2024-04-18 22:34:17'),
(48, '00000016', 'Venta realizada con Nro Boleta: 00000016', 0, 0, 166000, '2024-04-18 22:34:51'),
(49, '00000016', 'Venta realizada con Nro Boleta: 00000017', 0, 0, 188900, '2024-04-18 23:01:17'),
(50, '00000018', 'Venta realizada con Nro Boleta: 00000018', 0, 0, 400900, '2024-04-27 05:47:52'),
(51, '00000019', 'Venta realizada con Nro Boleta: 00000019', 0, 0, 21500, '2024-04-27 05:47:52'),
(52, '00000020', 'Venta realizada con Nro Boleta: 00000020', 0, 0, 29600, '2024-04-19 23:01:17'),
(53, '00000021', 'Venta realizada con Nro Boleta: 00000021', 0, 0, 9200, '2021-10-19 02:31:19'),
(54, '00000022', 'Venta realizada con Nro Boleta: 00000022', 0, 0, 12300, '2021-10-19 02:32:55'),
(55, '00000023', 'Venta realizada con Nro Boleta: 00000023', 0, 0, 18000, '2024-04-19 23:01:17'),
(56, '00000024', 'Venta realizada con Nro Boleta: 00000024', 0, 0, 65800, '2024-04-19 23:01:17'),
(57, '00000025', 'Venta realizada con Nro Boleta: 00000025', 0, 0, 28000, '2024-04-28 05:47:52'),
(59, '00000027', 'Venta realizada con Nro Boleta: 00000027', 0, 0, 24000, '2024-04-28 06:06:12'),
(60, '00000028', 'Venta realizada con Nro Boleta: 00000028', 0, 0, 51400, '2024-04-28 06:15:05'),
(64, '00000032', 'Venta realizada con Nro Boleta: 00000032', 0, 0, 71200, '2024-04-26 17:30:52'),
(65, '00000033', 'Venta realizada con Nro Boleta: 00000033', 0, 0, 89600, '2024-04-29 03:43:11'),
(67, '00000035', 'Venta realizada con Nro Boleta: 00000035', 0, 0, 315000, '2024-04-30 01:07:39'),
(68, '00000036', 'Venta realizada con Nro Boleta: 00000036', 0, 0, 250000, '2024-05-01 22:42:59'),
(69, '00000037', 'Venta realizada con Nro Boleta: 00000037', 0, 0, 161600, '2024-05-02 23:31:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `id` int(11) NOT NULL,
  `nro_boleta` varchar(8) NOT NULL,
  `codigo_producto` bigint(20) NOT NULL,
  `cantidad` float NOT NULL,
  `total_venta` float NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `venta_detalle`
--

INSERT INTO `venta_detalle` (`id`, `nro_boleta`, `codigo_producto`, `cantidad`, `total_venta`, `fecha_venta`) VALUES
(522, '00000015', 111222, 2, 120000, '2021-10-18 22:34:17'),
(523, '00000016', 444777, 4, 166000, '2021-10-18 22:34:51'),
(524, '00000016', 555333, 60, 166000, '2021-10-18 22:34:51'),
(525, '00000016', 444777, 5, 166000, '2021-10-18 22:34:51'),
(526, '00000016', 222333, 1, 166000, '2021-10-18 22:34:51'),
(527, '00000016', 333222, 6, 1656000, '2021-10-18 22:34:51'),
(528, '00000017', 444777, 2, 50000, '2021-10-18 23:01:17'),
(529, '00000018', 222333, 1, 180000, '2024-04-27 05:47:52'),
(530, '00000019', 444777, 4, 142300, '2024-04-27 05:47:52'),
(645, '00000025', 101010, 1, 24000, '2024-04-28 05:47:52'),
(646, '00000025', 20202, 1, 4000, '2024-04-28 05:47:52'),
(648, '00000027', 101010, 1, 24000, '2024-04-28 06:06:12'),
(649, '00000028', 888999, 1, 3400, '2024-04-28 06:15:05'),
(650, '00000028', 101010, 2, 48000, '2024-04-28 06:15:05'),
(655, '00000032', 101010, 3, 67200, '2024-04-26 17:30:53'),
(656, '00000032', 20202, 1, 4000, '2024-04-26 17:30:53'),
(657, '00000033', 101010, 4, 89600, '2024-04-29 03:43:11'),
(659, '00000035', 303030, 7, 315000, '2024-04-30 01:07:39'),
(660, '00000036', 20202, 50, 250000, '2024-05-01 22:42:59'),
(661, '00000037', 101010, 7, 150500, '2024-05-02 23:31:26'),
(662, '00000037', 40404040, 3, 11100, '2024-05-02 23:31:26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `perfil_modulo`
--
ALTER TABLE `perfil_modulo`
  ADD PRIMARY KEY (`idperfil_modulo`),
  ADD KEY `id_perfil` (`id_perfil`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`,`codigo_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_perfil_usuario` (`id_perfil_usuario`);

--
-- Indices de la tabla `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  ADD PRIMARY KEY (`id_boleta`);

--
-- Indices de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=484;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `perfil_modulo`
--
ALTER TABLE `perfil_modulo`
  MODIFY `idperfil_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=624;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  MODIFY `id_boleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=663;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `perfil_modulo`
--
ALTER TABLE `perfil_modulo`
  ADD CONSTRAINT `id_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id_perfil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_perfil_usuario`) REFERENCES `perfiles` (`id_perfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
