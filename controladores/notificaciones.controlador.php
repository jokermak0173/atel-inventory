<?php

class ControladorNotificaciones{

  public function ctrMostrarNotificacionesUsuarioSistemas($item1, $valor1){
    $tabla = "notificaciones";
    $notificaciones = ModeloNotificaciones::mdlMostrarNotificacionesUsuarioSistemas($tabla, $item1, $valor1);
    return $notificaciones;
  }

  public function ctrNotificacionesVistas($item1, $valor1, $item2, $valor2){
    $tabla = "notificaciones";
    $notificaciones = ModeloNotificaciones::mdlNotificacionesVistas($tabla, $item1, $valor1, $item2, $valor2);

  }
}

 ?>
