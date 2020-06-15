<?php
require_once "conexion.php";

class ModeloSolicitudes{
  static public function mdlAgregarSolicitud($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5){
    $stmt = Conexion::conectarLocal()->prepare("INSERT INTO $tabla ($item1, $item2, $item3, $item4, $item5, estado) VALUES (:valor1, :valor2, :valor3, :valor4, :valor5, 'enviado')");

    $stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
    $stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);
    $stmt -> bindParam(":valor3", $valor3, PDO::PARAM_INT);
    $stmt -> bindParam(":valor4", $valor4, PDO::PARAM_INT);
    $stmt -> bindParam(":valor5", $valor5, PDO::PARAM_STR);
    if($stmt->execute()){
      $stmtCallBack = Conexion::conectarLocal()->prepare("SELECT id FROM solicitud_cambio WHERE usuario_reporta = $item3 ORDER BY fecha_reporte DESC");
      $stmtCallBack->execute();
      $idSolicitud = $stmtCallBack -> fetch();
      $idInsertar = $idSolicitud["id"];
      $usuariosSistemasActivos = ModeloUsuarios::mdlMostrarUsuariosActivos("usuario", "status_usuario", 1, "nivel_acceso", 1, "plaza", $_SESSION["idPlaza"]);

      foreach ($usuariosSistemasActivos as $key => $value) {
          $numemp = $value['numemp'];
          $stmtNotificacion = Conexion::conectarLocal()->prepare("INSERT INTO notificaciones (solicitud, usuario, estado, estado_solicitud) VALUES ($idInsertar, $numemp, 'no-visto', 'enviado')");
          $stmtNotificacion->execute();
      }
      return "ok";
    }else{
      return $stmt->errorInfo();
    }
    $stmt->close();
    $stmt = null;
  }

  static public function mdlCambioComponenteSistemas($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5, $item6, $valor6, $item7, $valor7, $item8, $valor8, $item9, $valor9){
    $stmt = Conexion::conectarLocal()->prepare("INSERT INTO $tabla ($item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9, estado) VALUES (:valor1, :valor2, :valor3, :valor4, :valor5, :valor6, :valor7, :valor8, :valor9, 'cambiado')");

    $stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
    $stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);
    $stmt -> bindParam(":valor3", $valor3, PDO::PARAM_INT);
    $stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);
    $stmt -> bindParam(":valor5", $valor5, PDO::PARAM_INT);
    $stmt -> bindParam(":valor6", $valor6, PDO::PARAM_STR);
    $stmt -> bindParam(":valor7", $valor7, PDO::PARAM_INT);
    $stmt -> bindParam(":valor8", $valor8, PDO::PARAM_STR);
    $stmt -> bindParam(":valor9", $valor9, PDO::PARAM_STR);
    if($stmt->execute()){
      return "ok";
    }else{
      return $stmt->errorInfo();
    }
    $stmt->close();
    $stmt = null;
  }

  static public function mdlCancelarSolicitud($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3){
    $stmt = Conexion::conectarLocal()->prepare("UPDATE $tabla SET $item1 = :valor1, $item2 = :valor2 WHERE $item3 = :valor3");
    $stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
    $stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);
    $stmt -> bindParam(":valor3", $valor3, PDO::PARAM_INT);
    if($stmt->execute()){

      $stmtCallBack = Conexion::conectarLocal()->prepare("SELECT * FROM solicitud_cambio WHERE id = $valor3 ");
      $stmtCallBack->execute();
      $solicitud = $stmtCallBack -> fetch();
      $supervisor = $solicitud["usuario_reporta"];
      $local = $solicitud["local"];
      $idInsertar = $valor3;

      $plaza = ModeloLocales::mdlMostrarLocal("locales", "id", $local);

      $usuariosSistemasActivos = ModeloUsuarios::mdlMostrarUsuariosActivos("usuario", "status_usuario", 1, "nivel_acceso", 1, "plaza", $plaza["plaza"]);
      $stmtNotificacionSupervisor = Conexion::conectarLocal()->prepare("INSERT INTO notificaciones (solicitud, usuario, estado, estado_solicitud) VALUES ($idInsertar, $supervisor, 'no-visto', 'cancelado')");
      $stmtNotificacionSupervisor->execute();


      foreach ($usuariosSistemasActivos as $key => $value) {
          $numemp = $value['numemp'];
          if($numemp != $valor2){
          $stmtNotificacion = Conexion::conectarLocal()->prepare("INSERT INTO notificaciones (solicitud, usuario, estado, estado_solicitud) VALUES ($idInsertar, $numemp, 'no-visto', 'cancelado')");
          $stmtNotificacion->execute();
        }
      }
      return "ok";
    }else{
      return $stmt->errorInfo();
    }
    $stmt->close();
    $stmt = null;
  }

  static public function mdlMostrarSolicitudesEnviadas($tabla, $item1, $valor1, $item2, $valor2){
    $stmt = Conexion::conectarLocal()->prepare("SELECT posicion, COUNT(*) solicitudes FROM $tabla WHERE $item1 = :valor1 AND $item2=:valor2 GROUP BY posicion");
    $stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
    $stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);

    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt->close();
    $stmt = null;
  }

  static public function mdlMostrarSolicitudPosicion($tabla, $item1, $valor1, $item2, $valor2){
    if($valor2 == "enviado"){
      $stmt = Conexion::conectarLocal()->prepare("SELECT * FROM $tabla WHERE $item1=:valor1 AND $item2 = :valor2 ORDER BY fecha_reporte DESC");
    }else if($valor2 == "cambiado"){
      $stmt = Conexion::conectarLocal()->prepare("SELECT * FROM $tabla WHERE $item1=:valor1 AND $item2 = :valor2 ORDER BY fecha_reporte DESC LIMIT 5");
    }
    //$stmt = Conexion::conectarLocal()->prepare("SELECT * FROM $tabla WHERE $item1=:valor1 AND $item2 = :valor2 ORDER BY fecha_reporte DESC LIMIT 5");
    $stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
    $stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt->close();
    $stmt = null;
  }

  static public function mdlEditarSolicitud($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4){
    $stmt = Conexion::conectarLocal()->prepare("UPDATE $tabla SET $item2 = :valor2, $item3 = :valor3, $item4 = :valor4 WHERE $item1 = :valor1");

    $stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
    $stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);
    $stmt -> bindParam(":valor3", $valor3, PDO::PARAM_STR);
    $stmt -> bindParam(":valor4", $valor4, PDO::PARAM_STR);

    if($stmt->execute()){
      $stmtCallBack = Conexion::conectarLocal()->prepare("SELECT * FROM solicitud_cambio WHERE id = $valor1");
      $stmtCallBack->execute();
      $solicitud = $stmtCallBack -> fetch();
      $supervisor = $solicitud['usuario_reporta'];
      $idInsertar = $valor1;
      $usuariosSistemasActivos = ModeloUsuarios::mdlMostrarUsuariosActivos("usuario", "status_usuario", 1, "nivel_acceso", 1, "plaza", $_SESSION["idPlaza"]);
      $stmtNotificacionSupervisor = Conexion::conectarLocal()->prepare("INSERT INTO notificaciones (solicitud, usuario, estado, estado_solicitud) VALUES ($idInsertar, $supervisor, 'no-visto', 'cambiado')");
      $stmtNotificacionSupervisor->execute();
      foreach ($usuariosSistemasActivos as $key => $value) {
          $numemp = $value['numemp'];
          if($numemp != $_SESSION["numemp"]){
            $stmtNotificacion = Conexion::conectarLocal()->prepare("INSERT INTO notificaciones (solicitud, usuario, estado, estado_solicitud) VALUES ($idInsertar, $numemp, 'no-visto', 'cambiado')");
            $stmtNotificacion->execute();
          }

      }

      return "ok";
    }else{
      return $stmt->errorInfo();
    }
    $stmt->close();
    $stmt = null;
  }

  static public function mdlMostrarSolicitudesPlaza($item, $valor){

    $stmt = Conexion::conectarLocal()->prepare("SELECT * FROM solicitud_cambio SC INNER JOIN locales L ON SC.local = L.id WHERE $item = :valor");
    $stmt -> bindParam(":valor", $valor, PDO::PARAM_INT);
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt->close();
    $stmt = null;
  }

  static public function mdlMostrarSolicitud($tabla, $item, $valor){

    $stmt = Conexion::conectarLocal()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
    $stmt -> bindParam(":valor", $valor, PDO::PARAM_INT);
    $stmt -> execute();
    return $stmt -> fetch();
    $stmt->close();
    $stmt = null;
  }

  static public function mdlMostrarSolicitudesPorFechas($fecha1, $fecha2, $valor){
    $stmt = Conexion::conectarLocal()->prepare("SELECT * FROM solicitud_cambio SC INNER JOIN locales L ON SC.local = L.id WHERE (SC.fecha_reporte BETWEEN :fecha1 AND :fecha2) AND L.plaza = :valor");
    $stmt -> bindParam(":fecha1", $fecha1, PDO::PARAM_STR);
    $stmt -> bindParam(":fecha2", $fecha2, PDO::PARAM_STR);
    $stmt -> bindParam(":valor", $valor, PDO::PARAM_INT);
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt->close();
    $stmt = null;
  }
}

 ?>
