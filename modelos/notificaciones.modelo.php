<?php

require_once "conexion.php";

class ModeloNotificaciones {

  static public function mdlMostrarNotificacionesUsuarioSistemas($tabla, $item1, $valor1){
    $stmt = Conexion::conectarLocal()->prepare("SELECT * FROM $tabla  where $item1 = :valor1 AND estado = 'no-visto' ORDER BY fecha DESC");
    $stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
    $stmt -> execute();
    $notificacionesNoVistas = $stmt -> fetchAll();

    $stmtNotificacionesVistas = Conexion::conectarLocal()->prepare("SELECT * FROM $tabla  where $item1 = :valor1 AND estado = 'visto' ORDER BY fecha DESC LIMIT 5");
    $stmtNotificacionesVistas -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
    $stmtNotificacionesVistas -> execute();
    $notificacionesVistas = $stmtNotificacionesVistas -> fetchAll();
    if($notificacionesNoVistas){
      $mergedArrays = array_merge($notificacionesNoVistas, $notificacionesVistas);
      return $mergedArrays;
    }else{
      return $notificacionesVistas;
    }


    $stmtNotificacionesVistas->close();
    $stmtNotificacionesVistas = null;
    $stmt->close();
    $stmt = null;
  }

  static public function mdlNotificacionesVistas($tabla, $item1, $valor1, $item2, $valor2){
      $stmt = Conexion::conectarLocal()->prepare("UPDATE $tabla SET $item2 = :valor2 WHERE $item1 = :valor1 AND estado = 'no-visto'");
      $ar = fopen("mdlNotificacionesVistas.txt", "w");
      fwrite($ar, "UPDATE $tabla SET $item2 = $valor2 WHERE $item1 = $valor1 AND estado = 'no-visto'");
      fclose($ar);
      $stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
      $stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
      $stmt -> execute();
      $stmt = null;
  }
}

 ?>
