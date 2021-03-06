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
          <h1>Crear venta</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=$frontend?>">Inicio</a></li>
            <li class="breadcrumb-item active">Crear venta</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- EL FORMULARIO -->
      <div class="col-12 col-lg-5">
        <div class="card card-primary card-outline">
          <form role="form" method="post" class="formularioVenta">
            <div class="card-body">
              <div class="box">

                <!-- ENTRADA DEL VENDEDOR -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>

                    <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="<?=$_SESSION['nombre']?>" readonly>
                    <input type="hidden" name="idVendedor" value="<?=$_SESSION['id']?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>

                    <?php $item = null;
                    $valor = null;
                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);?>

                    <?php if (!$ventas): ?>
                      <input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>
                    <?php else: ?>
                      <?php foreach ($ventas as $key => $value): ?><?php endforeach ?>
                      <?php $codigo = ($value['codigo'] + 1); ?>
                      <input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="<?=$codigo?>" readonly>
                    <?php endif ?>
                  </div>
                </div>
                <!-- /ENTRADA DEL VENDEDOR -->

                <!-- ENTRADA DEL CLIENTE -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-users"></i></span>
                    </div>
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                      <option value="">Seleccionar cliente</option>

                      <?php $item = null;
                      $valor = null;
                      $clientes = ControladorClientes::ctrMostrarClientes($item, $valor); ?>

                      <?php foreach ($clientes as $key => $value): ?>
                        <option value="<?=$value['id']?>"><?=$value['nombre']?></option>
                      <?php endforeach ?>
                    </select>

                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button>
                      </span>
                    </div>
                  </div>
                </div>
                <!-- /ENTRADA DEL CLIENTE -->

                <!-- ENTRADA PARA AGREGAR PRODUCTO -->
                <div class="form-group row nuevoProducto"></div>
                <input type="hidden" id="listaProductos" name="listaProductos">

                <!-- /ENTRADA PARA AGREGAR PRODUCTO -->

                <div class="row">
                  <!-- ENTRADA IMPUESTOS Y TOTAL -->
                  <div class="col-12 col-xl-8 ml-auto">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td style="width: 50%">
                            <div class="input-group">
                              <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>
                              <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto">
                              <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto">

                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-percent"></i></span>
                              </div>
                            </div>
                          </td>

                          <td style="width: 50%">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                              </div>

                              <input type="text" class="form-control itotal" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="0" readonly required>
                              <input type="hidden" name="totalVenta" id="totalVenta">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /ENTRADA IMPUESTOS Y TOTAL -->
                </div>

                <hr>

                <!-- ENTRADA M??TODO DE PAGO -->
                <div class="form-group row">
                  <div class="col-6">
                    <div class="input-group">
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="">Seleccione m??todo de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Cr??dito</option>
                        <option value="TD">Tarjeta D??bito</option>
                      </select>
                    </div>
                  </div>

                  <div class="cajasMetodoPago"></div>
                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary float-right">Guardar venta</button>
            </div>

            <?php $guardarVenta = new ControladorVentas(); $guardarVenta -> ctrCrearVenta(); ?>

          </form>
        </div>
      </div>
      <!-- /EL FORMULARIO -->

      <!-- LA TABLA DE PRODUCTOS -->
      <div class="col-12 col-lg-7">
        <div class="card card-warning card-outline">

          <div class="card-body">
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>C??digo</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <!-- /LA TABLA DE PRODUCTOS -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- -------------------------------------------------------------------------- */
/*                             MODAL AGREGAR CLIENTE                            */
/* -------------------------------------------------------------------------- -->

<div class="modal fade" id="modalAgregarCliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Agregar cliente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
              </div>
              <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
              </div>
              <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar tel??fono" data-inputmask="'mask':'(+99) 999-999-9999'" data-mask required>
            </div>
          </div>


        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Agregar cliente</button>
        </div>

        <?php $crearCliente = new ControladorClientes; $crearCliente -> ctrCrearCliente(); ?>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- ---------------------- End of MODAL AGREGAR CLIENTE ---------------------- -->