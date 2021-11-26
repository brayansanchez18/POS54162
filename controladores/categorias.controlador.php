<?php

class ControladorCategorias {

  /* -------------------------------------------------------------------------- */
  /*                             MOSTRAR CATEGORIAS                             */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarCategorias($item, $valor) {
    $tabla = 'categorias';
    $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
    return $respuesta;
  }

  /* ------------------------ End of MOSTRAR CATEGORIAS ----------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              CREAR CATEGORIAS                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrCrearCategorias() {

    if (isset($_POST['nuevaCategoria'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevaCategoria'])) {

        $tabla = 'categorias';
        $datos = $_POST['nuevaCategoria'];
        $respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

        if ($respuesta == 'ok') {

          echo '<script>
            Swal.fire({
              title: "¡GUARDADO!",
              text: "La categoría ha sido guardada correctamente",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "categorias";
              }
            })
          </script>';

        }

      } else {

        echo '<script>
          Swal.fire({
            title: "¡ERROR!",
            text: "La categoría no puede ir vacía o llevar caracteres especiales",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "categorias";
            }
          })
        </script>';

      }

    }

  }

  /* ------------------------- End of CREAR CATEGORIAS ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                              EDITAR CATEGORIA                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrEditarCategoria() {

    if (isset($_POST['editarCategoria'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarCategoria'])) {

        $tabla = 'categorias';

        $datos = array('categoria'=>$_POST['editarCategoria'],
                        'id'=>$_POST['idCategoria']);

        $respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

        if ($respuesta == 'ok') {

          echo '<script>
            Swal.fire({
              title: "¡EDITADO!",
              text: "La categoría ha sido editado correctamente",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "categorias";
              }
            })
          </script>';

        }

      } else {

        echo '<script>
          Swal.fire({
            title: "¡ERROR!",
            text: "La categoría no puede ir vacía o llevar caracteres especiales",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "categorias";
            }
          })
        </script>';

      }

    }

  }

  /* ------------------------- End of EDITAR CATEGORIA ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                              BORRAR CATEGORIA                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrBorrarCategoria() {

    if (isset($_GET['idCategoria'])) {

      $productos = ControladorProductos::ctrMostrarProductos('idCategoria', $_GET['idCategoria']);

      if (is_array($productos) && count($productos) != 0) {

        echo'<script>
          Swal.fire({
            title: "¡ERROR!",
            text: "La categoria no puede ser eliminada por que contiene productos",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "categorias";
            }
          })
        </script>';

      } else {

        $tabla ='Categorias';
        $datos = $_GET['idCategoria'];

        $respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

        if ($respuesta == 'ok') {

          echo '<script>
            Swal.fire({
              title: "¡BORRADO!",
              text: "La categoría ha sido borrada correctamente",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "categorias";
              }
            })
          </script>';

        }

      }

    }

  }

  /* ------------------------- End of BORRAR CATEGORIA ------------------------ */

}