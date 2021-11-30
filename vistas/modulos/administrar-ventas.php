<?php

if ($_SESSION['perfil'] == 'Especial') {

  echo '<script>
    window.location = "inicio";
  </script>';
  return;

}

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar ventas </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$frontend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar ventas </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <a href="crear-venta">
          <button class="btn btn-primary">
            Agregar venta
          </button>
        </a>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive tablaAdministrarVentas">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Código ID</th>
              <th>Cliente</th>
              <th>Vendedor</th>
              <th>Forma de pago</th>
              <th>Neto</th>
              <th>Total</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>

<?php $eliminarVenta = new ControladorVentas(); $eliminarVenta -> ctrEliminarVenta(); ?>