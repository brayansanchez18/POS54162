<?php

require_once 'conexion.php';

class ModeloClientes {

  /* -------------------------------------------------------------------------- */
  /*                              MOSTRAR CLIENTES                              */
  /* -------------------------------------------------------------------------- */

  static public function mdlMostrarClientes($tabla, $item, $valor) {

    if ($item != null) {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
      $stmt -> bindParam(':'.$item, $valor, PDO::PARAM_STR);
      $stmt -> execute();
      return $stmt -> fetch();
    } else {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
      $stmt -> execute();
      return $stmt -> fetchAll();
    }

    $stmt -> close();
    $stmt = null;

  }

  /* ------------------------- End of MOSTRAR CLIENTES ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                                CREAR CLIENTE                               */
  /* -------------------------------------------------------------------------- */

  static public function mdlIngresarCliente($tabla, $datos) {

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, email, telefono) VALUES (:nombre, :email, :telefono)");
    $stmt -> bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
    $stmt -> bindParam(':email', $datos['email'], PDO::PARAM_STR);
    $stmt -> bindParam(':telefono', $datos['telefono'], PDO::PARAM_STR);

    if ($stmt -> execute()) { return 'ok'; } else { return 'error'; }

    $stmt -> close();
    $stmt = null;

  }

  /* -------------------------- End of CREAR CLIENTE -------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                               EDITAR CLIENTE                               */
  /* -------------------------------------------------------------------------- */

  static public function mdlEditarCliente($tabla, $datos) {

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, telefono = :telefono WHERE id = :id");
    $stmt->bindParam(':id', $datos['id'], PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
    $stmt->bindParam(':email', $datos['email'], PDO::PARAM_STR);
    $stmt->bindParam(':telefono', $datos['telefono'], PDO::PARAM_STR);

    if ($stmt->execute()) {	return 'ok'; } else { return 'error'; }

    $stmt->close();
		$stmt = null;

  }

  /* -------------------------- End of EDITAR CLIENTE ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              ELIMINAR CLIENTE                              */
  /* -------------------------------------------------------------------------- */

  static public function mdlEliminarCliente($tabla, $datos) {

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
    $stmt -> bindParam(':id', $datos, PDO::PARAM_INT);

    if ($stmt -> execute()) { return 'ok'; } else { return 'error'; }

    $stmt -> close();
    $stmt = null;

  }

  /* ------------------------- End of ELIMINAR CLIENTE ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                             ACTUALIZAR CLIENTE                             */
  /* -------------------------------------------------------------------------- */

  static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor) {

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");
    $stmt -> bindParam(':'.$item1, $valor1, PDO::PARAM_STR);
    $stmt -> bindParam(':id', $valor, PDO::PARAM_STR);

    if ($stmt -> execute()) { return 'ok'; } else { return 'error'; }

    $stmt -> close();
    $stmt = null;

  }

  /* ------------------------ End of ACTUALIZAR CLIENTE ----------------------- */

}