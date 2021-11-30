/* -------------------------------------------------------------------------- */
/*             HACEMOS DINAMICA LA TABLA DE VENTAS EN CREAR VENTAS            */
/* -------------------------------------------------------------------------- */

// $.ajax({
//   url:'ajax/tablaProductosVentas.ajax.php',
//   success:function(respuesta) {
//     console.log('%cMyProject%cline:7%crespuesta', 'color:#fff;background:#ee6f57;padding:3px;border-radius:2px', 'color:#fff;background:#1f3c88;padding:3px;border-radius:2px', 'color:#fff;background:rgb(131, 175, 155);padding:3px;border-radius:2px', respuesta)
//   }
// })

$('.tablaVentas').DataTable( {
  "ajax": "ajax/tablaProductosVentas.ajax.php",
  "deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

	}

});

/* ------- End of HACEMOS DINAMICA LA TABLA DE VENTAS EN CREAR VENTAS ------- */

/* -------------------------------------------------------------------------- */
/*                           FORMATO AL PRECIO FINAL                          */
/* -------------------------------------------------------------------------- */

$(".itotal").number(true, 2);

/* --------------------- End of FORMATO AL PRECIO FINAL --------------------- */

/* -------------------------------------------------------------------------- */
/*             CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA            */
/* -------------------------------------------------------------------------- */

