<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reportes</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Reportes</a></li>
            <li class="breadcrumb-item active">Descargas</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
     <!-- container -->
<section class="content">
 <div class="container-fluid">

   <div class="card card-primary">

     <div class="card-body">

           <div class="formulario">
               <table>
                   <tbody>
                     <form role="form" method="post" enctype="multipart/form-data">
                       <tr>
                           <td class="table-title" style="text-align:center">Fecha Inicio</td>
                           <td class="table-title" style="text-align:center">Fecha Fin</td>

                       </tr>
                       <tr>
                           <td class="table-body"><input type="date" class="form-control" name="fechaInicio"></td>
                           <td class="table-body"><input type="date" class="form-control" name="fechaFin"></td>

                       </tr>
                       <tr>
                           <td colspan="5" style="text-align:right">
                               <button class="table-btn"><i class="fas fa-save"></i> <span>Descargar</span></button>
                           </td>
                       </tr>
                       <?php

                        $descargarArchivo = new ControladorSolicitudes();
                        $descargarArchivo->ctrDescargarReporte();

                      ?>
                     </form>
                   </tbody>
               </table>
           </div>

</div>
</div>

 </div>
</section>
</div>
