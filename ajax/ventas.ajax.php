<?php
 require_once "../controladores/ventas.controlador.php";
 require_once "../modelos/ventas.modelo.php";

 class AjaxVentas{
  public function ajaxObtenerNroBoleta() {
   $nroBoleta = VentasControlador::ctrObtenerNroBoleta();
   echo json_encode($nroBoleta, JSON_UNESCAPED_UNICODE);
  }

  public function ajaxRegistrarVenta($datos, $nro_boleta, $total_venta, $descripcion_venta) {
   $registroVenta = VentasControlador::ctrRegistrarVenta($datos, $nro_boleta, $total_venta, $descripcion_venta);
   echo json_encode($registroVenta, JSON_UNESCAPED_UNICODE);
  }

		public function ajaxListarVentas($fechaDesde, $fechaHasta) {
			$ventas = VentasControlador::ctrListarVentas($fechaDesde, $fechaHasta);  
			echo json_encode($ventas, JSON_UNESCAPED_UNICODE);
		}

		public function ajaxEliminarVentas($nroBoleta) {
			$respuesta = VentasControlador::ctrEliminarVentas($nroBoleta);  
			echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
		}
	}

	if(isset($_POST["accion"]) && $_POST["accion"] == 1) {
		$nroBoleta = new AjaxVentas();
		$nroBoleta -> ajaxObtenerNroBoleta();
	} else if(isset($_POST["accion"]) && $_POST["accion"] == 2) { 
		$ventas = new AjaxVentas();
		$ventas -> ajaxListarVentas($_POST["fechaDesde"], $_POST["fechaHasta"]);
	} else if(isset($_POST["accion"]) && $_POST["accion"] == 3) { 
		$ventas = new AjaxVentas();
		$ventas -> ajaxEliminarVentas($_POST['Boleta']);
	} else {
		if((isset($_POST["arr"]))) {
			$registrar = new AjaxVentas();
			$registrar -> ajaxRegistrarVenta($_POST["arr"], $_POST['nro_boleta'], $_POST['total_venta'], $_POST['descripcion_venta']);
		}
	}
?>