<?php

class ControladorVentas {

  /* -------------------------------------------------------------------------- */
  /*                               MOSTRAR VENTAS                               */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarVentas($item, $valor) {
    $tabla = 'ventas';
    $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
    return $respuesta;
  }

  /* -------------------------- End of MOSTRAR VENTAS ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                                 CREAR VENTA                                */
  /* -------------------------------------------------------------------------- */

  static public function ctrCrearVenta() {

    if (isset($_POST['nuevaVenta'])) {

      /* -------------------------------------------------------------------------- */
      /*        ACTUALIZAR LAS COMPRAS REDUCIR EL STOCK Y AUMENTAR LAS VENTAS       */
      /* -------------------------------------------------------------------------- */

      $listaProductos = json_decode($_POST['listaProductos'], true);
      $totalProductosComprados = array();

      foreach ($listaProductos as $key => $value) {

        array_push($totalProductosComprados, $value['cantidad']);

        $tablaProductos = 'productos';

        $item = 'id';
        $valor = $value['id'];
        $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

        $item1a = 'ventas';
        $valor1a = $value['cantidad'] + $traerProducto['ventas'];
        $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

        $item1b = 'stock';
        $valor1b = $value['stock'];
        $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

      }

      $tablaClientes = 'clientes';

      $item = 'id';
      $valor = $_POST['seleccionarCliente'];
      $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

      $item1a = 'compras';
      $valor1a = array_sum($totalProductosComprados) + $traerCliente['compras'];
      $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

      $item1b = 'ultimaCompra';

      date_default_timezone_set('America/Mexico_City');

      $fecha = date('Y-m-d');
      $hora = date('H:i:s');
      $valor1b = $fecha.' '.$hora;

      $fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

      /* -------------------------------------------------------------------------- */
      /*                              GUARDAR LA COMPRA                             */
      /* -------------------------------------------------------------------------- */

      $tabla = 'ventas';

      $datos = array('idVendedor'=>$_POST['idVendedor'],
                    'idCliente'=>$_POST['seleccionarCliente'],
                    'codigo'=>$_POST['nuevaVenta'],
                    'productos'=>$_POST['listaProductos'],
                    'impuesto'=>$_POST['nuevoPrecioImpuesto'],
                    'neto'=>$_POST['nuevoPrecioNeto'],
                    'total'=>$_POST['totalVenta'],
                    'metodoPago'=>$_POST['listaMetodoPago']);

      $respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

      if ($respuesta == 'ok') {

        echo'<script>
          localStorage.removeItem("rango");

          Swal.fire({
            title: "¡GUARDADO!",
            text: "La venta ha sido guardada correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "administrar-ventas";
            }
          })
        </script>';

      }

      /* -- FIN DE ACTUALIZAR LAS COMPRAS REDUCIR EL STOCK Y AUMENTAR LAS VENTAS -- */

    }

  }

  /* --------------------------- End of CREAR VENTA --------------------------- */

}