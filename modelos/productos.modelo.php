<?php

require_once 'conexion.php';

class ModeloProductos {

  /* -------------------------------------------------------------------------- */
  /*                              MOSTRAR PRODUCTOS                             */
  /* -------------------------------------------------------------------------- */

  static public function mdlMostrarProductos($tabla, $item, $valor) {

    if ($item != null) {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");
      $stmt->bindParam(':'.$item, $valor, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetch();
    } else {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
      $stmt->execute();
      return $stmt->fetchAll();
    }

    $stmt->close();
    $stmt = null;

  }

  /* ------------------------ End of MOSTRAR PRODUCTOS ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                               CREAR PRODUCTO                               */
  /* -------------------------------------------------------------------------- */

  static public function mdlIngresoProducto($tabla, $datos) {

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idCategoria, codigo, descripcion, imagen, stock, precioCompra, precioVenta) VALUES (:idCategoria, :codigo, :descripcion, :imagen, :stock, :precioCompra, :precioVenta)");

    $stmt -> bindParam(':idCategoria', $datos['idCategoria'], PDO::PARAM_INT);
    $stmt->bindParam(':codigo', $datos['codigo'], PDO::PARAM_STR);
		$stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
    $stmt->bindParam(':imagen', $datos['imagen'], PDO::PARAM_STR);
		$stmt->bindParam(':stock', $datos['stock'], PDO::PARAM_STR);
		$stmt->bindParam(':precioCompra', $datos['precioCompra'], PDO::PARAM_STR);
		$stmt->bindParam(':precioVenta', $datos['precioVenta'], PDO::PARAM_STR);

    if ($stmt -> execute()) { return 'ok'; } else { return 'error'; }

    $stmt -> close();
    $stmt = null;

  }

  /* -------------------------- End of CREAR PRODUCTO ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                               EDITAR PRODUCTO                              */
  /* -------------------------------------------------------------------------- */

  static public function mdlEditarProducto($tabla, $datos) {

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idCategoria = :idCategoria, descripcion = :descripcion, imagen = :imagen, stock = :stock, precioCompra = :precioCompra, precioVenta = :precioVenta WHERE codigo = :codigo");
    $stmt->bindParam(':idCategoria', $datos['idCategoria'], PDO::PARAM_INT);
    $stmt->bindParam(':codigo', $datos['codigo'], PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
    $stmt->bindParam(':imagen', $datos['imagen'], PDO::PARAM_STR);
    $stmt->bindParam(':stock', $datos['stock'], PDO::PARAM_STR);
    $stmt->bindParam(':precioCompra', $datos['precioCompra'], PDO::PARAM_STR);
    $stmt->bindParam(':precioVenta', $datos['precioVenta'], PDO::PARAM_STR);

    if ($stmt->execute()) { return 'ok'; } else { return 'error'; }

    $stmt->close();
    $stmt = null;

  }

  /* ------------------------- End of EDITAR PRODUCTO ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                               BORRAR PRODUCTO                              */
  /* -------------------------------------------------------------------------- */

  static public function mdlEliminarProducto($tabla, $datos) {

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
    $stmt -> bindParam(':id', $datos, PDO::PARAM_INT);

    if ($stmt -> execute()) { return 'ok'; } else { return 'error'; }

    $stmt -> close();
    $stmt = null;

  }

  /* ------------------------- End of BORRAR PRODUCTO ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                             ACTUALIZAR PRODUCTO                            */
  /* -------------------------------------------------------------------------- */

  static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor) {

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");
    $stmt -> bindParam(':'.$item1, $valor1, PDO::PARAM_STR);
    $stmt -> bindParam(':id', $valor, PDO::PARAM_STR);

    if ($stmt -> execute()) { return 'ok'; } else { return 'error'; }

    $stmt -> close();
    $stmt = null;

    }

  /* ----------------------- End of ACTUALIZAR PRODUCTO ----------------------- */

  /* -------------------------------------------------------------------------- */
  /*                             MOSTRAR SUMA VENTAS                            */
  /* -------------------------------------------------------------------------- */

  static public function mdlMostrarSumaVentas($tabla) {
    $stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");
    $stmt -> execute();
    return $stmt -> fetch();
    $stmt -> close();
    $stmt = null;
  }

  /* ----------------------- End of MOSTRAR SUMA VENTAS ----------------------- */

}