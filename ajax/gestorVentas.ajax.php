<?php

require_once '../controladores/ventas.controlador.php';
require_once '../modelos/ventas.modelo.php';
require_once '../controladores/clientes.controlador.php';
require_once '../modelos/clientes.modelo.php';
require_once '../controladores/usuarios.controlador.php';
require_once '../modelos/usuarios.modelo.php';

session_start();

class AjaxTabladeVentas {

  static public function MostrarVntas() {

    $item = null;
    $valor = null;

    $respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);

    if (count($respuesta) == 0) {
      echo '{"data": []}';
      return;
    }

    $datosJson = '{"data": [';

    for ($i=0; $i < count($respuesta); $i++) {

      $itemCliente = 'id';
      $valorCliente = $respuesta[$i]['idCliente'];

      $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

      $itemUsuario = 'id';
      $valorUsuario = $respuesta[$i]['idVendedor'];

      $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

      if ($_SESSION["perfil"] == "Administrador") {
        $botones =  "<div class='btn-group'><button class='btn btn-info btnImprimirFactura' codigoVenta='".$respuesta[$i]['codigo']."'><i class='fa fa-print'></i></button><button class='btn btn-warning btnEditarVenta' idVenta='".$respuesta[$i]['id']."'><i class='fa fa-edit'></i></button><button class='btn btn-danger btnEliminarVenta' idVenta='".$respuesta[$i]['id']."'><i class='fa fa-times'></i></button></div>";
      } else {
        $botones =  "<div class='btn-group'><button class='btn btn-info btnImprimirFactura' codigoVenta='".$respuesta[$i]['codigo']."'><i class='fa fa-print'></i></button></div>";
      }

      $datosJson .='[
          "'.($i+1).'",
          "'.$respuesta[$i]['codigo'].'",
          "'.$respuestaCliente['nombre'].'",
          "'.$respuestaUsuario['nombre'].'",
          "'.$respuesta[$i]['metodoPago'].'",
          "$'.number_format($respuesta[$i]['neto'],2).'",
          "$'.number_format($respuesta[$i]['total'],2).'",
          "'.$respuesta[$i]['fecha'].'",
          "'.$botones.'"
      ],';

    }

    $datosJson = substr($datosJson, 0, -1);
    $datosJson .= ']}';
    echo $datosJson;

  }

}

$activarTablaVentas = new AjaxTabladeVentas();
$activarTablaVentas -> MostrarVntas();