$('.tablaVentas').on('draw.dt', function() {

  if (localStorage.getItem('quitarProducto') != null) {

    let listaIdProductos = JSON.parse(localStorage.getItem('quitarProducto'));

    for (let i = 0; i < listaIdProductos.length; i++) {

      $("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
      $("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

    }

  }

})

/* ------- End of CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA ------- */

/* -------------------------------------------------------------------------- */
/*                AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA               */
/* -------------------------------------------------------------------------- */

$('.tablaVentas tbody').on('click', 'button.agregarProducto', function() {

  let idProducto = $(this).attr('idProducto');

  $(this).removeClass('btn-primary agregarProducto');
  $(this).addClass('btn-default');

  let datos = new FormData();
  datos.append('idProducto', idProducto);

  $.ajax({
    url:'ajax/productos.ajax.php',
    method:'POST',
    data:datos,
    cahe:false,
    contentType:false,
    processData:false,
    dataType:'json',
    success:function(respuesta) {

      let descripcion = respuesta['descripcion'];
      let stock = respuesta['stock'];
      let precio = respuesta['precioVenta'];

      /* -------------------------------------------------------------------------- */
      /*             EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO            */
      /* -------------------------------------------------------------------------- */

      if (stock == 0) {

        Swal.fire({
          title: "¡No hay stock!",
          text: "No hay stock disponible",
          icon: "error",
          confirmButtonText: "Cerrar",
          closeOnConfirm: false,
        })

        $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");
				return;

      }

      /* ------- End of EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO ------- */

      $('.nuevoProducto').append(
        '<div class="row" style="padding:5px 15px">'+
          '<div class="col-6" style="padding-right:0px">'+
            '<div class="input-group">'+
              '<div class="input-group-prepend">'+
                '<span class="input-group-text">'+
                  '<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button>'+
                '</span>'+
              '</div>'+

              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+
            '</div>'+
          '</div>'+

          '<div class="col-2">'+
            '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
          '</div>'+

          '<div class="col-4 ingresoPrecio" style="padding-left:0px">'+
            '<div class="input-group">'+
              '<div class="input-group-prepend">'+
                '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>'+
              '</div>'+

              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
            '</div>'+
          '</div>'+
        '</div>'
      );

      sumarTotalPrecios();
      agregarImpuesto();
      listarProductos();

      $(".nuevoPrecioProducto").number(true, 2);

    }

  })

})

/* ---------- End of AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA ---------- */

/* -------------------------------------------------------------------------- */
/*               QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN               */
/* -------------------------------------------------------------------------- */

let idQuitarProducto = [];

localStorage.removeItem('quitarProducto');

$('.formularioVenta').on('click', 'button.quitarProducto', function() {

  $(this).parent().parent().parent().parent().parent().remove();
  let idProducto = $(this).attr('idProducto');

  /* -------------------------------------------------------------------------- */
  /*          ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR          */
  /* -------------------------------------------------------------------------- */

  if (localStorage.getItem('quitarProducto') == null) {
    idQuitarProducto = [];
  } else {
    idProducto.concat(localStorage.getItem('quitarProducto'));
  }

  idQuitarProducto.push({'idProducto':idProducto});
  localStorage.setItem('quitarProducto', JSON.stringify(idQuitarProducto));

  /* ----- End of ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR ---- */

  $("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if ($(".nuevoProducto").children().length == 0) {

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);

	} else {

		sumarTotalPrecios();
		agregarImpuesto();
		listarProductos();

	}

})

/* ---------- End of QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN --------- */

/* -------------------------------------------------------------------------- */
/*                            MODIFICAR LA CANTIDAD                           */
/* -------------------------------------------------------------------------- */

$('.formularioVenta').on('change', 'input.nuevaCantidadProducto', function() {

  let precio = $(this).parent().parent().children('.ingresoPrecio').children().children('.nuevoPrecioProducto');

  let precioFinal = $(this).val() * precio.attr('precioReal');
  console.log('%cMyProject%cline:229%cprecioFinal', 'color:#fff;background:#ee6f57;padding:3px;border-radius:2px', 'color:#fff;background:#1f3c88;padding:3px;border-radius:2px', 'color:#fff;background:rgb(3, 38, 58);padding:3px;border-radius:2px', precioFinal)

  precio.val(precioFinal);

  let nuevoStock = Number($(this).attr('stock')) - $(this).val();

  $(this).attr('nuevoStock', nuevoStock);

  /* -------------------------------------------------------------------------- */
  /*       SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES       */
  /* -------------------------------------------------------------------------- */

  if (Number($(this).val() > Number($(this).attr('stock')))) {

    $(this).val(1);

    let precioFinal = $(this).val() * precio.attr('precioReal');

    precio.val(precioFinal);

    sumarTotalPrecios();

    Swal.fire({
      title: "¡No hay stock sufisiente!",
      text: "La cantidad supera el Stock, Sólo hay "+$(this).attr("stock")+" unidades!",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    })

    return;

  }

  /* -- End of SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES - */

  sumarTotalPrecios();
  agregarImpuesto();
  listarProductos();

})

/* ---------------------- End of MODIFICAR LA CANTIDAD ---------------------- */

/* -------------------------------------------------------------------------- */
/*                           SUMAR TODOS LOS PRECIOS                          */
/* -------------------------------------------------------------------------- */

function sumarTotalPrecios() {

  let precioItem = $('.nuevoPrecioProducto');
  let arraySumaPrecio = [];

  for (let i = 0; i < precioItem.length; i++) {
    arraySumaPrecio.push(Number($(precioItem[i]).val()));
  }

  function sumaArrayPrecios(total, numero) {
    return total + numero;
  }

  let sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

  $("#nuevoTotalVenta").val(sumaTotalPrecio);
  $("#totalVenta").val(sumaTotalPrecio);
  $("#nuevoTotalVenta").attr('total', sumaTotalPrecio);

}

/* --------------------- End of SUMAR TODOS LOS PRECIOS --------------------- */

/* -------------------------------------------------------------------------- */
/*                          FUNCIÓN AGREGAR IMPUESTO                          */
/* -------------------------------------------------------------------------- */

function agregarImpuesto() {

  let impuesto = $("#nuevoImpuestoVenta").val();
  let precioTotal = $("#nuevoTotalVenta").attr("total");
  let precioImpuesto = Number(precioTotal * impuesto/100);
  let totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

  $("#nuevoTotalVenta").val(totalConImpuesto);
  $("#totalVenta").val(totalConImpuesto);
  $("#nuevoPrecioImpuesto").val(precioImpuesto);
  $("#nuevoPrecioNeto").val(precioTotal);

}

/* --------------------- End of FUNCIÓN AGREGAR IMPUESTO -------------------- */

/* -------------------------------------------------------------------------- */
/*                          CUANDO CAMBIA EL IMPUESTO                         */
/* -------------------------------------------------------------------------- */

$("#nuevoImpuestoVenta").change(function() { agregarImpuesto(); });

/* -------------------- End of CUANDO CAMBIA EL IMPUESTO -------------------- */

/* -------------------------------------------------------------------------- */
/*                         SELECCIONAR MÉTODO DE PAGO                         */
/* -------------------------------------------------------------------------- */

$('#nuevoMetodoPago').change(function() {

  var metodo = $(this).val();

  if (metodo == 'Efectivo') {

    $(this).parent().parent().removeClass('col-6');
    $(this).parent().parent().addClass('col-4');

    $('.cajasMetodoPago').addClass('col-8');
    $('.cajasMetodoPago').addClass('d-flex');

    $(this).parent().parent().parent().children('.cajasMetodoPago').html(

    '<div class="col-6">'+
      '<div class="input-group">'+
        '<div class="input-group-prepend">'+
          '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>'+
        '</div>'+
        '<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="0" required>'+
      '</div>'+
    '</div>'+

    '<div class="col-6" id="capturarCambioEfectivo" style="padding-left:0px">'+
      '<div class="input-group">'+
        '<div class="input-group-prepend">'+
          '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>'+
        '</div>'+
        '<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="0" readonly required>'+
      '</div>'+
    '</div>');

    /* ------------------------ AGREGAR FORMATO AL PRECIO ----------------------- */

    $('#nuevoValorEfectivo').number( true, 2);
    $('#nuevoCambioEfectivo').number( true, 2);

    listarMetodos();

  } else {

    $(this).parent().parent().removeClass('col-4');
    $(this).parent().parent().addClass('col-6');

    $('.cajasMetodoPago').removeClass('col-8');
    $('.cajasMetodoPago').addClass('col-6');

    $(this).parent().parent().parent().children('.cajasMetodoPago').html(

    '<div class="col-12">'+
      '<div class="input-group">'+
        '<input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+

        '<div class="input-group-prepend">'+
          '<span class="input-group-text"><i class="fa fa-lock"></i></span>'+
        '</div>'+
      '</div>'+
    '</div>');

  }

});

/* -------------------- End of SELECCIONAR MÉTODO DE PAGO ------------------- */

/* -------------------------------------------------------------------------- */
/*                             CAMBIO EN EFECTIVO                             */
/* -------------------------------------------------------------------------- */

$('.formularioVenta').on('change', 'input#nuevoValorEfectivo', function() {

  let efectivo = $(this).val();
  let cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val());
  let nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

  nuevoCambioEfectivo.val(cambio);

})

