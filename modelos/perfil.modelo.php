<?php
 require_once "conexion.php";

 class PerfilModelo {
  static public function mdlObtenerPerfiles() {
   $stmt = Conexion::conectar() -> prepare("CALL prc_modulosPerfiles");
   $stmt -> execute();
   return $stmt -> fetchAll();
  }

		static public function mdlRegistrarPerfil($data_modulo) {        
			$stmt = Conexion::conectar()->prepare("INSERT INTO perfiles(descripcion, estado, fecha_creacion, fecha_actualizacion)
																																											VALUES (:descripcion, :estado, :fecha_creacion, :fecha_actualizacion)");
			$fecha = date('Y-m-d');
   $stmt -> bindParam(":descripcion", $data_modulo["descripcion"], PDO::PARAM_STR);
			$stmt -> bindParam(":estado", $data_modulo["estado"], PDO::PARAM_STR);
			$stmt -> bindParam(":fecha_creacion", $fecha, PDO::PARAM_STR);
			$stmt -> bindParam(":fecha_actualizacion", $fecha, PDO::PARAM_STR);
			if($stmt -> execute()) {
				return "Se registro correctamente";
			} else {
				return "Error al registrar";
			}
		}

		static public function mdlObtenerPerfilesData() {
   $stmt = Conexion::conectar() -> prepare("CALL prc_modulosPerfilesData");
   $stmt -> execute();
   return $stmt -> fetchAll();
  }


  





 }
?>
<?php
/*  static public function mdlObtenerListarPerfiles(){

        $stmt = Conexion::conectar()->prepare("select p.id_perfil,
                                                        p.descripcion
                                                from perfiles p
                                                where estado = 1
                                                order by p.id_perfil");

        $stmt -> execute();

        return $stmt->fetchAll();

    }
    



    static public function mdlRegistrarPerfil($perfil)
    {

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("INSERT INTO perfiles(descripcion, estado)
            VALUES(UPPER(?),?)");

            $dbh->beginTransaction();
            $stmt->execute(array(
                $perfil['descripcion'],
                $perfil['estado']
            ));

            $dbh->commit();

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = 'Se registró el perfil correctamente';
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al registrar el perfil ' . $e->getMessage();
        }

        return $respuesta;
    }*/
?>