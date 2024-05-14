<?php
 require_once "conexion.php";
 use PhpOffice\PhpSpreadsheet\IOFactory;
 class ProductosModelo{
  static public function mdlCargaMasivaProductos($fileProductos) {
   $nombreArchivo = $fileProductos['tmp_name'];
   $documento = IOFactory::load($nombreArchivo);
   $hojaCategorias = $documento->getSheet(1);
   $numeroFilasCategorias = $hojaCategorias->getHighestDataRow(); 
   
   $hojaProductos = $documento->getSheetByName("Productos");
   $numeroFilasProductos = $hojaProductos->getHighestDataRow();

   $categoriasRegistradas = 0;
   $productosRegistrados = 0;

   //CICLO FOR PARA REGISTROS DE CATEGORIAS
   for ($fila=2; $fila <= $numeroFilasCategorias ; $fila++) { 
    $categoria = $hojaCategorias -> getCellByColumnAndRow(1, $fila);
    $aplica_peso = $hojaCategorias -> getCellByColumnAndRow(2, $fila);
    $fecha_actualizacion = date("Y-m-d");

    if(!empty($categoria)){
     $stmt = Conexion::conectar() -> prepare("INSERT INTO categorias (nombre_categoria, aplica_peso, fecha_actualizacion_categoria)
                                                            VALUES (:nombre_categoria, :aplica_peso, :fecha_actualizacion_categoria);");
     $stmt -> bindParam(":nombre_categoria", $categoria, PDO::PARAM_STR);
     $stmt -> bindParam(":aplica_peso", $aplica_peso, PDO::PARAM_STR);
     $stmt -> bindParam(":fecha_actualizacion_categoria", $fecha_actualizacion, PDO::PARAM_STR);
     if($stmt -> execute()) {
      $categoriasRegistradas = $categoriasRegistradas + 1;
     } else {
      $categoriasRegistradas = 0;
     }
    }
   }


   if ($categoriasRegistradas > 0) {
    //CICLO FOR PARA REGISTROS DE PRODUCTOS
    for ($fila=2; $fila <= $numeroFilasProductos ; $fila++) { 
     $codigo_producto = $hojaProductos -> getCell("A".$fila);
     $id_categoria_producto = ProductosModelo::mdlBuscarIdCategoria($hojaProductos -> getCell("B".$fila));
     $descripcion_producto = $hojaProductos -> getCell("C".$fila);
     $precio_compra_producto = $hojaProductos -> getCell("D".$fila);
     $precio_venta_producto = $hojaProductos -> getCell("E".$fila);
     $utilidad = $hojaProductos -> getCell("F".$fila);
     $stock_producto = $hojaProductos -> getCell("G".$fila);
     $minimo_stock_producto = $hojaProductos -> getCell("H".$fila);
     $ventas_producto = $hojaProductos -> getCell("I".$fila);
     $fecha_actualizacion_producto = date('Y-m-d');

     if(!empty($codigo_producto)){
      $stmt = Conexion::conectar() -> prepare("INSERT INTO productos(codigo_producto, id_categoria_producto, descripcion_producto, precio_compra_producto, precio_venta_producto, utilidad, stock_producto, minimo_stock_producto, ventas_producto, fecha_actualizacion_producto)
                                               VALUES (:codigo_producto, :id_categoria_producto, :descripcion_producto, :precio_compra_producto, :precio_venta_producto, :utilidad, :stock_producto, :minimo_stock_producto, :ventas_producto, :fecha_actualizacion_producto);");
      $stmt -> bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
      $stmt -> bindParam(":id_categoria_producto", $id_categoria_producto[0], PDO::PARAM_STR);
      $stmt -> bindParam(":descripcion_producto", $descripcion_producto, PDO::PARAM_STR);
      $stmt -> bindParam(":precio_compra_producto", $precio_compra_producto, PDO::PARAM_STR);
      $stmt -> bindParam(":precio_venta_producto", $precio_venta_producto, PDO::PARAM_STR);
      $stmt -> bindParam(":utilidad", $utilidad, PDO::PARAM_STR);
      $stmt -> bindParam(":stock_producto", $stock_producto, PDO::PARAM_STR);
      $stmt -> bindParam(":minimo_stock_producto", $minimo_stock_producto, PDO::PARAM_STR);
      $stmt -> bindParam(":ventas_producto", $ventas_producto, PDO::PARAM_STR);
      $stmt -> bindParam(":fecha_actualizacion_producto", $fecha_actualizacion_producto, PDO::PARAM_STR);
      if($stmt -> execute()){
       $productosRegistrados = $productosRegistrados + 1;
      } else {
       $productosRegistrados = 0;
      }
     }   
    }
   }
   $respuesta["totalCategorias"] = $categoriasRegistradas;
   $respuesta["totalProductos"] = $productosRegistrados;
   return $respuesta;
  }

  static public function mdlBuscarIdCategoria($nombreCategoria) {
   $stmt = Conexion::conectar() -> prepare("SELECT id_categoria FROM categorias WHERE nombre_categoria = :nombreCategoria");
   $stmt -> bindParam(":nombreCategoria", $nombreCategoria, PDO::PARAM_STR);
   $stmt -> execute();
   return $stmt -> fetch();
  }

  static public function mdlListarProductos() {
   $stmt = Conexion::conectar() -> prepare("CALL prc_ListarProductos");
   $stmt -> execute();
   return $stmt -> fetchAll();
  }

  static public function mdlRegistrarProducto($codigo_producto, $id_categoria_producto, $descripcion_producto, $precio_compra_producto, $precio_venta_producto, $utilidad, $stock_producto, $minimo_stock_producto, $ventas_producto) {
   $stmt = Conexion::conectar() -> prepare("INSERT INTO productos (codigo_producto, id_categoria_producto, descripcion_producto, precio_compra_producto, precio_venta_producto, utilidad, stock_producto, minimo_stock_producto, ventas_producto, fecha_creacion_producto, fecha_actualizacion_producto) 
                                            VALUES(:codigo_producto, :id_categoria_producto, :descripcion_producto, :precio_compra_producto, :precio_venta_producto, :utilidad, :stock_producto, :minimo_stock_producto, :ventas_producto, :fecha_creacion_producto, :fecha_actualizacion_producto);");
   try {
    $fecha = date('Y-m-d');
    $stmt -> bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
    $stmt -> bindParam(":id_categoria_producto", $id_categoria_producto, PDO::PARAM_STR);
    $stmt -> bindParam(":descripcion_producto", $descripcion_producto, PDO::PARAM_STR);
    $stmt -> bindParam(":precio_compra_producto", $precio_compra_producto, PDO::PARAM_STR);
    $stmt -> bindParam(":precio_venta_producto", $precio_venta_producto, PDO::PARAM_STR);
    $stmt -> bindParam(":utilidad", $utilidad, PDO::PARAM_STR);
    $stmt -> bindParam(":stock_producto", $stock_producto, PDO::PARAM_STR);
    $stmt -> bindParam(":minimo_stock_producto", $minimo_stock_producto, PDO::PARAM_STR);
    $stmt -> bindParam(":ventas_producto", $ventas_producto, PDO::PARAM_STR);
    $stmt -> bindParam(":fecha_creacion_producto", $fecha, PDO::PARAM_STR);
    $stmt -> bindParam(":fecha_actualizacion_producto", $fecha, PDO::PARAM_STR);
    if($stmt -> execute()) {
     $resultado = "OK";
    } else {
     $resultado = "ERROR";
    }
   } catch (Exception $e){
    $resultado = "Excepcion capturada ". $e -> getMessage(). "\n";
   }
   return $resultado;
   $stmt = null;
  }

  static public function mdlActualizarInformacion($table, $data, $id, $nameId) {
   $set = "";
   foreach($data as $key => $value) {
    $set .= $key." = :".$key.",";
   }
   $set = substr($set, 0, -1);
   $stmt = Conexion::conectar() -> prepare("UPDATE $table SET $set WHERE $nameId = :$nameId");
   foreach($data as $key => $value) {
    $stmt -> bindParam(":".$key, $data[$key], PDO::PARAM_STR);
   }
   $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_STR);
   if($stmt -> execute()) {
    return "OK";
   } else {
    return Conexion::conectar() -> errorInfo();
   }
  }

  static public function mdlEliminarInformacion($table, $id, $nameId) {
   $stmt = Conexion::conectar() -> prepare("DELETE FROM $table WHERE $nameId = :$nameId");
   $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_STR);
   if($stmt -> execute()) {
    return "OK";
   } else {
    return Conexion::conectar() -> errorInfo();
   }
  }

  static public function mdlListarNombresProductos() {
   $stmt = Conexion::conectar() -> prepare("CALL prc_ListarProductosVentas");
   $stmt -> execute();
   return $stmt -> fetchAll();
  }

  static public function mdlGetDatosProducto($codigoProducto) {
   $stmt = Conexion::conectar() -> prepare("SELECT id, codigo_producto, c.id_categoria, c.nombre_categoria, descripcion_producto, '1' AS cantidad, 
                                            CONCAT('$ ', CONVERT(ROUND(precio_venta_producto, 2), CHAR)) AS precio_venta_producto, 
                                            CONCAT('$ ', CONVERT(ROUND(1*precio_venta_producto, 2), CHAR)) AS total, '' AS acciones, c.aplica_peso, 
                                            p.precio_mayor_producto, p.precio_oferta_producto 
                                              FROM productos p INNER JOIN categorias c ON p.id_categoria_producto = c.id_categoria 
                                              WHERE codigo_producto = :codigoProducto AND p.stock_producto > 0");
   $stmt -> bindParam(":codigoProducto", $codigoProducto, PDO::PARAM_INT);
   $stmt -> execute();
   return $stmt -> fetch(PDO::FETCH_OBJ);
  }

  static public function mdlVerificaStockProducto($codigo_producto, $cantidad_a_comprar) {
   $stmt = Conexion::conectar() -> prepare("SELECT COUNT(*) AS existe FROM productos p 
                                              WHERE p.codigo_producto = :codigo_producto 
                                              AND p.stock_producto > :cantidad_a_comprar;");
   $stmt -> bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_INT);
   $stmt -> bindParam(":cantidad_a_comprar", $cantidad_a_comprar, PDO::PARAM_INT);
   $stmt -> execute();
   return $stmt -> fetch(PDO::FETCH_OBJ);
  }
 }
?>