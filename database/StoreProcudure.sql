-- NOMBRE DE RUTINA --> prc_ObtenerDatosDashboard
BEGIN
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
END

-- NOMBRE DE RUTINA --> prc_ObtenerVentasMesActual
BEGIN
	SELECT date(vc.fecha_venta) AS fecha_venta, SUM(ROUND(vc.total_venta, 0)) AS total_venta 
		FROM venta_cabecera vc WHERE date(vc.fecha_venta) >= date(last_day(now() - INTERVAL 1 month) + INTERVAL 1 day)
		AND date(vc.fecha_venta) <= last_day(date(CURRENT_DATE)) GROUP BY date(vc.fecha_venta);
END

-- NOMBRE DE RUTINA --> prc_ListarProductosMasVendidos
BEGIN
	SELECT p.codigo_producto, p.descripcion_producto, CONCAT(SUM(vd.cantidad), ' Und(s)') AS cantidad, SUM(ROUND(vd.total_venta, 0)) AS total_venta 
		FROM venta_detalle vd INNER JOIN productos p ON vd.codigo_producto = p.codigo_producto
		GROUP BY p.codigo_producto, p.descripcion_producto
		ORDER BY SUM(ROUND(vd.total_venta, 2)) DESC LIMIT 15;
END

-- NOMBRE DE RUTINA --> prc_ListarProductosPocoStock
BEGIN
	SELECT p.codigo_producto, p.descripcion_producto, CONCAT(p.stock_producto, ' Und(s)') AS stock_producto, CONCAT(p.minimo_stock_producto, ' Und(s)') AS minimo_stock_producto FROM productos p
  WHERE p.stock_producto <= p.minimo_stock_producto ORDER BY p.stock_producto ASC;
END

-- NOMBRE DE RUTINA --> prc_ListarProductos
BEGIN
	SELECT '' AS detalles, p.id, p.codigo_producto, c.id_categoria, c.nombre_categoria, p.descripcion_producto, 
		CONCAT('$ ', ROUND(p.precio_compra_producto, 0)) AS precio_compra,
		CONCAT('$ ', ROUND(p.precio_venta_producto, 0)) AS precio_venta,
		CONCAT('$ ', ROUND(p.utilidad, 0)) AS utilidad,
		CASE WHEN c.aplica_peso = 1 THEN CONCAT(p.stock_producto, ' Kg(s)') ELSE CONCAT(p.stock_producto, ' Und(s)') END AS stock,
		CASE WHEN c.aplica_peso = 1 THEN CONCAT(p.minimo_stock_producto, ' Kg(s)') ELSE CONCAT(p.minimo_stock_producto, ' Und(s)') END AS minimo_stock,
		CASE WHEN c.aplica_peso = 1 THEN CONCAT(p.ventas_producto, ' Kg(s)') ELSE CONCAT(p.ventas_producto, ' Und(s)') END AS ventas,
		p.fecha_creacion_producto,
		p.fecha_actualizacion_producto,
		'' AS opciones
		FROM productos p INNER JOIN categorias c ON p.id_categoria_producto = c.id_categoria ORDER BY p.id DESC;
END

-- NOMBRE DE RUTINA --> prc_ListarProductosVentas
BEGIN
	SELECT CONCAT(codigo_producto , ' - ' , c.nombre_categoria, ' - ', descripcion_producto, ' - $ ' , p.precio_venta_producto)  
		AS descripcion_producto FROM productos p INNER JOIN categorias c ON p.id_categoria_producto = c.id_categoria;
END

-- NOMBRE DE RUTINA --> prc_obtenerNroBoleta
BEGIN
	SELECT serie_boleta, IFNULL(LPAD(MAX(c.nro_correlativo_venta) + 1, 8, '0'), '00000001') nro_venta
  FROM empresa c;
END

-- NOMBRE DE RUTINA --> pcr_ListarCategorias
BEGIN
	SELECT  id_categoria, nombre_categoria, aplica_peso as medida, date(fecha_creacion_categoria) as fecha_creacion_categoria, fecha_actualizacion_categoria, '' as opciones
		FROM categorias c ORDER BY id_categoria DESC;
END

-- NOMBRE DE RUTINA --> prc_eliminarVenta
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_eliminar_venta`(IN `p_nro_boleta` VARCHAR(8))
BEGIN
	DECLARE v_codigo VARCHAR(20);
	DECLARE v_cantidad FLOAT;
	DECLARE done INT DEFAULT FALSE;
	DECLARE cursor_i CURSOR FOR 
		SELECT codigo_producto,cantidad FROM venta_detalle 
			WHERE CAST(nro_boleta AS CHAR CHARACTER SET utf8)  = CAST(p_nro_boleta AS CHAR CHARACTER SET utf8) ;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	OPEN cursor_i;
	read_loop: LOOP
	FETCH cursor_i INTO v_codigo, v_cantidad;
		IF done THEN
			LEAVE read_loop;
		END IF;
		UPDATE PRODUCTOS SET stock_producto = stock_producto + v_cantidad
			WHERE CAST(codigo_producto AS CHAR CHARACTER SET utf8) = CAST(v_codigo AS CHAR CHARACTER SET utf8);
	END LOOP;
	CLOSE cursor_i;
	DELETE FROM venta_detalle 
		WHERE CAST(nro_boleta AS CHAR CHARACTER SET utf8) = CAST(p_nro_boleta AS CHAR CHARACTER SET utf8) ;
	DELETE FROM venta_cabecera 
		WHERE CAST(nro_boleta AS CHAR CHARACTER SET utf8)  = CAST(p_nro_boleta AS CHAR CHARACTER SET utf8) ;
	SELECT 'Se eliminó correctamente la venta';
END

-- NOMBRE DE RUTINA --> prc_subMenuUsuario
BEGIN
	SELECT m.id, m.modulo, m.icon_menu, m.vista
		FROM modulos m WHERE m.padre_id = :idMenu
		ORDER BY m.id
END

-- NOMBRE DE RUTINA --> prc_modulosPerfiles
BEGIN
	SELECT p.id_perfil, p.descripcion, p.estado, DATE(p.fecha_creacion) AS fecha_creacion, p.fecha_actualizacion, ' ' AS opciones
		FROM perfiles p ORDER BY p.id_perfil;
END

-- NOMBRE DE RUTINA --> prc_obtenerModulos
BEGIN
	SELECT id AS id, (CASE WHEN (padre_id IS NULL OR padre_id = 0) THEN '#' ELSE padre_id END) AS parent, modulo AS text, vista
  FROM modulos m ORDER BY m.orden;
END


-- ACTUALIZAR PRECIOS DE OFERTAS O PROMOCIONES
UPDATE productos SET precio_mayor_producto = precio_venta_producto - 2000, precio_oferta_producto = precio_venta_producto - 2500 WHERE 1=1;