<?php

require_once 'conexion.php';

class ModeloVentas {

  /* -------------------------------------------------------------------------- */
  /*                               MOSTRAR VENTAS                               */
  /* -------------------------------------------------------------------------- */

  static public function mdlMostrarVentas($tabla, $item, $valor) {

    if ($item != null) {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");
      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
      $stmt -> execute();
      return $stmt -> fetch();
    } else {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");
      $stmt -> execute();
      return $stmt -> fetchAll();
    }

    $stmt -> close();
    $stmt = null;

  }

  /* -------------------------- End of MOSTRAR VENTAS ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              REGISTRO DE VENTA                             */
  /* -------------------------------------------------------------------------- */

  static public function mdlIngresarVenta($tabla, $datos) {

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, idCliente, idVendedor, productos, impuesto, neto, total, metodoPago) VALUES (:codigo, :idCliente, :idVendedor, :productos, :impuesto, :neto, :total, :metodoPago)");

    $stmt->bindParam(':codigo', $datos['codigo'], PDO::PARAM_INT);
    $stmt->bindParam(':idCliente', $datos['idCliente'], PDO::PARAM_INT);
    $stmt->bindParam(':idVendedor', $datos['idVendedor'], PDO::PARAM_INT);
    $stmt->bindParam(':productos', $datos['productos'], PDO::PARAM_STR);
    $stmt->bindParam(':impuesto', $datos['impuesto'], PDO::PARAM_STR);
    $stmt->bindParam(':neto', $datos['neto'], PDO::PARAM_STR);
    $stmt->bindParam(':total', $datos['total'], PDO::PARAM_STR);
    $stmt->bindParam(':metodoPago', $datos['metodoPago'], PDO::PARAM_STR);

    if ($stmt->execute()) { return 'ok'; } else { return 'error'; }

    $stmt->close();
    $stmt = null;

  }

  /* ------------------------ FIN DE REGISTRO DE VENTA ------------------------ */

}