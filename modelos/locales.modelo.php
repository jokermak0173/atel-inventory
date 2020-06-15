<?php

	require_once "conexion.php";

	class ModeloLocales{

		static public function mdlMostrarLocales($tabla, $item, $valor){
      if($item == "nombre"){
        $stmt = Conexion::conectarLocal()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
        $stmt -> bindParam(":valor", $valor);
        $stmt -> execute();
        return $stmt -> fetch();
      }else{
        $stmt = Conexion::conectarLocal()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
        $stmt -> bindParam(":valor", $valor);
        $stmt -> execute();
        return $stmt -> fetchAll();
      }
      $stmt->close();
      $stmt = null;

		}
		static public function mdlMostrarLocal($tabla, $item, $valor){

      $stmt = Conexion::conectarLocal()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
      $stmt -> bindParam(":valor", $valor);
      $stmt -> execute();
      return $stmt -> fetch();

      $stmt->close();
      $stmt = null;

		}


	}

?>
