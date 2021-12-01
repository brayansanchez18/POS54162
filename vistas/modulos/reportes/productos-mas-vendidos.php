<?php

$item = null;
$valor = null;
$orden = 'ventas';

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

$colores = array('red','green','yellow','aqua','purple','blue','cyan','magenta','orange','gold');
$coloreshtml = array('#F11C1C','#27C538','#E7DD12','#12E793','#7012E7','#1239E7','#12E790','#DA1294','#DA5E12','#FFE400');

$totalVentas = ControladorProductos::ctrMostrarSumaVentas();
?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Productos más vendidos</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="row">
      <div class="col-md-8">
        <div class="chart-responsive">
          <canvas id="pieChart" height="150"></canvas>
        </div>
        <!-- ./chart-responsive -->
      </div>
      <!-- /.col -->
      <div class="col-md-4">
        <ul class="chart-legend clearfix">
          <?php for($i = 0; $i < 10; $i++): ?>
            <li><i class="fas fa-circle text-<?=$colores[$i]?>"></i> <?=$productos[$i]['descripcion']?></li>
          <?php endfor ?>
        </ul>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.card-body -->
  <div class="card-footer bg-light p-0">
    <ul class="nav nav-pills flex-column">

      <?php for ($i = 0; $i <5; $i++): ?>
        <li class="nav-item">
          <a class="nav-link">
            <?php if ($productos[$i]['imagen'] != ''): ?>
              <img src="<?=$productos[$i]['imagen']?>" class="img-thumbnail" width="60px" style="margin-right:10px">
            <?php else: ?>
              <img src="vistas/img/productos/default/anonymous.png" alt="<?=$productos[$i]['descripcion']?>" class="img-size-50">
            <?php endif ?>

            <?=$productos[$i]['descripcion']?>
          </a>
        </li>
      <?php endfor ?>
    </ul>
  </div>
  <!-- /.footer -->
</div>
<!-- /.card -->

<script>
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieData = {
    labels: [
    <?php for ($i=0; $i<6; $i++): ?>
      '<?=$productos[$i]['descripcion']?>',
    <?php endfor ?>
    ],
    datasets: [
      {
        data: [
          <?php for ($i=0; $i<6; $i++): ?>
            <?=$productos[$i]['ventas']?>,
          <?php endfor ?>
        ],
        backgroundColor: [
          <?php for ($i=0; $i<6; $i++): ?>
            '<?=$coloreshtml[$i]?>',
          <?php endfor ?>
          ]
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions
  })
</script>