<?php

class ControladorProductos {

  /* -------------------------------------------------------------------------- */
  /*                              MOSTRAR PRODUCTOS                             */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarProductos($item, $valor) {
    $tabla = 'productos';
    $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);
    return $respuesta;
  }

  /* ------------------------ End of MOSTRAR PRODUCTOS ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                               CREAR PRODUCTO                               */
  /* -------------------------------------------------------------------------- */

  static public function ctrCrearProducto() {

    if (isset($_POST['nuevaDescripcion'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevaDescripcion']) &&
			preg_match('/^[0-9]+$/', $_POST['nuevoStock']) &&
			preg_match('/^[0-9.,]+$/', $_POST['nuevoPrecioCompra']) &&
			preg_match('/^[0-9.,]+$/', $_POST['nuevoPrecioVenta'])) {

        /* -------------------------------------------------------------------------- */
        /*                               VALIDAR IMAGEN                               */
        /* -------------------------------------------------------------------------- */

        $ruta = 'vistas/img/productos/default/anonymous.png';

        if (isset($_FILES['nuevaImagen']['tmp_name'])) {

          /* -------------------------------------------------------------------------- */
          /*                              DEFINIMOS MEDIDAS                             */
          /* -------------------------------------------------------------------------- */

          list($ancho, $alto) = getimagesize($_FILES['nuevaImagen']['tmp_name']);
          $nuevoAncho = 500;
          $nuevoAlto = 500;

          /* ------------------------ End of DEFINIMOS MEDIDAS ------------------------ */

          /* -------------------------------------------------------------------------- */
          /*                            CREAMOS EL DIRECTORIO                           */
          /* -------------------------------------------------------------------------- */

          $directorio = 'vistas/img/productos/'.$_POST['nuevoCodigo'];
          mkdir($directorio, 0755);

          /* ---------------------- End of CREAMOS EL DIRECTORIO ---------------------- */

          /* -------------------------------------------------------------------------- */
          /*           DEACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES PHP          */
          /* -------------------------------------------------------------------------- */

          if ($_FILES['nuevaImagen']['type'] == 'image/jpeg') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
            $ruta = 'vistas/img/productos/'.$_POST['nuevoCodigo'].'/'.$aleatorio.'.jpg';
            $origen = imagecreateFromjpeg($_FILES['nuevaImagen']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAlto, $nuevoAlto, $ancho, $alto);
            imagejpeg($destino, $ruta);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          if ($_FILES['nuevaImagen']['type'] == 'image/png') {

            $aleatorio = mt_rand(100,999);
            $ruta = 'vistas/img/productos/'.$_POST['nuevoCodigo'].'/'.$aleatorio.'.png';
            $origen = imagecreateFromjpeg($_FILES['nuevaImagen']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAlto, $nuevoAlto, $ancho, $alto);
            imagejpeg($destino, $ruta);

          }

          /* ----- End of DEACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES PHP ----- */

        }

        /* -------------------------- End of VALIDAR IMAGEN ------------------------- */

        $tabla = 'productos';

        $datos = array('idCategoria'=>$_POST['nuevaCategoria'],
                      'codigo' => $_POST['nuevoCodigo'],
                      'descripcion' => $_POST['nuevaDescripcion'],
                      'stock' => $_POST['nuevoStock'],
                      'precioCompra' => $_POST['nuevoPrecioCompra'],
                      'precioVenta' => $_POST['nuevoPrecioVenta'],
                      'imagen' => $ruta);

        $respuesta = ModeloProductos::mdlIngresoProducto($tabla, $datos);

        if ($respuesta = 'ok') {

          echo'<script>
            Swal.fire({
              title: "¡GUARDADO!",
              text: "El producto ha sido guardado correctamente",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "productos";
              }
            })
          </script>';

        }

      } else {

        echo'<script>
          Swal.fire({
            title: "¡ERROR!",
            text: "El producto no puede ir con los campos vacíos o llevar caracteres especiales",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "productos";
            }
          })
        </script>';

      }

    }

  }

  /* -------------------------- End of CREAR PRODUCTO ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                               EDITAR PRODUCTO                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrEditarProducto() {

    if (isset($_POST['editarDescripcion'])) {

      if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarDescripcion']) &&
			preg_match('/^[0-9]+$/', $_POST['editarStock']) &&
			preg_match('/^[0-9.]+$/', $_POST['editarPrecioCompra']) &&
			preg_match('/^[0-9.]+$/', $_POST['editarPrecioVenta'])) {

        /* -------------------------------------------------------------------------- */
        /*                               VALIDAR IMAGEN                               */
        /* -------------------------------------------------------------------------- */

        $ruta = $_POST['imagenActual'];

        if (isset($_FILES['editarImagen']['tmp_name']) && !empty($_FILES['editarImagen']['tmp_name'])) {

          /* -------------------------------------------------------------------------- */
          /*                              DEFINIMOS MEDIDAS                             */
          /* -------------------------------------------------------------------------- */

          list($ancho, $alto) = getimagesize($_FILES['editarImagen']['tmp_name']);
          $nuevoAncho = 500;
          $nuevoAlto = 500;

          /* ------------------------ End of DEFINIMOS MEDIDAS ------------------------ */

          /* -------------------------------------------------------------------------- */
          /*                            CREAMOS EL DIRECTORIO                           */
          /* -------------------------------------------------------------------------- */

          $directorio = 'vistas/img/productos/'.$_POST['editarCodigo'];

          /* ---------------------- End of CREAMOS EL DIRECTORIO ---------------------- */

          /* -------------------------------------------------------------------------- */
          /*                 PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD                 */
          /* -------------------------------------------------------------------------- */

          if (!empty($_POST['imagenActual']) && $_POST['imagenActual'] != 'vistas/img/productos/default/anonymous.png') {
            unlink($_POST['imagenActual']);
          } else {
            mkdir($directorio, 0755);
          }

          /* ------------ End of PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD ----------- */

          /* -------------------------------------------------------------------------- */
          /*         DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP        */
          /* -------------------------------------------------------------------------- */

          if ($_FILES['editarImagen']['type'] == 'image/jpeg') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
            $ruta = 'vistas/img/productos/'.$_POST['editarCodigo'].'/'.$aleatorio.'.jpg';
            $origen = imagecreatefromjpeg($_FILES['editarImagen']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagejpeg($destino, $ruta);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          if ($_FILES['editarImagen']['type'] == 'image/png') {

            /* -------------------------------------------------------------------------- */
            /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
            /* -------------------------------------------------------------------------- */

            $aleatorio = mt_rand(100,999);
            $ruta = 'vistas/img/productos/'.$_POST['editarCodigo'].'/'.$aleatorio.'.png';
            $origen = imagecreatefrompng($_FILES['editarImagen']['tmp_name']);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagepng($destino, $ruta);

            /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          }

          /* --- End of DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES DE PHP --- */

        }

        /* -------------------------- End of VALIDAR IMAGEN ------------------------- */

        $tabla = 'productos';

        $datos = array('idCategoria' => $_POST['editarCategoria'],
                      'codigo' => $_POST['editarCodigo'],
                      'descripcion' => $_POST['editarDescripcion'],
                      'stock' => $_POST['editarStock'],
                      'precioCompra' => $_POST['editarPrecioCompra'],
                      'precioVenta' => $_POST['editarPrecioVenta'],
                      'imagen' => $ruta);

        $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

        if ($respuesta == 'ok') {

          echo'<script>
            Swal.fire({
              title: "¡EDITADO!",
              text: "El producto ha sido editado correctamente",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((isConfirm) => {
              if (isConfirm) {
                window.location = "productos";
              }
            })
          </script>';

        }

      } else {

        echo'<script>
          Swal.fire({
            title: "¡ERROR!",
            text: "El producto no puede ir con los campos vacíos o llevar caracteres especiales",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "productos";
            }
          })
        </script>';

      }

    }

  }

  /* ------------------------- End of EDITAR PRODUCTO ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              ELIMINAR PRODUCTO                             */
  /* -------------------------------------------------------------------------- */

  static public function ctrEliminarProducto() {

    if (isset($_GET['idProducto'])) {

      $tabla ='productos';
      $datos = $_GET['idProducto'];

      if ($_GET['imagen'] != '' && $_GET['imagen'] != 'vistas/img/productos/default/anonymous.png') {
        unlink($_GET['imagen']);
        rmdir('vistas/img/productos/'.$_GET['codigo']);
      }

      $respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

      if ($respuesta == 'ok') {

        echo'<script>
          Swal.fire({
            title: "¡ELIMINADO!",
            text: "El producto ha sido borrado correctamente",
            icon: "success",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false,
          }).then((isConfirm) => {
            if (isConfirm) {
              window.location = "productos";
            }
          })
        </script>';

      }

    }

  }

  /* ------------------------ End of ELIMINAR PRODUCTO ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                             MOSTRAR SUMA VENTAS                            */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarSumaVentas() {
    $tabla = 'productos';
    $respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);
    return $respuesta;
  }

  /* ----------------------- End of MOSTRAR SUMA VENTAS ----------------------- */

}