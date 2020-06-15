<div class="modal fade" id="modal-reportePosicion" tabindex="-1" role="dialog" aria-labelledby="modal-reportePosicion" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post">
          <div class="form-group ">
            <b>Posicion: </b><span id="modal-numeroPosicion"></span>
          </div>
          <div class="form-group">
            <input type="hidden" name="posicionCambio" value="" id="posicionCambio">
            <label for="componenteCambio" class="col-form-label">Solicitar cambio de:</label>
            <select class="form-control" name="componenteCambio" required>
              <?php
                $componentes = ControladorComponentes::ctrMostrarComponentes(null, "");
                var_dump($componentes);
                foreach ($componentes as $key => $value) {
                  echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                }
               ?>
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Comentario:</label>
            <textarea class="form-control"  id="message-text" name="comentarioCambio"></textarea>
          </div>
          <button type="submit" style="margin-left:330px" class="btn btn-primary">Solicitar cambio</button>
          <?php

            $eviarSolicitudCambio = new ControladorSolicitudes();
            $eviarSolicitudCambio -> ctrEnviarSolicitud();

          ?>
          </form>
          <div class="">
            <hr>
          </div>
          <div class="pretty p-icon p-round p-smooth trigger">
            <input type="checkbox" id="mostrarOcultarBody2"/>
            <div class="state p-success">
                <i class="icon mdi mdi-check"></i>
                <label>Registrar cambio manual</label>
            </div>
          </div>
      </div>

        <div id="modal-body2" class="hidden" style="padding: 0px 18px;">
          <form method="post">

            <div class="form-group">
              <input type="hidden" name="posicionCambioSistemas" value="" id="posicionCambioSupervisor">
              <label for="componenteCambio" class="col-form-label">Realizar cambio de diadema:</label>
              <select class="form-control" name="componenteCambioSistemas" required>
                <option value="3">Diadema</option>
                <option value="4">Adaptador (cacahuate)</option>
                <option value="7">Cable </option>
              </select>
            </div>
            <div class="form-group">

              <label for="motivoCambio" class="col-form-label">Motivo del cambio:</label>
              <select class="form-control" name="motivoCambio" required>
                <option value="">Selecciona opcion</option>
                <option value="Equipo nuevo">Equipo nuevo</option>
                <option value="Falla detectada">Falla detectada</option>
                <option value="Otro">Otro</option>
              </select>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Comentario:</label>
              <textarea class="form-control" id="message-text" name="comentarioCambioSistemas"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Registrar cambio</button>
            <?php

              // $confirmarCambioSistemas2 = new ControladorSolicitudes();
              // $confirmarCambioSistemas2 -> ctrCambioComponenteSistemas();

            ?>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

        </div>
      </div>


    </div>
  </div>
</div>


<div class="modal fade" id="modal-reportePosicionSistemas" tabindex="-1" role="dialog" aria-labelledby="modal-reportePosicion" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Resumen Posicion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


      </div>

      <?php

        $confirmarCambio = new ControladorSolicitudes();
        $confirmarCambio -> ctrConfirmarCambio();

      ?>
      <div style="padding: 0px 18px;">


        <div class="pretty p-icon p-round p-smooth trigger">
          <input type="checkbox" id="mostrarOcultarBody2"/>
          <div class="state p-success">
              <i class="icon mdi mdi-check"></i>
              <label>Registrar cambio manual</label>
          </div>
        </div>
    </div>

      <div id="modal-body2" class="hidden" style="padding: 0px 18px;">
        <form method="post">

          <div class="form-group">
            <input type="hidden" name="posicionCambioSistemas" value="" id="posicionCambio">
            <label for="componenteCambio" class="col-form-label">Realizar cambio de:</label>
            <select class="form-control" name="componenteCambioSistemas" required>
              <?php
                $componentes = ControladorComponentes::ctrMostrarComponentes(null, "");
                var_dump($componentes);
                foreach ($componentes as $key => $value) {
                  echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                }
               ?>
            </select>
          </div>
          <div class="form-group">

            <input type="hidden" name="posicionCambio" value="" id="posicionCambio">
            <label for="motivoCambio" class="col-form-label">Motivo del cambio:</label>
            <select class="form-control" name="motivoCambio" required>
              <option value="">Selecciona opcion</option>
              <option value="Equipo nuevo">Equipo nuevo</option>
              <option value="Falla detectada">Falla detectada</option>
              <option value="Otro">Otro</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Comentario:</label>
            <textarea class="form-control" id="message-text" name="comentarioCambioSistemas"></textarea>
          </div>
          <button type="submit" class="btn btn-success">Registrar cambio</button>
          <?php

            $confirmarCambioSistemas = new ControladorSolicitudes();
            $confirmarCambioSistemas -> ctrCambioComponenteSistemas();

          ?>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<?php
  echo '<script>$(document).on("click",".btnCancelarSolicitud",function(){
    var idSolicitud = $(this).attr("idSolicitud");
    var usuario = "'.$_SESSION["numemp"].'";

    swal({
        title: "¿Cancelar Solicitud?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "No",
        confirmButtonText: "Si"
      }).then(function(result){
        if (result.value) {


          var datos = new FormData();
          datos.append("cancelarSolicitud", true);
          datos.append("idSolicitud", idSolicitud);
          datos.append("usuario", usuario);


            $.ajax({
            url:"ajax/solicitudes.ajax.php",
            method: "post",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){
              if(respuesta == "ok"){
                swal({
                  title: "Solicitud Cancelada!",
                  type: "success",
                  confirmButtonText:"¡Cerrar!",
                }).then(function(result){
                  if(result.value){
                    location.reload(true)
                  }
                });
              }else{
                swal({
                  title: "Error al cancelar la solicitud!" + respuesta,
                  type: "error",
                  confirmButtonText:"¡Cerrar!",
                }).then(function(result){
                  if(result.value){
                    location.reload(true)
                  }
                });
              }
            }
          })

         }
      })
  })</script>';
 ?>
