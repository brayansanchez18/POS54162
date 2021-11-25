<?php

require_once '../controladores/categorias.controlador.php';
require_once '../modelos/categorias.modelo.php';
require_once '../controladores/usuarios.controlador.php';

session_start();

class TablaCategorias {

  /* -------------------------------------------------------------------------- */
  /*                         MOSTRAR TABLA DE CATEGORIAS                        */
  /* -------------------------------------------------------------------------- */

  public function mostrarTablaCategorias() {

    $item = null;
    $valor = null;
    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

    if ($categorias != null) {

      $datosJsonCategorias = '{"data": [';

      for ($i = 0; $i < count($categorias); $i++) {

        /* -------------------------------------------------------------------------- */
        /*                            TRAEMOS LAS ACCIONES                            */
        /* -------------------------------------------------------------------------- */

        if ($_SESSION['perfil'] == 'Administrador') {
          $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarCategoria' idCategoria='".$categorias[$i]['id']."' data-toggle='modal' data-target='#modalEditarCategoria'><i class='fa fa-edit'></i></button><button class='btn btn-danger btnEliminarCategoria' idCategoria='".$categorias[$i]['id']."'><i class='fa fa-times'></i></button></div>";
        } else {
          $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarCategoria' idCategoria='".$categorias[$i]['id']."' data-toggle='modal' data-target='#modalEditarCategoria'><i class='fa fa-edit'></i></button></div>";
        }

        /* ----------------------- End of TRAEMOS LAS ACCIONES ---------------------- */

        $datosJsonCategorias .='[
          "'.($i+1).'",
          "'.$categorias[$i]['categoria'].'",
          "'.$botones.'"
        ],';

      }

      $datosJsonCategorias = substr($datosJsonCategorias, 0, -1);
      $datosJsonCategorias .= ']}';

    } else {
      $datosJsonCategorias = '{"data":[]}';
    }

    echo $datosJsonCategorias;

  }

  /* ------------------- End of MOSTRAR TABLA DE CATEGORIAS ------------------- */

}

/* -------------------------------------------------------------------------- */
/*                         MOSTRAR TABLA DE CATEGORIAS                        */
/* -------------------------------------------------------------------------- */

$activarCategorias = new TablaCategorias();
$activarCategorias -> mostrarTablaCategorias();

/* ------------------- End of MOSTRAR TABLA DE CATEGORIAS ------------------- */