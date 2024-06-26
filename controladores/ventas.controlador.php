<?php
 class VentasControlador{
  static public function ctrObtenerNroBoleta() {
   $nroBoleta = VentasModelo::mdlObtenerNroBoleta();
   return $nroBoleta;
  }

  static public function ctrRegistrarVenta($datos, $nro_boleta, $total_venta, $descripcion_venta) {
   $productos = VentasModelo::mdlRegistrarVenta($datos, $nro_boleta, $total_venta, $descripcion_venta);
   return $productos;
  }

  static public function ctrListarVentas($fechaDesde, $fechaHasta) {
   $ventas = VentasModelo::mdlListarVentas($fechaDesde, $fechaHasta);
   return $ventas;
  }

  static public function ctrEliminarVentas($nroBoleta) {
   $respuesta = VentasModelo::mdlEliminarVentas($nroBoleta);
   return $respuesta;
  }
 }
?>