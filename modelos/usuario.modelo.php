<?php
 require_once "conexion.php";
 class UsuarioModelo {
  static public function mdlIniciarSesion($usuario, $password) {
   $stmt = Conexion::conectar() -> prepare("SELECT * FROM usuarios u INNER JOIN perfiles p ON u.id_perfil_usuario = p.id_perfil
                                             INNER JOIN perfil_modulo pm ON pm.id_perfil = u.id_perfil_usuario
                                                INNER JOIN modulos m ON m.id = pm.id_modulo
                                                WHERE u.usuario = :usuario AND u.clave = :password AND vista_inicio = 1");
   $stmt -> bindParam(":usuario", $usuario, PDO::PARAM_STR);
   $stmt -> bindParam(":password", $password, PDO::PARAM_STR);
   $stmt -> execute();
   return $stmt -> fetchAll(PDO::FETCH_CLASS);
  }

  public static function mdlObtenerMenuUsuario($id_usuario) {
   $stmt = Conexion::conectar() -> prepare("SELECT m.id, m.modulo, m.icon_menu, m.vista, pm.vista_inicio
                                              FROM usuarios u INNER JOIN perfiles p ON u.id_perfil_usuario = p.id_perfil
                                              INNER JOIN perfil_modulo pm ON pm.id_perfil = p.id_perfil
                                              INNER JOIN modulos m ON m.id = pm.id_modulo
                                                WHERE u.id_usuario = :id_usuario AND (m.padre_id IS NULL OR m.padre_id = 0)
																																																ORDER BY m.orden;");
   $stmt -> bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);
   $stmt -> execute();
   return $stmt -> fetchAll(PDO::FETCH_CLASS);
  }

		public static function mdlObtenerSubMenuUsuario($idMenu) {
   $stmt = Conexion::conectar() -> prepare("CALL prc_subMenuUsuario(:idMenu)");
   $stmt -> bindParam(":idMenu", $idMenu, PDO::PARAM_STR);
   $stmt -> execute();
   return $stmt -> fetchAll(PDO::FETCH_CLASS);
  }

		public static function mdlListarUsuario() {
			$stmt = Conexion::conectar() -> prepare("CALL prc_ListarUsuarios");
   $stmt -> execute();
   return $stmt -> fetchAll();
		}
 }
?>