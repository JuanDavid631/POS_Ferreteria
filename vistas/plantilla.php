<?php
 session_start();

 if(isset($_GET["cerrar_sesion"]) && $_GET["cerrar_sesion"] == 1) {
  session_destroy();
  echo '<script>
         window.location = "http://localhost/POS_Ferreteria/"
        </script>';
 }
?>

<!DOCTYPE html>
<html lang="es">

<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Sistema Integral</title>

 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

 <!-- Image Page -->
 <link rel="shortcut icon" href="vistas/assets/dist/img/puerta.png" type="image/x-icon">

 <!-- ============================================================================================================= -->
 <!-- REQUIRED CSS -->
 <!-- ============================================================================================================= -->
 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

 <!-- Font Awesome Icons -->
 <link rel="stylesheet" href="vistas/assets/plugins/fontawesome-free/css/all.min.css">

 <!-- Ionicons -->
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

 <!-- SweetAlert2 -->
 <link rel="stylesheet" href="vistas/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

 <!-- Jquery CSS -->
 <link rel="stylesheet" href="vistas/assets/plugins/jquery-ui/css/jquery-ui.css">

 <!-- Bootstrap 5 -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

 <!-- JSTREE CSS -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

 <!-- ============================================================
 =ESTILOS PARA USO DE DATATABLES JS
 ===============================================================-->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">

 <!-- ============================================================================================================= -->
 <!-- REQUIRED SCRIPTS -->
 <!-- ============================================================================================================= -->
 <!-- jQuery -->
 <script src="vistas/assets/plugins/jquery/jquery.min.js"></script>

 <!-- Bootstrap 4 -->
 <script src="vistas/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- ChartJS -->
 <script src="vistas/assets/plugins/chart.js/Chart.min.js"></script>

 <!-- SweetAlert2 -->
 <script src="vistas/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

 <!-- JQuery JS -->
 <script src="vistas/assets/plugins/jquery-ui/js/jquery-ui.js"></script>

 <!-- JS Bootstrap 5 -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

 <!-- InputMask -->
 <script src="vistas/assets/plugins/moment/moment.min.js"></script>
 <script src="vistas/assets/plugins/inputmask/jquery.inputmask.min.js"></script>

 <!-- JSTREE JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

 <!-- ============================================================
 ESTILOS PARA USO DE DATATABLES JS
 ===============================================================-->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
 <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

 <!-- ============================================================
 LIBRERIAS PARA EXPORTAR A ARCHIVOS
 ===============================================================-->
 <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>

 <!-- ============================================================
	ESTILOS PERSONALIZADOS
	===============================================================-->
 <!-- Theme style -->
 <link rel="stylesheet" href="vistas/assets/dist/css/adminlte.min.css">
 <link rel="stylesheet" href="vistas/assets/dist/css/plantillas.css">

 <!-- AdminLTE App -->
 <script src="vistas/assets/dist/js/adminlte.min.js"></script>
 <script src="vistas/assets/dist/js/plantilla.js"></script>

</head>

<?php if (isset($_SESSION["usuario"])) : ?>

<body class="hold-transition sidebar-mini layout-fixed">
 <div class="wrapper">
  <?php include "modulos/aside.php"; ?>
  <div class="content-wrapper">
   <?php include "vistas/" .$_SESSION["usuario"] -> vista ?>
  </div>
 </div>
 <script>
 function CargarContenido(pagina_php, contenedor) {
  $("." + contenedor).load(pagina_php);
 }
 </script>
</body>
<?php else : ?>

<body>
 <?php include "vistas/login.php"; ?>
</body>
<?php endif; ?>

</html>