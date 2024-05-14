<?php
 require_once "conexion.php";
 class CategoriasModelo {
  public $resultado;

  static public function mdlListarCategorias() {
   $stmt = Conexion::conectar() -> prepare("CALL pcr_ListarCategorias");
   $stmt -> execute();
   return $stmt -> fetchAll();
  }

  static public function mdlGuardarCategoria($accion, $idCategoria, $categoria, $medida) {
   $date = null;
   if($accion > 0) {
    $date = date("Y-m-d H:i:s");
    $stmt = Conexion::conectar() -> prepare("INSERT INTO categorias(nombre_categoria,aplica_peso,fecha_actualizacion_categoria) 
																																													VALUES(:categoria,:medida,:fecha_actualizacion_categoria)");
    $stmt -> bindParam(":categoria", $categoria , PDO::PARAM_STR);
    $stmt -> bindParam(":medida", $medida , PDO::PARAM_STR);
    $stmt -> bindParam(":fecha_actualizacion_categoria",  $date , PDO::PARAM_STR);
    if($stmt -> execute()) {
     $resultado = "Se registró la categoría correctamente.";
    } else {
     $resultado = "Error al registrar la categoria";
    }
   } else {
    $date = date("Y-m-d H:i:s");
    $stmt = Conexion::conectar() -> prepare("UPDATE categorias SET nombre_categoria = :categoria, aplica_peso = :medida, fecha_actualizacion_categoria = :fecha_actualizacion_categoria WHERE id_categoria = :idCategoria") ;
    $stmt -> bindParam(":idCategoria", $idCategoria , PDO::PARAM_STR);
    $stmt -> bindParam(":categoria", $categoria , PDO::PARAM_STR);
    $stmt -> bindParam(":medida", $medida, PDO::PARAM_STR);
    $stmt -> bindParam(":fecha_actualizacion_categoria",  $date , PDO::PARAM_STR);
    if($stmt -> execute()){
     $resultado = "Se actualizó la categoría correctamente.";
    }else{
     $resultado = "Error al actualizar la categoría";
    }
   }
   return $resultado;
   $stmt = null;
  }

  static public function mdlEliminarCategoria($table, $id, $nameId) {
   $stmt = Conexion::conectar() -> prepare("DELETE FROM $table WHERE $nameId = :$nameId");
   $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_STR);
   if($stmt -> execute()) {
    return "OK";
   } else {
    return Conexion::conectar() -> errorInfo();
   }
  }
 }
?>