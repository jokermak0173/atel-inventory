<?php


  require_once "../controladores/notificaciones.controlador.php";
	require_once "../modelos/notificaciones.modelo.php";

  require_once "../controladores/usuarios.controlador.php";
	require_once "../modelos/usuarios.modelo.php";

  require_once "../controladores/solicitudes.controlador.php";
	require_once "../modelos/solicitudes.modelo.php";

  require_once "../controladores/locales.controlador.php";
  require_once "../modelos/locales.modelo.php";

	class AjaxNotificaciones{

		public $usuario;
    public $estado;

		public function ajaxNotificacionesVistas(){

			$item1 = "usuario";
			$valor1 = $this->usuario;
			$item2 = "estado";
			$valor2 = $this->estado;
			ControladorNotificaciones::ctrNotificacionesVistas($item1, $valor1, $item2, $valor2);
			}

    public function ajaxNotificacionesUsuario(){
  		$item1 = "usuario";
  		$valor1 = $this->usuario;
  		$notificaciones = ControladorNotificaciones::ctrMostrarNotificacionesUsuarioSistemas($item1, $valor1);

      if($notificaciones){
        foreach ($notificaciones as $key => $value) {
          $solicitud = ControladorSolicitudes::ctrMostrarSolicitud("id", $value["solicitud"]);

          $local = ControladorLocales::ctrMostrarLocal("id", $solicitud["local"]);
          $fechaReporte = date_create($value["fecha"]);
          $fechaFormateada = date_format($fechaReporte,"d/m/Y H:i:s");
          switch($value["estado"]){
            case 'visto': $clase = "visto"; break;
            case 'no-visto': $clase = "no-visto"; break;
            default : $clase  = "";
          }
          switch($value["estado_solicitud"]){
            case 'enviado': $estrella = "text-warning";
                            $usuario = ControladorUsuarios::ctrMostrarUsuario("numemp", $solicitud["usuario_reporta"]);
                            $mostrarNombre = utf8_decode($usuario["nombre_completo"])." <p class='text-sm text-muted'>ha reportado una posicion</p>";
                            break;
            case 'cambiado': $estrella = "text-success";
                            $usuario = ControladorUsuarios::ctrMostrarUsuario("numemp", $solicitud["usuario_atiende"]);
                            $mostrarNombre = utf8_decode($usuario["nombre_completo"])." <p class='text-sm text-muted'>ha cambiado el componente</p>";
                            break;
            case 'cancelado': $estrella = "text-danger";
                            $usuario = ControladorUsuarios::ctrMostrarUsuario("numemp", $solicitud["usuario_atiende"]);
                            $mostrarNombre = utf8_decode($usuario["nombre_completo"])." <p class='text-sm text-muted'>ha cancelado la solicitud</p>";
                            break;
            default: $estrella = "text-info";
          }
          echo '<a id="campanaNotificaciones" href="'.$local["nombre"].'" class="dropdown-item '.$clase.' borrar">
                  <div class="media ">
                    <div class="media-body">
                      <h3 class="dropdown-item-title">
                        '.$mostrarNombre.'
                        <span class="float-right text-sm '.$estrella.'"><i class="fas fa-star"></i></span>
                      </h3>
                      <p class="text-sm">Posicion: '.$solicitud["posicion"].'</p>
                      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>'.$fechaFormateada.'</p>
                    </div>
                  </div>
                  <!-- Message End -->
                </a>';
      }


    }else{
      echo '<a id="campanaNotificaciones"  class="dropdown-item borrar">
              <div class="media ">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                      No hay notificiones por mostrar
                  </h3>

                </div>
              </div>
              <!-- Message End -->
            </a>';
    }
  	}

    public function ajaxCuentaNotificacionesUsuario(){
  		$item1 = "usuario";
  		$valor1 = $this->usuario;
  		$notificaciones = ControladorNotificaciones::ctrMostrarNotificacionesUsuarioSistemas($item1, $valor1);
      $contador = 0;
      foreach ($notificaciones as $key => $value) {
        if($value["estado"] == "no-visto")
        $contador++;
      }
      echo $contador;
    }


	}

	if(isset($_POST["notificacionesVistas"]) && isset($_POST["usuario"]) ){
		$actualizar = new AjaxNotificaciones();
		$actualizar -> usuario = $_POST["usuario"];
    $actualizar -> estado = $_POST["estado"];
		$actualizar -> ajaxNotificacionesVistas();
	}

  if(isset($_POST["notificacionesUsuario"]) && isset($_POST["usuario"]) ){
		$actualizar = new AjaxNotificaciones();
		$actualizar -> usuario = $_POST["usuario"];
		$actualizar -> ajaxNotificacionesUsuario();
	}

  if(isset($_POST["cuentaNotificacionesUsuario"]) && isset($_POST["usuario"]) ){
		$actualizar = new AjaxNotificaciones();
		$actualizar -> usuario = $_POST["usuario"];
		$actualizar -> ajaxCuentaNotificacionesUsuario();
	}

?>
