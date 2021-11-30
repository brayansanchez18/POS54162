<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Panel de Control</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$frontend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Panel de Control</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <?php if ($_SESSION['perfil'] == 'Administrador'): ?>
        <?php include_once 'inicio/cajas-superiores.php'; ?>
      <?php endif ?>
    </div>

    <div class="row">
      <div class="col-12">
        <?php if ($_SESSION['perfil'] == 'Administrador'): ?>
          <?php include_once 'reportes/grafico-ventas.php'; ?>
        <?php endif ?>
      </div>

      <div class="col-12 col-lg-6">
        <?php if ($_SESSION['perfil'] == 'Administrador'): ?>
          <?php include_once 'reportes/productos-mas-vendidos.php'; ?>
        <?php endif ?>
      </div>

      <div class="col-12 col-lg-6">
        <?php if ($_SESSION['perfil'] == 'Administrador'): ?>
          <?php include_once 'inicio/productos-recientes.php'; ?>
        <?php endif ?>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->