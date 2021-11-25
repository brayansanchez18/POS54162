<?php

require_once '../controladores/categorias.controlador.php';
require_once '../modelos/categorias.modelo.php';

class AjaxCategorias {

  /* -------------------------------------------------------------------------- */
  /*                          EVITAR REPETIR CATEGORIAS                         */
  /* -------------------------------------------------------------------------- */

  public $validarcategoria;

  public function ajaxValidarCategoria() {
    $item = 'categoria';
    $valor = $this->validarcategoria;
    $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);
    echo json_encode($respuesta);
  }

  /* -------------------- End of EVITAR REPETIR CATEGORIAS -------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              EDITAR CATEGORIA                              */
  /* -------------------------------------------------------------------------- */

  public $idCategoria;

  public function ajaxEditarCategoria() {
    $item = 'id';
    $valor = $this->idCategoria;
    $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);
    echo json_encode($respuesta);
  }

  /* ------------------------- End of EDITAR CATEGORIA ------------------------ */

}

/* -------------------------------------------------------------------------- */
/*                          EVITAR REPETIR CATEGORIAS                         */
/* -------------------------------------------------------------------------- */

if (isset( $_POST['validarcategoria'])) {
  $validarcategoria = new AjaxCategorias();
  $validarcategoria -> validarcategoria = $_POST['validarcategoria'];
  $validarcategoria -> ajaxValidarCategoria();
}

/* -------------------- End of EVITAR REPETIR CATEGORIAS -------------------- */

/* -------------------------------------------------------------------------- */
/*                              EDITAR CATEGORIA                              */
/* -------------------------------------------------------------------------- */

if (isset($_POST['idCategoria'])) {
  $categoria = new AjaxCategorias();
  $categoria -> idCategoria = $_POST['idCategoria'];
  $categoria -> ajaxEditarCategoria();
}

/* ------------------------- End of EDITAR CATEGORIA ------------------------ */