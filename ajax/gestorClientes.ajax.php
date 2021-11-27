<?php

require_once '../controladores/clientes.controlador.php';
require_once '../modelos/clientes.modelo.php';
require_once '../controladores/usuarios.controlador.php';

SESSION_START();

class TablaClientes {

  /* -------------------------------------------------------------------------- */
  /*                        MOSTRAR LA TABLA DE CLIENTES                        */
  /* -------------------------------------------------------------------------- */

  public function mostrarTablaClientes() {

    $item = null;
    $valor = null;
    $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

    if (count($clientes) == 0) {
      echo '{"data": []}';
      return;
    }

    $datosJsonClientes = '{"data": [';

    for ($i = 0; $i < count($clientes); $i++) {

      /* -------------------------------------------------------------------------- */
      /*                            TRAEMOS LAS ACCIONES                            */
      /* -------------------------------------------------------------------------- */

      if ($_SESSION['perfil'] == 'Administrador') {
        $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarCliente' idCliente='".$clientes[$i]['id']."' data-toggle='modal' data-target='#modalEditarCliente'><i class='fa fa-edit'></i></button><button class='btn btn-danger btnEliminarCliente' idCliente='".$clientes[$i]['id']."'><i class='fa fa-times'></i></button></div>";
      } else {
        $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarCliente' idCliente='".$clientes[$i]['id']."' data-toggle='modal' data-target='#modalEditarCliente'><i class='fa fa-edit'></i></button></div>";
      }

      /* ----------------------- End of TRAEMOS LAS ACCIONES ---------------------- */

      $datosJsonClientes .='[
                  "'.($i+1).'",
                  "'.$clientes[$i]['nombre'].'",
                  "'.$clientes[$i]['email'].'",
                  "'.$clientes[$i]['telefono'].'",
                  "'.$clientes[$i]['compras'].'",
                  "'.$clientes[$i]['ultimaCompra'].'",
                  "'.$clientes[$i]['fecha'].'",
                  "'.$botones.'"
              ],';

    }

    $datosJsonClientes = substr($datosJsonClientes, 0, -1);
    $datosJsonClientes .=   ']}';
    echo $datosJsonClientes;

  }

  /* ------------------- End of MOSTRAR LA TABLA DE CLIENTES ------------------ */

}

/* -------------------------------------------------------------------------- */
/*                        MOSTRAR LA TABLA DE CLIENTES                        */
/* -------------------------------------------------------------------------- */

$activarClientes = new TablaClientes();
$activarClientes -> mostrarTablaClientes();

/* ------------------- End of MOSTRAR LA TABLA DE CLIENTES ------------------ */