<?php
$item = null;
$valor = null;
$orden = 'id';
$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
 ?>
 <div class="card">
  <div class="card-header">
    <h3 class="card-title">Productos Agregados Recientemente</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <ul class="products-list product-list-in-card pl-2 pr-2">

      <?php for ($i = 0; $i < 10; $i++): ?>
        <li class="item">
          <div class="product-img">
            <?php if ($productos[$i]['imagen'] != ''): ?>
              <img src="<?=$productos[$i]['imagen']?>" alt="<?=$productos[$i]['descripcion']?>" class="img-size-50">
            <?php else: ?>
              <img src="vistas/img/productos/default/anonymous.png" alt="<?=$productos[$i]['descripcion']?>" class="img-size-50">
            <?php endif ?>
          </div>
          <div class="product-info">
            <a class="product-title"><?=$productos[$i]['descripcion']?>
              <span class="badge badge-warning float-right">$<?=number_format($productos[$i]['precioVenta'],2)?></span>
            </a>
          </div>
        </li>
      <?php endfor ?>
    </ul>
  </div>
  <!-- /.card-body -->
  <div class="card-footer text-center">
    <a href="productos" class="uppercase">Ver todos los productos</a>
  </div>
  <!-- /.card-footer -->
</div>
<!-- /.card -->