<?php $frontend = Ruta::Frontend(); session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sistema POS | BSweb</title>
  <link rel="icon" href="vistas/img/plantilla/icono.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- jQuery -->
  <script src="vistas/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="vistas/dist/js/demo.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- DataTables  & Plugins -->
  <script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="vistas/plugins/jszip/jszip.min.js"></script>
  <script src="vistas/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="vistas/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
</head>
<?php if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'ok'): ?>
  <body class="hold-transition sidebar-mini sidebar-collapse">
<?php else: ?>
  <body class="hold-transition login-page">
<?php endif ?>
<!-- Site wrapper -->
<?php

  if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'ok') {

    echo '<div class="wrapper">';
      include_once 'modulos/header.php';
      include_once 'modulos/lateral.php';

      if (isset($_GET['ruta'])) {

        if ($_GET['ruta'] == 'inicio' ||
            $_GET['ruta'] == 'perfiles' ||
            $_GET['ruta'] == 'categorias' ||
            $_GET['ruta'] == 'productos' ||
            $_GET['ruta'] == 'clientes' ||
            $_GET['ruta'] == 'administrar-ventas' ||
            $_GET['ruta'] == 'crear-venta' ||
            $_GET['ruta'] == 'reportes' ||
            $_GET['ruta'] == 'salir' ||
            $_GET['ruta'] == 'editar-venta') {

          include_once 'modulos/'.$_GET['ruta'].'.php';

        } else { include_once 'modulos/404.php'; }

      } else { include_once 'modulos/inicio.php'; }

      include_once 'modulos/footer.php';

    echo '</div>';

  } else { include_once 'modulos/login.php'; }

?>
  <script src="vistas/js/perfiles.js"></script>
</body>
</html>
