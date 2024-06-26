<?php
 require_once "conexion.php";
 class VentasModelo {
  public $resultado;
  static public function mdlObtenerNroBoleta() {
   $stmt = Conexion::conectar() -> prepare("CALL prc_obtenerNroBoleta()");
   $stmt -> execute();
   return $stmt -> fetch(PDO::FETCH_OBJ);
  }

  static public function mdlRegistrarVenta($datos, $nro_boleta, $total_venta, $descripcion_venta) {
   $stmt = Conexion::conectar() -> prepare("INSERT INTO venta_cabecera(nro_boleta, descripcion, total_venta) VALUES(:nro_boleta, :descripcion, :total_venta)");
   $stmt -> bindParam(":nro_boleta", $nro_boleta , PDO::PARAM_STR);
   $stmt -> bindParam(":descripcion", $descripcion_venta, PDO::PARAM_STR);
   $stmt -> bindParam(":total_venta", $total_venta , PDO::PARAM_STR);
   if($stmt -> execute()) {
    $stmt = null;
    $stmt = Conexion::conectar() -> prepare("UPDATE empresa SET nro_correlativo_venta = LPAD(nro_correlativo_venta + 1, 8, '0')");
    if($stmt -> execute()) {
     $listaProductos = [];
     for ($i = 0; $i < count($datos); ++$i) {
      $listaProductos = explode(",", $datos[$i]);
      $stmt = Conexion::conectar() -> prepare("INSERT INTO venta_detalle(nro_boleta, codigo_producto, cantidad, total_venta) 
                                               VALUES(:nro_boleta, :codigo_producto, :cantidad, :total_venta)");
      $stmt -> bindParam(":nro_boleta", $nro_boleta , PDO::PARAM_STR);
      $stmt -> bindParam(":codigo_producto", $listaProductos[0] , PDO::PARAM_STR);
      $stmt -> bindParam(":cantidad", $listaProductos[1] , PDO::PARAM_STR);
      $stmt -> bindParam(":total_venta", $listaProductos[2] , PDO::PARAM_STR);
      if($stmt -> execute()) {
       $stmt = null;
       $stmt = Conexion::conectar() -> prepare("UPDATE productos SET stock_producto = stock_producto - :cantidad, ventas_producto = ventas_producto + :cantidad 
                                                 WHERE codigo_producto = :codigo_producto");
       $stmt -> bindParam(":codigo_producto", $listaProductos[0] , PDO::PARAM_STR);
       $stmt -> bindParam(":cantidad", $listaProductos[1] , PDO::PARAM_STR);
       if($stmt -> execute()) {
        $resultado = "Se registró la venta correctamente.";
       } else {
        $resultado = "Error al actualizar el stock";
       }
      } else {
       $resultado = "Error al registrar la venta";
      }   
     }
     return $resultado;
     $stmt = null;
    }
   }
  }

  static public function mdlListarVentas($fechaDesde, $fechaHasta) {
   try { 
    $stmt = Conexion::conectar() -> prepare("SELECT CONCAT('Boleta Nro: ', v.nro_boleta,' - Total de la Venta: $ ', FORMAT(ROUND(vc.total_venta, 1), 0)) AS nro_boleta, v.codigo_producto, c.nombre_categoria, p.descripcion_producto,
                                             CASE WHEN c.aplica_peso = 1 THEN CONCAT(v.cantidad, ' Kg(s)') ELSE CONCAT(v.cantidad, ' Und(s)') END AS cantidad, CONCAT('$ ', ROUND(v.total_venta, 2)) AS total_venta,
                                             v.fecha_venta FROM venta_detalle v INNER JOIN productos p ON v.codigo_producto = p.codigo_producto INNER JOIN venta_cabecera vc ON CAST(vc.nro_boleta AS INTEGER) = CAST(v.nro_boleta AS INTEGER)
                                             INNER JOIN categorias c ON c.id_categoria = p.id_categoria_producto WHERE DATE(v.fecha_venta) >= DATE(:fechaDesde) AND DATE(v.fecha_venta) <= DATE(:fechaHasta) ORDER BY v.nro_boleta ASC;");
    $stmt -> bindParam(":fechaDesde", $fechaDesde, PDO::PARAM_STR);
    $stmt -> bindParam(":fechaHasta", $fechaHasta, PDO::PARAM_STR);
    $stmt -> execute();
    return $stmt -> fetchAll();
   } catch (Exception $e) {
    return 'Excepción capturada: '.  $e -> getMessage(). "\n";
   }
   $stmt = null;
  }

  static public function mdlEliminarVentas($nroBoleta) {
   $stmt = Conexion::conectar() -> prepare("CALL prc_eliminar_venta(:nroBoleta)");
   $stmt -> bindParam(":nroBoleta", $nroBoleta, PDO::PARAM_STR);
   $stmt -> execute();
   return $stmt -> fetch();
  }
 }
?>