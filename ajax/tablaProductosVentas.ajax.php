<?php

require_once '../controladores/productos.controlador.php';
require_once '../modelos/productos.modelo.php';

class AjaxTablaVentas {

  public function mostrarTablaProductosVentas() {

    /* -------------------------------------------------------------------------- */
    /*                        MOSTRAR LA TABLA DE PRODUCTOS                       */
    /* -------------------------------------------------------------------------- */

    $item = null;
    $valor = null;
    $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

    if (count($productos) == 0) {
      echo '{"data": []}';
      return;
    }

    $datosJson = '{"data": [';

    for ($i=0; $i < count($productos); $i++) {

      /* -------------------------------------------------------------------------- */
      /*                              TRAEMOS LA IMAGEN                             */
      /* -------------------------------------------------------------------------- */

      if ($productos[$i]['imagen'] != '') {
        $imagen = "<img src='".$productos[$i]['imagen']."' width='40px'>";
      } else {
        $imagen = "<img src='vistas/img/productos/default/anonymous.png' width='40px'>";
      }

      /* ------------------------ End of TRAEMOS LA IMAGEN ------------------------ */

      /* -------------------------------------------------------------------------- */
      /*                                    STOCK                                   */
      /* -------------------------------------------------------------------------- */

      if ($productos[$i]['stock'] <= 10) {
        $stock = "<button class='btn btn-danger'>".$productos[$i]['stock']."</button>";
      } else if($productos[$i]["stock"] > 11 && $productos[$i]['stock'] <= 15) {
        $stock = "<button class='btn btn-warning'>".$productos[$i]['stock']."</button>";
      } else {
        $stock = "<button class='btn btn-success'>".$productos[$i]['stock']."</button>";
      }

      /* ------------------------------ End of STOCK ------------------------------ */

      /* -------------------------------------------------------------------------- */
      /*                            TRAEMOS LAS ACCIONES                            */
      /* -------------------------------------------------------------------------- */

      $botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]['id']."'>Agregar</button></div>";

      $datosJson .='[
        "'.($i+1).'",
        "'.$imagen.'",
        "'.$productos[$i]['codigo'].'",
        "'.$productos[$i]['descripcion'].'",
        "'.$stock.'",
        "'.$botones.'"
      ],';

      /* ----------------------- End of TRAEMOS LAS ACCIONES ---------------------- */

    }

    $datosJson = substr($datosJson, 0, -1);
    $datosJson .= ']}';
		echo $datosJson;

    /* ------------------ End of MOSTRAR LA TABLA DE PRODUCTOS ------------------ */

  }

}

/* -------------------------------------------------------------------------- */
/*                        MOSTRAR LA TABLA DE PRODUCTOS                       */
/* -------------------------------------------------------------------------- */

$activarProductosVentas = new AjaxTablaVentas();
$activarProductosVentas -> mostrarTablaProductosVentas();

/* ------------------ End of MOSTRAR LA TABLA DE PRODUCTOS ------------------ */