/* ------------------------ End of CAMBIO EN EFECTIVO ----------------------- */

/* -------------------------------------------------------------------------- */
/*                             CAMBIO TRANSACCIÓN                             */
/* -------------------------------------------------------------------------- */

$('.formularioVenta').on('change', 'input#nuevoCodigoTransaccion', function() { listarMetodos(); })

/* ------------------------ End of CAMBIO TRANSACCIÓN ----------------------- */

/* -------------------------------------------------------------------------- */
/*                         LISTAR TODOS LOS PORDUCTOS                         */
/* -------------------------------------------------------------------------- */

function listarProductos() {

  let listaProductos = [];
  let descripcion = $(".nuevaDescripcionProducto");
  let cantidad = $(".nuevaCantidadProducto");
  let precio = $(".nuevoPrecioProducto");

  for(let i = 0; i < descripcion.length; i++){

    listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"),
                          "descripcion" : $(descripcion[i]).val(),
                          "cantidad" : $(cantidad[i]).val(),
                          "stock" : $(cantidad[i]).attr("nuevoStock"),
                          "precio" : $(precio[i]).attr("precioReal"),
                          "total" : $(precio[i]).val()})

  }

  $("#listaProductos").val(JSON.stringify(listaProductos));

}

/* -------------------- End of LISTAR TODOS LOS PORDUCTOS ------------------- */

/* -------------------------------------------------------------------------- */
/*                            LISTAR METODO DE PAGO                           */
/* -------------------------------------------------------------------------- */

function listarMetodos() {

  let listaMetodos = '';

  if ($('#nuevoMetodoPago').val() == 'Efectivo') {
    $('#listaMetodoPago').val('Efectivo');
  } else {
    $('#listaMetodoPago').val($('#nuevoMetodoPago').val()+'-'+$('#nuevoCodigoTransaccion').val());
  }

}

/* ---------------------- End of LISTAR METODO DE PAGO ---------------------- */

/* -------------------------------------------------------------------------- */
/*                                EDITAR VENTA                                */
/* -------------------------------------------------------------------------- */

$('.tablaAdministrarVentas').on('click', '.btnEditarVenta', function() {
  let idVenta = $(this).attr('idVenta');
  window.location = 'index.php?ruta=editar-venta&idVenta='+idVenta;
})

/* --------------------------- End of EDITAR VENTA -------------------------- */

/* -------------------------------------------------------------------------- */
/*                 FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR                */
/* -------------------------------------------------------------------------- */

function quitarAgregarProducto(){

  //Capturamos todos los id de productos que fueron elegidos en la venta
  let idProductos = $(".quitarProducto");

  //Capturamos todos los botones de agregar que aparecen en la tabla
  let botonesTabla = $(".tablaVentas tbody button.agregarProducto");

  //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
  for (let i = 0; i < idProductos.length; i++) {

    //Capturamos los Id de los productos agregados a la venta
    let boton = $(idProductos[i]).attr("idProducto");

    //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
    for (let j = 0; j < botonesTabla.length; j ++) {

      if ($(botonesTabla[j]).attr("idProducto") == boton) {
        $(botonesTabla[j]).removeClass("btn-primary agregarProducto");
        $(botonesTabla[j]).addClass("btn-default");
      }

    }

  }

}

/* ----------- End of FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR ----------- */

//##CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:##//

$('.tablaVentas').on( 'draw.dt', function() { quitarAgregarProducto(); })

/* -------------------------------------------------------------------------- */
/*                                BORRAR VENTA                                */
/* -------------------------------------------------------------------------- */

$(".tablaAdministrarVentas").on("click", ".btnEliminarVenta", function() {

  let idVenta = $(this).attr("idVenta");

  Swal.fire({
    title: '¿Está seguro de borrar la venta?',
    text: "Si no lo está puede cancelar la accíón",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar venta'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=administrar-ventas&idVenta="+idVenta;
    }
  })

})

/* --------------------------- End of BORRAR VENTA -------------------------- */

/* -------------------------------------------------------------------------- */
/*                              IMPRIMIR FACTURA                              */
/* -------------------------------------------------------------------------- */

$('.tablaAdministrarVentas').on('click', '.btnImprimirFactura', function() {
  let codigoVenta = $(this).attr('codigoVenta');
  window.open('extensiones/tcpdf/examples/factura.php?codigo='+codigoVenta, '_blank');
})

/* ------------------------- End of IMPRIMIR FACTURA ------------------------ */