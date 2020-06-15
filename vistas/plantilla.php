<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Atel Inventory</title>
<script src="vistas/plugins/jquery/jquery.min.js"></script>
  <link rel="icon" href="vistas/img/icon.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="vistas/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="vistas/plugins/summernote/summernote-bs4.css">
  <!-- pretty checkbox -->
  <link rel="stylesheet" href="vistas/plugins/pretty_checkbox/pretty-checkbox.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <!-- <link rel="stylesheet" href="vistas/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables.net-bs/css/responsive.bootstrap.min.css"> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
<script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>


  <!-- jQuery -->

 <script src="vistas/plugins/sweetalert2/sweetalert2.all.min.js"></script>

 <!-- DataTables -->
 <!-- <script src="vistas/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
 <script src="vistas/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
 <script src="vistas/plugins/datatables.net-bs/js/dataTables.responsive.min.js"></script>
 <script src="vistas/plugins/datatables.net-bs/js/responsive.bootstrap.min.js"></script> -->

  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="vistas/plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="vistas/css/header.css">
  <link rel="stylesheet" href="vistas/css/e11.css">
  <link rel="stylesheet" href="vistas/css/e29pb.css">
  <link rel="stylesheet" href="vistas/css/e29pa.css">
  <link rel="stylesheet" href="vistas/css/e31pb.css">
  <link rel="stylesheet" href="vistas/css/sala-a.css">
  <link rel="stylesheet" href="vistas/css/sala-b.css">
  <link rel="stylesheet" href="vistas/css/e40.css">
  <link rel="stylesheet" href="vistas/css/e31pa.css">

</head>
<?php
  function imprimirModal(){
    if($_SESSION["nivelAcceso"] == 2){
      return 'data-toggle="modal" data-target="#modal-reportePosicion"';
    }else if($_SESSION["nivelAcceso"] == 1 || $_SESSION["nivelAcceso"] == 999){
      return 'data-toggle="modal" data-target="#modal-reportePosicionSistemas"';
    }else{
      return "";
    }
  }

?>
<?php

if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" && isset($_SESSION["nivelAcceso"]))
{
  $_SESSION["modal"] = imprimirModal();
  echo '<body class="hold-transition sidebar-mini layout-fixed">';
  echo '<div class="wrapper">';

  if($_SESSION["idPlaza"] == 1){
    include "modulos/header.php";
    include "modulos/sidebar.php";
    include "modulos/modals.php";

    if(isset($_GET["ruta"])){

         if($_GET["ruta"] == "sala-a" ||
            $_GET["ruta"] == "sala-b" ||
            $_GET["ruta"] == "bitacoraSolicitudes" ||
            $_GET["ruta"] == "descargaSolicitudes" ||
            $_GET["ruta"] == "logout" ){

            $_SESSION["localActual"] = $_GET["ruta"];
            $localActual = ControladorLocales::ctrMostrarLocales("nombre", $_GET["ruta"]);
            $_SESSION["idLocalActual"] = $localActual["id"];
           include "modulos/".$_GET["ruta"].".php";
         }else{
           include "modulos/404.php";
         }
     }else{
       include "modulos/sala-a.php";
     }

    echo '</div>';
  }else if($_SESSION["idPlaza"] == 2){
    include "modulos/header.php";
    include "modulos/sidebar.php";
    include "modulos/modals.php";

    if(isset($_GET["ruta"])){

         if($_GET["ruta"] == "e11" ||
            $_GET["ruta"] == "e29pb" ||
            $_GET["ruta"] == "e29pa" ||
            $_GET["ruta"] == "e31pb" ||
            $_GET["ruta"] == "e40" ||
            $_GET["ruta"] == "e31pa" ||
            $_GET["ruta"] == "bitacoraSolicitudes" ||
            $_GET["ruta"] == "descargaSolicitudes" ||

           $_GET["ruta"] == "logout" ){
             $_SESSION["localActual"] = $_GET["ruta"];
             $localActual = ControladorLocales::ctrMostrarLocales("nombre", $_GET["ruta"]);
             $_SESSION["idLocalActual"] = $localActual["id"];
           include "modulos/".$_GET["ruta"].".php";
         }else{
           include "modulos/404.php";
         }
     }else{
       include "modulos/e11.php";
     }

    echo '</div>';
  }

}else{
    include "modulos/login.php";
}
 ?>


 <!-- jQuery UI 1.11.4 -->
 <script src="vistas/plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
   $.widget.bridge('uibutton', $.ui.button)
 </script>
 <!-- Bootstrap 4 -->
 <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- ChartJS -->
 <script src="vistas/plugins/chart.js/Chart.min.js"></script>
 <!-- Sparkline -->
 <!-- <script src="vista/plugins/sparklines/sparkline.js"></script> -->
 <!-- JQVMap -->
 <script src="vistas/plugins/jqvmap/jquery.vmap.min.js"></script>
 <script src="vistas/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
 <!-- jQuery Knob Chart -->
 <script src="vistas/plugins/jquery-knob/jquery.knob.min.js"></script>
 <!-- daterangepicker -->
 <script src="vistas/plugins/moment/moment.min.js"></script>
 <script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
 <!-- Tempusdominus Bootstrap 4 -->
 <script src="vistas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
 <!-- Summernote -->
 <script src="vistas/plugins/summernote/summernote-bs4.min.js"></script>
 <!-- overlayScrollbars -->
 <script src="vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- AdminLTE App -->
 <script src="vistas/dist/js/adminlte.js"></script>
 <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 <script src="vistas/dist/js/pages/dashboard.js"></script>
 <!-- AdminLTE for demo purposes -->
 <script src="vistas/dist/js/demo.js"></script>
 <script src="vistas/js/modals.js"></script>
 <script src="vistas/js/header.js"></script>







 <!-- Ekko Lightbox -->
 <script src="vistas/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

 <!-- Filterizr-->
 <script src="vistas/plugins/filterizr/jquery.filterizr.min.js"></script>
 <!-- Page specific script -->
 <script>
   $(function () {
     $(document).on('click', '[data-toggle="lightbox"]', function(event) {
       event.preventDefault();
       $(this).ekkoLightbox({
         alwaysShowClose: true
       });
     });

     $('.filter-container').filterizr({gutterPixels: 3});
     $('.btn[data-filter]').on('click', function() {
       $('.btn[data-filter]').removeClass('active');
       $(this).addClass('active');
     });
   })
 </script>






</body>
</html>
