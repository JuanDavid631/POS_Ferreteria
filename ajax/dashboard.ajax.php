<?php
 require_once "../controladores/dashboard.controlador.php";
 require_once "../modelos/dashboard.modelo.php";

 class AjaxDashboard {
  public function getDatosDashboard() {
   $datos = DashboardControlador::ctrGetDatosDashboard();
   echo json_encode($datos);
  }

  public function getVentasMesActual() {
   $ventasMesActual = DashboardControlador::ctrGetVentasMesActual();
   echo json_encode($ventasMesActual);
  }

  public function getProductosMasVendidos() {
   $productosMasVendidos = DashboardControlador::ctrGetProductosMasVendidos();
   echo json_encode($productosMasVendidos);
  }

  public function getProductosPocoStock() {
   $productosPocoStock = DashboardControlador::ctrGetProductosPocoStock();
   echo json_encode($productosPocoStock);
  }

		public function getVentasPorCategorias() {
   $ventasPorCategorias = DashboardControlador::ctrVentasPorCategoria();
   echo json_encode($ventasPorCategorias, JSON_NUMERIC_CHECK);
  }
 }

 if(isset($_POST['accion']) && $_POST['accion'] == 1) {
  $ventasMesActual = new AjaxDashboard();
  $ventasMesActual -> getVentasMesActual();
 } else if(isset($_POST['accion']) && $_POST['accion'] == 2) {
   $productosMasVendidos = new AjaxDashboard();
   $productosMasVendidos -> getProductosMasVendidos();
 } else if(isset($_POST['accion']) && $_POST['accion'] == 3) {
  $productosPocoStock = new AjaxDashboard();
  $productosPocoStock -> getProductosPocoStock();
 } else if(isset($_POST['accion']) && $_POST['accion'] == 4) {
		$ventasPorCategorias = new AjaxDashboard();
		$ventasPorCategorias -> getVentasPorCategorias();
	} else {
  $datos = new AjaxDashboard();
  $datos -> getDatosDashboard();
 }
?>