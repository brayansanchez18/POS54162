<?php

class ControladorUsuarios {

  /* -------------------------------------------------------------------------- */
  /*                             INGRESO DE USUARIOS                            */
  /* -------------------------------------------------------------------------- */

  static public function ctrIngresoUsuario() {

    if (isset($_POST['ingUsuario'])) {

      if (preg_match('/^[a-zA-Z0-9_.@-_]+$/', $_POST['ingUsuario']) && preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])) {

        $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

        $tabla = 'usuarios';

        $item = 'usuario';
        $valor = $_POST['ingUsuario'];

        $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

        if (is_array($respuesta) && $respuesta['usuario'] == $_POST['ingUsuario'] && $respuesta['pass'] == $encriptar) {

          if ($respuesta["estado"] == 1) {

            $_SESSION['iniciarSesion'] = 'ok';
            $_SESSION['id'] = $respuesta['id'];
            $_SESSION['nombre'] = $respuesta['nombre'];
            $_SESSION['usuario'] = $respuesta['usuario'];
            $_SESSION['foto'] = $respuesta['foto'];
            $_SESSION['perfil'] = $respuesta['perfil'];

            /* -------------------------------------------------------------------------- */
            /*                 REGISTRAR FECHA PARA SABER EL ULTIMO LOGIN                 */
            /* -------------------------------------------------------------------------- */

            date_default_timezone_set('America/Mexico_City');

            $fecha = date('Y-m-d');
            $hora = date('H:i:s');

            $fechaActual = $fecha.' '.$hora;

            $item1 = 'ultimologin';
            $valor1 = $fechaActual;

            $item2 = 'id';
            $valor2 = $respuesta['id'];

            $ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

            if ($ultimoLogin == 'ok') {

              echo '<script>
                window.location = "inicio";
              </script>';

            }

            /* ------------ End of REGISTRAR FECHA PARA SABER EL ULTIMO LOGIN ----------- */

          } else {

            echo'<script>

            Swal.fire({
              title: "¡ERROR!",
              text: "El usuario aún no está activado",
              icon: "error",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "inicio";
              }
            })

            </script>';

          }

        } else {

          echo'<script>

            Swal.fire({
              title: "¡ERROR!",
              text: "Error al ingresar, vuelve a intentarlo",
              icon: "error",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "inicio";
              }
            })

            </script>';

        }

      }

    }


  }

  /* ----------------------- End of INGRESO DE USUARIOS ----------------------- */

  /* -------------------------------------------------------------------------- */
  /*                               MOSTRAR USUARIO                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarUsuarios($item, $valor) {
    $tabla = 'usuarios';
    $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
    return $respuesta;
  }

  /* ------------------------- End of MOSTRAR USUARIO ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                             REGISTRO DE USUARIO                            */
  /* -------------------------------------------------------------------------- */

  static public function ctrCrearUsuario() {

    if (isset($_POST['nuevoUsuario'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ .@-_]+$/', $_POST['nuevoNombre']) &&
          preg_match('/^[a-zA-Z0-9.@-_]+$/', $_POST['nuevoUsuario']) &&
          preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoPassword'])) {

      /* -------------------------------------------------------------------------- */
      /*                               VALIDAR IMAGEN                               */
      /* -------------------------------------------------------------------------- */

      $ruta = '';

      if (isset($_FILES['nuevaFoto']['tmp_name'])) {

        /* -------------------------------------------------------------------------- */
        /*                              DEFINIMOS MEDIDAS                             */
        /* -------------------------------------------------------------------------- */

        list($ancho, $alto) = getimagesize($_FILES['nuevaFoto']['tmp_name']);
        $nuevoAncho = 500;
        $nuevoAlto = 500;

        /* ------------------------ End of DEFINIMOS MEDIDAS ------------------------ */

        /* -------------------------------------------------------------------------- */
        /*                            CREAMOS EL DIRECTORIO                           */
        /* -------------------------------------------------------------------------- */

        $directorio = 'vistas/img/usuarios/'.$_POST['nuevoUsuario'];
        mkdir($directorio, 0755);

        /* ---------------------- End of CREAMOS EL DIRECTORIO ---------------------- */

        /* -------------------------------------------------------------------------- */
        /*         DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP        */
        /* -------------------------------------------------------------------------- */

        if ($_FILES['nuevaFoto']['type'] == 'image/jpeg') {

          /* -------------------------------------------------------------------------- */
          /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
          /* -------------------------------------------------------------------------- */

          $aleatorio = mt_rand(100,999);
          $ruta = 'vistas/img/usuarios/'.$_POST['nuevoUsuario'].'/'.$aleatorio.'.jpg';
          $origen = imagecreatefromjpeg($_FILES['nuevaFoto']['tmp_name']);
          $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
          imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
          imagejpeg($destino, $ruta);

          /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

        }

        if ($_FILES['nuevaFoto']['type'] == 'image/png') {

          /* -------------------------------------------------------------------------- */
          /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
          /* -------------------------------------------------------------------------- */

          $aleatorio = mt_rand(100,999);
          $ruta = 'vistas/img/usuarios/'.$_POST['nuevoUsuario'].'/'.$aleatorio.'.png';
          $origen = imagecreatefrompng($_FILES['nuevaFoto']['tmp_name']);
          $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
          imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
          imagepng($destino, $ruta);

          /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

        }

        /* --- End of DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP --- */

      }

      /* -------------------------- End of VALIDAR IMAGEN ------------------------- */

      $tabla = 'usuarios';

      $encriptar = crypt($_POST['nuevoPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

      $datos = array('nombre' => $_POST['nuevoNombre'],
                    'usuario' => $_POST['nuevoUsuario'],
                    'password' => $encriptar,
                    'perfil' => $_POST['nuevoPerfil'],
                    'foto'=>$ruta);

      $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

      if ($respuesta == 'ok') {

        echo'<script>

          Swal.fire({
            title: "¡USUARIO CREADO!",
            text: "El usuario ha sido guardado correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "perfiles";
            }
          })

        </script>';

      }

    } else {

      echo'<script>

        Swal.fire({
          title: "¡ERROR AL GUARDAR USUARIO!",
          text: "El usuario no puede ir vacío o llevar caracteres especiales",
          icon: "error",
          confirmButtonText: "Cerrar",
          closeOnConfirm: false,
        }).then((isConfirm) => {
          if (isConfirm) {
            window.location = "perfiles";
          }
        })

      </script>';

    }

    }

	}

  /* ----------------------- End of REGISTRO DE USUARIO ----------------------- */

}