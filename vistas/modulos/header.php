<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item" style="display:flex; flex-direction: row;">
      <a href="#" class="nav-link" style="padding-right: 0px;"><?php echo $_SESSION["puesto"].":"; ?></a>
      <a href="#" class="nav-link" style="padding-left: 10px;"><?php echo $_SESSION["nombreCompleto"]; ?></a>
    </li>
    <li class="nav-item" style="margin-left:40px;margin-right:10px; display:flex; flex-direction: row;">
      <a href="#" class="nav-link" style="padding-right: 0px;"><?php echo "Plaza:"; ?></a>
      <a href="#" class="nav-link" style="padding-left: 10px;"><?php echo ucwords(strtolower($_SESSION["nombrePlaza"])); ?></a>
    </li>

  </ul>


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto " id="box-navBar">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown" id="box-notifications">
      <a  id="campanaNotificaciones" class="nav-link" data-toggle="dropdown" href="#" style="font-size: 22px;">
        <i class="far fa-bell"></i>
        <?php
          // if($_SESSION["nivelAcceso"] == 1){
          //   $notificaciones = ControladorNotificaciones::ctrMostrarNotificacionesUsuarioSistemas("usuario", $_SESSION["numemp"]);
          // }else if($_SESSION["nivelAcceso"] == 2){
          //   $notificaciones = ControladorNotificaciones::ctrMostrarNotificacionesUsuarioSupervisor("usuario", $_SESSION["numemp"]);
          // }
          $notificaciones = ControladorNotificaciones::ctrMostrarNotificacionesUsuarioSistemas("usuario", $_SESSION["numemp"]);
          $numNotificaciones = 0;
          foreach ($notificaciones as $key => $value) {
            if($value["estado"] == 'no-visto'){
              $numNotificaciones++;
            }
          }
          if($numNotificaciones > 0){
            echo '<span id="spanCampanita" class="badge badge-danger navbar-badge" style="font-size: 12px;">'.$numNotificaciones.'</span>';
          }else{
            echo '<span id="spanCampanita" class="badge badge-danger navbar-badge" style="font-size: 12px;"></span>';
          }
         ?>

      </a>
      <div id="menuNotificaciones" class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php
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
        ?>

      </div>
    </li>
    <!-- Notifications Dropdown Menu -->

    <li class="nav-item d-flex align-items-center "  id="box-logout-button">
      <a href="logout" class="logout-button" style="font-size: 20px;"><i class="fas fa-power-off"></i></a>
      <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fas fa-th-large"></i> -->
      </a>
    </li>
  </ul>
</nav>

<script type="text/javascript">
$('#campanaNotificaciones').click(function(){
  var numemp = '<?php echo $_SESSION["numemp"];?>';
  var estado = 'visto';
  var datos = new FormData();
  datos.append("notificacionesVistas", true);
  datos.append("usuario", numemp);
  datos.append("estado", estado);
  $.ajax({
  url:"ajax/notificaciones.ajax.php",
  method: "post",
  data: datos,
  cache: false,
  contentType: false,
  processData: false,
  success: function(respuesta){
      $('#spanCampanita').text('')
    }
  })
});
  setInterval(function(){
  $('.borrar').remove();
  var usuario = '<?php echo $_SESSION["numemp"];?>';
  var datos1 = new FormData();
  datos1.append("cuentaNotificacionesUsuario", true);
  datos1.append("usuario", usuario);

  $.ajax({
  url:"ajax/notificaciones.ajax.php",
  method: "post",
  data: datos1,
  cache: false,
  contentType: false,
  processData: false,
  success: function(respuesta){
    //console.log(respuesta);
      if(respuesta > 0){
        $('#spanCampanita').remove();
        $('#campanaNotificaciones').append('<span id="spanCampanita" class="badge badge-danger navbar-badge" style="font-size: 12px;">'+respuesta+'</span>');
      }
      else{
        $('#spanCampanita').remove();
        $('#campanaNotificaciones').append('<span id="spanCampanita" class="badge badge-danger navbar-badge" style="font-size: 12px;"></span>');
      }

  }
  })

  var datos = new FormData();
  datos.append("notificacionesUsuario", true);
  datos.append("usuario", usuario);
  $.ajax({
  url:"ajax/notificaciones.ajax.php",
  method: "post",
  data: datos,
  cache: false,
  contentType: false,
  processData: false,
  success: function(respuesta){
    if(respuesta){
      $('#menuNotificaciones').append(respuesta);
    }

  }
  })
}, 10000);

</script>
