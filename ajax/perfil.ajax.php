<?php
 require_once "../controladores/perfil.controlador.php";
 require_once "../modelos/perfil.modelo.php";

 class AjaxPerfiles {

  public function ajaxObtenerPerfiles(){
   $perfiles = PerfilControlador::ctrObtenerPerfiles();
   echo json_encode($perfiles);
  }

		public function ajaxRegistrarPerfil($data_modulo){
			$registro_modulo = PerfilControlador::ctrRegistrarPerfil($data_modulo);
			echo json_encode($registro_modulo);
		}

		public function ajaxObtenerPerfilesData() {
   $perfilesData = PerfilControlador::ctrObtenerPerfilesData();
   echo json_encode($perfilesData);
  }

  public function ajaxObtenerSelect() {
			$select = PerfilControlador::ctrObtenerSelect();
			echo json_encode($response, JSON_UNESCAPED_UNICODE);
  }
 }

 if(isset($_POST['accion']) && $_POST['accion'] == 1){
  $perfiles = new AjaxPerfiles;    
  $perfiles -> ajaxObtenerPerfiles();
 } else if(isset($_POST['accion']) && $_POST['accion'] == 2) { 
		$array_datos = [];
		parse_str($_POST['datos'], $array_datos);
		$registro_modulo = new AjaxPerfiles();
		$registro_modulo -> ajaxRegistrarPerfil($array_datos);
 } else if(isset($_POST['accion']) && $_POST['accion'] == 3) { 
  $perfilesData = new AjaxPerfiles;    
  $perfilesData -> ajaxObtenerPerfilesData();
	} else if(isset($_POST['accion']) && $_POST['accion'] == 4) { 
    $perfilSelect = new AjaxPerfiles;    
    $perfilSelect -> ajaxObtenerSelect();
  }
?>