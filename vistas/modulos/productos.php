<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar productos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$frontend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar productos</li>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
          Agregar producto
        </button>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive tablaProductos">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Imagen</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>Stock</th>
              <th>Precio de compra</th>
              <th>Precio de venta</th>
              <th>Agregado</th>
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
/*                           MODAL AGREGAR PRODUCTO                           */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalAgregarProducto">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Agregar producto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-th"></i></span>
              </div>

              <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                <option value="">Selecionar categoría</option>
                <?php
                $item = null;
                $valor = null;
                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                ?>

                <?php foreach ($categorias as $key => $value): ?>
                  <option value="<?=$value['id']?>"><?=$value['categoria']?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-code"></i></span>
              </div>

              <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Código" readonly>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-box"></i></span>
              </div>

              <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
              </div>

              <input type="number" class="form-control input-lg" name="nuevoStock" min="1" placeholder="Stock" required>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fa fa-arrow-up"></i></span>
                </div>

                <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>
              </div>
            </div>

            <div class="col-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fa fa-arrow-down"></i></span>
                </div>

                <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>
              </div>
              <br>
              <div class="col-12">
                <div class="form-group">
                  <input type="checkbox" class="minimal porcentaje" checked>
                  <label>Utilizar procentaje</label>
                </div>
              </div>

              <div class="col-12" style="padding:0">
                <div class="input-group">
                  <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="panel">SUBIR IMAGEN</div>
            <input type="file" class="form-control input-lg" id="nuevaImagen" name="nuevaImagen">
            <p class="help-block">Peso máximo de la imagen 5MB</p>
            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Agregar Producto</button>
        </div>

        <?php $crearProducto = new ControladorProductos(); $crearProducto -> ctrCrearProducto(); ?>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- ---------------------- End of MODAL AGREGAR PRODUCTO --------------------- -->

<!-- -------------------------------------------------------------------------- */
/*                             MODAL EDITAR PRODUCTO                            */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalEditarProducto">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Editar producto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-th"></i></span>
              </div>

              <select class="form-control input-lg"  name="editarCategoria" readonly required>
                <option id="editarCategoria"></option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-code"></i></span>
              </div>

              <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-box"></i></span>
              </div>

              <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
              </div>

              <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fa fa-arrow-up"></i></span>
                </div>

                <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" step="any" min="0" required>
              </div>
            </div>

            <div class="col-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fa fa-arrow-down"></i></span>
                </div>

                <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" step="any" min="0" readonly required>
              </div>
              <br>
              <div class="col-12">
                <div class="form-group">
                  <input type="checkbox" class="minimal porcentaje" checked>
                  <label>Utilizar procentaje</label>
                </div>
              </div>

              <div class="col-12" style="padding:0">
                <div class="input-group">
                  <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="panel">SUBIR IMAGEN</div>
            <input type="file" class="form-control input-lg" id="nuevaImagen" name="nuevaImagen">
            <input type="hidden" name="imagenActual" id="imagenActual">
            <p class="help-block">Peso máximo de la imagen 5MB</p>
            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Producto</button>
        </div>

        <?php $editarProducto = new ControladorProductos(); $editarProducto -> ctrEditarProducto(); ?>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- ---------------------- End of MODAL EDITAR PRODUCTO ---------------------- -->

<?php $eliminarProducto = new ControladorProductos(); $eliminarProducto -> ctrEliminarProducto(); ?>