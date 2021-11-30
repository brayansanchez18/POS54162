<?php

if ($_SESSION['perfil'] == 'Especial' || $_SESSION['perfil'] == 'Vendedor') {

  echo '<script>
    window.location = "inicio";
  </script>';
  return;

}

?>
<?php $item = null;
$valor = null;

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$frontend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar Usuarios</li>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          Agregar usuario
        </button>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive tablaUsuarios" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Último Ingreso</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($usuarios as $key => $value): ?>
              <tr>
                <td><?=($key+1)?></td>
                <td class="text-capitalize"><?=$value['nombre']?></td>
                <td><?=$value['usuario']?></td>
                <?php if ($value['foto'] != ''): ?>
                  <td><img src="<?=$value['foto']?>" class="img-thumbnail" width="40px"></td>
                <?php else: ?>
                  <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <?php endif ?>
                <td class="text-capitalize"><?=$value['perfil']?></td>

                <?php if ($value['estado'] != 0): ?>
                  <td><button class="btn btn-success btn-xs btnActivar" idUsuario="<?=$value['id']?>" estadoUsuario="0">Activado</button></td>
                <?php else: ?>
                  <td><button class="btn btn-danger btn-xs btnActivar" idUsuario="<?=$value['id']?>" estadoUsuario="1">Desactivado</button></td>
                <?php endif ?>

                <td><?=$value['ultimologin']?></td>

                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarUsuario" idUsuario="<?=$value['id']?>" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-edit"></i></button>

                    <button class="btn btn-danger btnEliminarUsuario" idUsuario="<?=$value['id']?>" fotoUsuario="<?=$value['foto']?>" usuario="<?=$value['usuario']?>"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- -------------------------------------------------------------------------- */
/*                            MODAL AGREGAR USUARIO                           */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalAgregarUsuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Agregar usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
              </div>
              <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-key"></i></span>
              </div>
              <select class="form-control input-lg" name="nuevoPerfil">
                <option value="">Selecionar perfil</option>
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>

            <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto form-control input-lg" name="nuevaFoto">
              <p class="help-block">Peso máximo de la foto 5MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Agregar Perfil</button>
        </div>

        <?php $crearUsuario = new ControladorUsuarios(); $crearUsuario -> ctrCrearUsuario(); ?>
      </form>
    </div>
  </div>
</div>

<!-- ---------------------- End of MODAL AGREGAR USUARIO ---------------------- -->

<!-- -------------------------------------------------------------------------- */
/*                             MODAL EDITAR USUARIO                             */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalEditarUsuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Editar usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
              <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
              </div>
              <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">
              <input type="hidden" id="passwordActual" name="passwordActual">
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-key"></i></span>
              </div>
              <select class="form-control input-lg" name="editarPerfil">
                <option value="" id="editarPerfil"></option>
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>

            <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto form-control input-lg" name="editarFoto">
              <input type="hidden" name="fotoActual" id="fotoActual">
              <p class="help-block">Peso máximo de la foto 5MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Perfil</button>
        </div>

        <?php $editarUsuario = new ControladorUsuarios(); $editarUsuario -> ctrEditarUsuario(); ?>
      </form>
    </div>
  </div>
</div>

<!-- ----------------------- End of MODAL EDITAR USUARIO ---------------------- -->

<?php $borrarUsuario = new ControladorUsuarios(); $borrarUsuario -> ctrBorrarUsuario(); ?>