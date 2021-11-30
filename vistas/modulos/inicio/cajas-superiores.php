<?php

$item = null;
$valor = null;
$orden = 'id';

$ventas = ControladorVentas::ctrSumaTotalVentas();

$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
$totalCategorias = count($categorias);

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes);

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

?>
<div class="col-lg-3 col-md-6 col-12">
  <!-- small box -->
  <div class="small-box bg-info">
    <div class="inner">
      <h3><?=number_format($ventas['total'],2)?></h3>

      <p>Ventas</p>
    </div>
    <div class="icon">
      <i class="fas fa-dollar-sign"></i>
    </div>
    <a href="administrar-ventas" class="small-box-footer">Más info. <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-md-6 col-12">
  <!-- small box -->
  <div class="small-box bg-success">
    <div class="inner">
      <h3><?=number_format($totalCategorias)?></h3>

      <p>Categorías</p>
    </div>
    <div class="icon">
      <i class="far fa-clipboard"></i>
    </div>
    <a href="categorias" class="small-box-footer">Más info. <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-md-6 col-12">
  <!-- small box -->
  <div class="small-box bg-warning">
    <div class="inner">
      <h3><?=number_format($totalClientes)?></h3>

      <p>Clientes</p>
    </div>
    <div class="icon">
      <i class="fas fa-user-plus"></i>
    </div>
    <a href="clientes" class="small-box-footer">Más info. <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-md-6 col-12">
  <!-- small box -->
  <div class="small-box bg-danger">
    <div class="inner">
      <h3><?=number_format($totalProductos)?></h3>

      <p>Productos</p>
    </div>
    <div class="icon">
      <i class="fas fa-boxes"></i>
    </div>
    <a href="productos" class="small-box-footer">Más info. <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->