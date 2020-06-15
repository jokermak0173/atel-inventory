<?php
include "controladores/plantilla.controlador.php";
include "controladores/usuarios.controlador.php";
include "controladores/componentes.controlador.php";
include "controladores/solicitudes.controlador.php";
include "controladores/locales.controlador.php";
include "controladores/notificaciones.controlador.php";

include "modelos/usuarios.modelo.php";
include "modelos/plazas.modelo.php";
include "modelos/componentes.modelo.php";
include "modelos/solicitudes.modelo.php";
include "modelos/locales.modelo.php";
include "modelos/notificaciones.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
