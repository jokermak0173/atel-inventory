<?php
  require_once "conexion.php";

  class ModeloComponentes{
    static public function mdlMostrarComponentes($tabla, $item, $valor){

      if($item == null){
        $stmt = Conexion::conectarLocal()->prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt->close();
        $stmt = null;
      }else{
        $stmt = Conexion::conectarLocal()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
        $stmt -> bindParam(":valor", $valor, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch();
        $stmt->close();
        $stmt = null;
      }


    }
  }
?>
