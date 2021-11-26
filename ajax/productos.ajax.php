<?php

require_once '../controladores/productos.controlador.php';
require_once '../modelos/productos.modelo.php';
require_once '../controladores/categorias.controlador.php';
require_once '../modelos/categorias.modelo.php';

class AjaxProductos {

  /* -------------------------------------------------------------------------- */
  /*                   GENERAR CÓDIGO A PARTIR DE ID CATEGORIA                  */
  /* -------------------------------------------------------------------------- */

  public $idCategoria;

  public function ajaxCrearCodigoProducto() {
    $item = 'idCategoria';
    $valor = $this->idCategoria;
    $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
    echo json_encode($respuesta);
  }

  /* ------------- End of GENERAR CÓDIGO A PARTIR DE ID CATEGORIA ------------- */

  /* -------------------------------------------------------------------------- */
  /*                               EDITAR PRODUCTO                              */
  /* -------------------------------------------------------------------------- */

  public $idProducto;
  public $traerProductos;
  public $nombreProducto;

  public function ajaxEditarProducto() {

    if ($this->traerProductos == 'ok') {

      $item = null;
      $valor = null;
      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
      echo json_encode($respuesta);

    } else if ($this->nombreProducto != '') {

      $item = 'descripcion';
      $valor = $this->nombreProducto;
      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
      echo json_encode($respuesta);

    } else {

      $item = "id";
      $valor = $this->idProducto;
      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
      echo json_encode($respuesta);

    }

  }

  /* ------------------------- End of EDITAR PRODUCTO ------------------------- */

}

/* -------------------------------------------------------------------------- */
/*                   GENERAR CÓDIGO A PARTIR DE ID CATEGORIA                  */
/* -------------------------------------------------------------------------- */

if (isset($_POST['idCategoria'])) {
  $codigoProducto = new AjaxProductos();
  $codigoProducto -> idCategoria = $_POST['idCategoria'];
  $codigoProducto -> ajaxCrearCodigoProducto();
}

/* ------------- End of GENERAR CÓDIGO A PARTIR DE ID CATEGORIA ------------- */

/* -------------------------------------------------------------------------- */
/*                               EDITAR PRODUCTO                              */
/* -------------------------------------------------------------------------- */

if (isset($_POST['traerProductos'])) {
  $traerProductos = new AjaxProductos();
  $traerProductos -> traerProductos = $_POST['traerProductos'];
  $traerProductos -> ajaxEditarProducto();
}

if (isset($_POST['nombreProducto'])) {
  $traerProductos = new AjaxProductos();
  $traerProductos -> nombreProducto = $_POST['nombreProducto'];
  $traerProductos -> ajaxEditarProducto();
}

if (isset($_POST['idProducto'])) {
  $editarProducto = new AjaxProductos();
  $editarProducto -> idProducto = $_POST['idProducto'];
  $editarProducto -> ajaxEditarProducto();
}

/* ------------------------- End of EDITAR PRODUCTO ------------------------- */