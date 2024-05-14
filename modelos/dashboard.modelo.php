<?php
 require_once "conexion.php";
 class DashboardModelo {
  static public function mdlGetDatosDashboard() {
   $stmt = Conexion::conectar() -> prepare('CALL prc_ObtenerDatosDashboard');
   $stmt -> execute();
   return $stmt -> fetchAll(PDO::FETCH_OBJ);
  }

  static public function mdlGetVentasNMesActual() {
   $stmt = Conexion::conectar() -> prepare('CALL prc_ObtenerVentasMesActual');
   $stmt -> execute();
   return $stmt -> fetchAll(PDO::FETCH_OBJ);
  }

  static public function mdlProductosMasVendidos() {
   $stmt = Conexion::conectar() -> prepare('CALL prc_ListarProductosMasVendidos');
   $stmt -> execute();
   return $stmt -> fetchAll(PDO::FETCH_OBJ);
  }

  static public function mdlProductosPocoStock() {
   $stmt = Conexion::conectar() -> prepare('CALL prc_ListarProductosPocoStock');
   $stmt -> execute();
   return $stmt -> fetchAll(PDO::FETCH_OBJ);
  }

  static public function mdlVentasPorCategoria() {
   $stmt = Conexion::conectar() -> prepare('CALL prc_top_ventas_categorias');
   $stmt -> execute();
   return $stmt -> fetchAll(PDO::FETCH_OBJ);
  }
 }
?>