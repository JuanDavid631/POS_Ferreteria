<?php
 class DashboardControlador {
  static public function ctrGetDatosDashboard() {
   $datos = DashboardModelo::mdlGetDatosDashboard();
   return $datos;
  }

  static public function ctrGetVentasMesActual() {
   $ventasNMesActual = DashboardModelo::mdlGetVentasNMesActual();
   return $ventasNMesActual;
  }
  
  static public function ctrGetProductosMasVendidos() {
   $productosMasVendidos = DashboardModelo::mdlProductosMasVendidos();
   return $productosMasVendidos;
  }

  static public function ctrGetProductosPocoStock() {
   $productosPocoStock = DashboardModelo::mdlProductosPocoStock();
   return $productosPocoStock;
  }

  static public function ctrVentasPorCategoria() {
   $ventasPorCategorias = DashboardModelo::mdlVentasPorCategoria();
   return $ventasPorCategorias;
  }
 }
?>