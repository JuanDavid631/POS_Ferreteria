<?php
 class PerfilControlador {
  static public function ctrObtenerPerfiles() {
   $modulos = PerfilModelo::mdlObtenerPerfiles();
   return $modulos;
  }

  static public function ctrRegistrarPerfil($data_modulo) {
			$registro_modulo = PerfilModelo::mdlRegistrarPerfil($data_modulo);
			return $registro_modulo;
		}

  static public function ctrObtenerPerfilesData() {
   $modulosData = PerfilModelo::mdlObtenerPerfilesData();
   return $modulosData;
  }
 } 
?>