<?php
 class UsuarioControlador {
  public function login() {
   if(isset($_POST["loginUsuario"])) {
    $usuario = $_POST["loginUsuario"];
    $password = crypt($_POST["loginPassword"], '$2a$07$azybxcags23425sdg23sdfhsd$');
    $respuesta = UsuarioModelo::mdlIniciarSesion($usuario, $password);
    if(count($respuesta) > 0) {
     $_SESSION["usuario"] = $respuesta[0];
     echo '<script>
            window.location = "http://localhost/POS_Ferreteria/"
           </script>';
    } else {
     echo '<script>
            fncSweetAlert(
             "error",
             "Usuario y/o contraseña inválida",
             "http://localhost/POS_Ferreteria/"
            );
           </script>';
    }
   }
  }

  static public function ctrObtenerMenuUsuario($id_usuario) {
   $menuUsuario = UsuarioModelo::mdlObtenerMenuUsuario($id_usuario);
   return $menuUsuario;
  }

		static public function ctrObtenerSubMenuUsuario($idMenu) {
   $subMenuUsuario = UsuarioModelo::mdlObtenerSubMenuUsuario($idMenu);
   return $subMenuUsuario;
  }

		static public function ctrListarUsuarios() {
   $usuario = UsuarioModelo::mdlListarUsuario();
   return $usuario;
  }
 }
?>