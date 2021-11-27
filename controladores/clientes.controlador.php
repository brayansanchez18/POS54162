<?php

class ControladorClientes {

  /* -------------------------------------------------------------------------- */
  /*                              MOSTRAR CLIENTES                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarClientes($item, $valor) {
    $tabla = 'clientes';
    $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
    return $respuesta;
  }

  /* ------------------------- End of MOSTRAR CLIENTES ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                                CREAR CLIENTE                               */
  /* -------------------------------------------------------------------------- */

  static public function ctrCrearCliente() {

    if (isset($_POST['nuevoCliente'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoCliente']) &&
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['nuevoEmail']) &&
				preg_match('/^[()\-0-9+ ]+$/', $_POST['nuevoTelefono'])) {

        $tabla = 'clientes';

        $datos = array('nombre'=>$_POST['nuevoCliente'],
                      'email'=>$_POST['nuevoEmail'],
                      'telefono'=>$_POST['nuevoTelefono']);

        $respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

        if ($respuesta == 'ok') {

          echo'<script>
            Swal.fire({
              title: "¡CREADO!",
              text: "El cliente ha sido guardado correctamente",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "clientes";
              }
            })
          </script>';

        }

      } else {

        echo'<script>
          Swal.fire({
            title: "¡ERROR!",
            text: "El cliente no puede ir vacío o llevar caracteres especiales",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "clientes";
            }
          })
        </script>';

      }

    }

  }

  /* -------------------------- End of CREAR CLIENTE -------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                               EDITAR CLIENTE                               */
  /* -------------------------------------------------------------------------- */

  static public function ctrEditarCliente() {

    if (isset($_POST['editarCliente'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarCliente']) &&
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['editarEmail']) &&
				preg_match('/^[()\-0-9+ ]+$/', $_POST['editarTelefono'])) {

        $tabla = 'clientes';

        $datos = array('id'=>$_POST['idCliente'],
                'nombre'=>$_POST['editarCliente'],
                'email'=>$_POST['editarEmail'],
                'telefono'=>$_POST['editarTelefono']);

        $respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

        if ($respuesta == 'ok') {

          echo'<script>
            Swal.fire({
              title: "¡EDITADO!",
              text: "El cliente ha sido actualizado correctamente",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "clientes";
              }
            })
          </script>';

        }

      } else {

        echo'<script>
          Swal.fire({
            title: "¡ERROR!",
            text: "El cliente no puede ir vacío o llevar caracteres especiales",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "clientes";
            }
          })
        </script>';

      }

    }

  }

  /* -------------------------- End of EDITAR CLIENTE ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              ELIMINAR CLIENTE                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrEliminarCliente() {

    if (isset($_GET['idCliente'])) {

      $tabla = 'clientes';
      $datos = $_GET['idCliente'];
      $respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

      if ($respuesta == 'ok') {

        echo'<script>
          Swal.fire({
            title: "¡ELIMINADO!",
            text: "El cliente ha sido borrado correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "clientes";
            }
          })
        </script>';

      }

    }

  }

  /* ------------------------- End of ELIMINAR CLIENTE ------------------------ */

}