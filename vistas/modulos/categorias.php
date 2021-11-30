<?php

if ($_SESSION['perfil'] == 'Vendedor') {

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
          <h1>Administrar categorías</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$frontend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar categorías</li>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
          Agregar categoría
        </button>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive tablaCategorias">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Categoria</th>
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

<!-- -------------------------------------------------------------------------- */
/*                            MODAL AGREGAR CATEGORIA                           */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalAgregarCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Agregar categoría</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-th"></i></span>
              </div>
              <input type="text" class="form-control input-lg nuevaCategoria" name="nuevaCategoria" placeholder="Ingresar categoría" required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Categoria</button>
        </div>
        <?php $crearCategoria = new ControladorCategorias(); $crearCategoria -> ctrCrearCategorias(); ?>
      </form>
    </div>
  </div>
</div>

<!-- --------------------- End of MODAL AGREGAR CATEGORIA --------------------- -->

<!-- -------------------------------------------------------------------------- */
/*                            MODAL EDITAR CATEGORIA                            */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalEditarCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Editar categoría</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-th"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>
              <input type="hidden"  name="idCategoria" id="idCategoria" required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Editar Categoria</button>
        </div>
        <?php $editarCategoria = new ControladorCategorias(); $editarCategoria -> ctrEditarCategoria(); ?>
      </form>
    </div>
  </div>
</div>

<!-- ---------------------- End of MODAL EDITAR CATEGORIA --------------------- -->

<?php $borrarCategoria = new ControladorCategorias(); $borrarCategoria -> ctrBorrarCategoria(); ?>