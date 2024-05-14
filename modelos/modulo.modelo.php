<?php
 require_once "conexion.php";
 class ModuloModelo{
  static public function mdlObtenerModulos() {
   $stmt = Conexion::conectar() -> prepare("CALL prc_obtenerModulos");
   $stmt -> execute();
   return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  static public function mdlObtenerModulosPorPerfil($id_perfil) {
   $stmt = Conexion::conectar() -> prepare("SELECT id, modulo, IFNULL(CASE WHEN (m.vista IS NULL OR m.vista = '') THEN '0' 
                                             ELSE ((SELECT '1' FROM perfil_modulo pm WHERE pm.id_modulo = m.id AND pm.id_perfil = :id_perfil)) END, 0) AS sel
                                              FROM modulos m ORDER BY m.orden");
   $stmt -> bindParam(":id_perfil", $id_perfil, PDO::PARAM_INT);
   $stmt -> execute();
   return $stmt -> fetchAll(PDO::FETCH_OBJ);
  }

		static public function mdlObtenerModulosSistema() {
			$stmt = Conexion::conectar() -> prepare("CALL prc_moduloSistema");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		static public function mdlReorganizarModulos($modulos_ordenados) { 
			$total_registros = 0;
			foreach($modulos_ordenados AS $modulo) {
				$array_item_modulo = explode(";", $modulo);
				$stmt = Conexion::conectar()->prepare("UPDATE modulos SET padre_id = replace(:p_padre_id,'#',0), orden = :p_orden
																																												WHERE id = :p_id");
				$stmt -> bindParam(":p_id", $array_item_modulo[0], PDO::PARAM_INT);            
				$stmt -> bindParam(":p_padre_id", $array_item_modulo[1], PDO::PARAM_INT);
				$stmt -> bindParam(":p_orden", $array_item_modulo[2], PDO::PARAM_INT);
				if($stmt -> execute()){
					$total_registros = $total_registros + 1;
				} else {
					$total_registros = 0;
				}
			}        
			return $total_registros;
		}

		static public function mdlRegistrarModulo($data_modulo) {        
			$date = date("Y-m-d H:i:s");      
			$stmt = Conexion::conectar() -> prepare("CALL prc_RegistrarModulo");
			$stmt -> execute();
			$orden = $stmt -> fetch();
			$orden = $orden[0] + 1;
			$stmt = Conexion::conectar()->prepare("INSERT INTO modulos( modulo, padre_id, vista, icon_menu, fecha_creacion, orden)
																																											VALUES (:modulo, 0, :vista, :icon_menu, :fecha_creacion, :orden)");
			$stmt -> bindParam(":modulo", $data_modulo["iptModulo"], PDO::PARAM_STR);
			$stmt -> bindParam(":vista", $data_modulo["iptVistaModulo"], PDO::PARAM_STR);
			$stmt -> bindParam(":icon_menu", $data_modulo["iptIconoModulo"], PDO::PARAM_STR);
			$stmt -> bindParam(":fecha_creacion", $date, PDO::PARAM_STR);
			$stmt -> bindParam(":orden", $orden, PDO::PARAM_INT);
			if($stmt -> execute()) {
				return "Se registro correctamente";
			} else {
				return "Error al registrar";
			}
		}
	}
?>