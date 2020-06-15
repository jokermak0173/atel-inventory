<script>

var idPlaza = '<?php echo $_SESSION["idPlaza"];?>';

$(document).ready(function(){
  function mostrarTablaSolicitudes(idPlaza){
    $('.tablaSolicitudes').DataTable( {

      "ajax": "ajax/dataTableSolicitudes.ajax.php?idPlaza="+idPlaza,
      "language": {

    		"sProcessing":     "Procesando...",
    		"sLengthMenu":     "Mostrar&nbsp;&nbsp;  _MENU_  &nbsp;&nbsp;registros",
    		"sZeroRecords":    "No se encontraron resultados",
    		"sEmptyTable":     "Ningún dato disponible en esta tabla",
    		"sInfo":           "<br>Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    		"sInfoEmpty":      "<br>Mostrando registros del 0 al 0 de un total de 0",
    		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    		"sInfoPostFix":    "",
    		"sSearch":         "Buscar:",
    		"sUrl":            "",
    		"sInfoThousands":  ",",
    		"sLoadingRecords": "Cargando...",
    		"oPaginate": {
    		"sFirst":    "Primero",
    		"sLast":     "Último",
    		"sNext":     "Siguiente",
    		"sPrevious": "Anterior"
    		},
    		"oAria": {
    			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
    			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
    		}

    	}

   } );
  }
  mostrarTablaSolicitudes(idPlaza);

});
</script>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Historico solicitudes</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Reportes</a></li>
            <li class="breadcrumb-item active">Historico solicitudes</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

        </div>
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablaSolicitudes" width="100%">
<!-- º         <table class="display nowrap dataTable tablaSolicitudes dtr-inline collapsed" width="100%"> -->
                <thead>
                    <tr>
                        <th>Local</th>
                        <th>Posicion</th>
                        <th>Reporta</th>
                        <th>Componente</th>
                        <th>Fecha Reporte</th>
                        <th>Atiende</th>
                        <th>Fecha cambio</th>
                        <th>Estado</th>

                    </tr>
                </thead>
                <tbody>

                </tbody>
          </table>
        </div>
        <!-- /.box-body -->

      </div>


    </section>
