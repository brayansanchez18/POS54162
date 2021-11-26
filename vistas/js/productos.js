/* -------------------------------------------------------------------------- */
/*                    CARGAR LA TABLA DINÁMICA DE PRODUCTOS                   */
/* -------------------------------------------------------------------------- */

// $.ajax({
//   url: 'ajax/gestorProductos.ajax.php',
//   success:function(respuesta) {
//     console.log('%cMyProject%cline:7%crespuesta', 'color:#fff;background:#ee6f57;padding:3px;border-radius:2px', 'color:#fff;background:#1f3c88;padding:3px;border-radius:2px', 'color:#fff;background:rgb(217, 104, 49);padding:3px;border-radius:2px', respuesta)
//   }
// })

$('.tablaProductos').DataTable( {
  "ajax": "ajax/gestorProductos.ajax.php",
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

/* -------------- End of CARGAR LA TABLA DINÁMICA DE PRODUCTOS -------------- */

/* -------------------------------------------------------------------------- */
/*                 CAPTURAMOS LA CATEGORIA PARA ASIGNAR CODIGO                */
/* -------------------------------------------------------------------------- */

$('#nuevaCategoria').change(function() {

  let idCategoria = $(this).val();

	let datos = new FormData();
	datos.append('idCategoria', idCategoria);

  $.ajax({
    url:"ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta) {

      if (!respuesta) {
        let nuevoCodigo = idCategoria+'01';
        $('#nuevoCodigo').val(nuevoCodigo);
      } else {
        let nuevoCodigo = Number(respuesta['codigo'])+1;
        $('#nuevoCodigo').val(nuevoCodigo);
      }

    }

  })

})

/* ----------- End of CAPTURAMOS LA CATEGORIA PARA ASIGNAR CODIGO ----------- */

/* -------------------------------------------------------------------------- */
/*                          AGREGANDO PRECIO DE VENTA                         */
/* -------------------------------------------------------------------------- */

$('#nuevoPrecioCompra, #editarPrecioCompra').change(function() {

  if ($('.porcentaje').prop('checked')) {

    let valorPorcentaje = $('.nuevoPorcentaje').val();
    let porcentaje = Number(($('#nuevoPrecioCompra').val()*valorPorcentaje/100))+Number($('#nuevoPrecioCompra').val());
    let editarPorcentaje = Number(($('#editarPrecioCompra').val()*valorPorcentaje/100))+Number($('#editarPrecioCompra').val());

    $("#nuevoPrecioVenta").val(porcentaje);
    $("#nuevoPrecioVenta").prop("readonly",true);

    $("#editarPrecioVenta").val(editarPorcentaje);
    $("#editarPrecioVenta").prop("readonly",true);

  }

});

/* -------------------- End of AGREGANDO PRECIO DE VENTA -------------------- */

/* -------------------------------------------------------------------------- */
/*                            CAMBIO DE PORCENTAJE                            */
/* -------------------------------------------------------------------------- */

$('.nuevoPorcentaje').change(function() {

  if ($('.porcentaje').prop('checked')) {

    let valorPorcentaje = $(this).val();
    let porcentaje = Number(($('#nuevoPrecioCompra').val()*valorPorcentaje/100))+Number($('#nuevoPrecioCompra').val());
    let editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

    $("#nuevoPrecioVenta").val(porcentaje);
    $("#nuevoPrecioVenta").prop("readonly",true);

    $("#editarPrecioVenta").val(editarPorcentaje);
    $("#editarPrecioVenta").prop("readonly",true);

  }

})

$('.porcentaje').on('ifUnchecked',function() {
  $('#nuevoPrecioVenta').prop('readonly',false);
  $('#editarPrecioVenta').prop('readonly',false);
})

$('.porcentaje').on('ifChecked',function() {
  $('#nuevoPrecioVenta').prop('readonly',true);
  $('#editarPrecioVenta').prop('readonly',true);
})

/* ----------------------- End of CAMBIO DE PORCENTAJE ---------------------- */

/* -------------------------------------------------------------------------- */
/*                        SUBIENDO LA FOTO DEL PRODUCTO                       */
/* -------------------------------------------------------------------------- */

$('#nuevaImagen, .nuevaImagen').change(function() {

  let imagen = this.files[0];

  /* -------------------------------------------------------------------------- */
  /*             VALIDATOS QUE EL FORMATO DE LA IMGAEN SEA JPG O PNG            */
  /* -------------------------------------------------------------------------- */

  if (imagen['type'] != 'image/jpeg' && imagen['type'] != 'image/png') {

    $("#nuevaImagen").val("");

    Swal.fire({
      title: "¡ERROR!",
      text: "La imagen debe estar en formato JPG o PNG",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    })

  }

  /* ------- End of VALIDATOS QUE EL FORMATO DE LA IMGAEN SEA JPG O PNG ------- */

  /* -------------------------------------------------------------------------- */
  /*                      VALIDAMOS EL TAMAÑO DE LA IMAGEN                      */
  /* -------------------------------------------------------------------------- */

  else if(imagen["size"] > 5000000) {

    $("#nuevaImagen").val("");

    Swal.fire({
      title: "¡ERROR!",
      text: "La imagen no debe pesar más de 5MB",
      icon: "error",
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    })

  }

  /* ----------------- End of VALIDAMOS EL TAMAÑO DE LA IMAGEN ---------------- */

  /* -------------------------------------------------------------------------- */
  /*                          PREVISUALIZAMOS LA IMAGEN                         */
  /* -------------------------------------------------------------------------- */

  else {

  let datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event) {
      let rutaImagen = event.target.result;
      $(".previsualizar").attr("src", rutaImagen);
    })

  }

  /* -------------------- End of PREVISUALIZAMOS LA IMAGEN -------------------- */

})

/* ------------------ End of SUBIENDO LA FOTO DEL PRODUCTO ------------------ */

/* -------------------------------------------------------------------------- */
/*                               EDITAR PRODUCTO                              */
/* -------------------------------------------------------------------------- */

$('.tablaProductos tbody').on('click', 'button.btnEditarProducto', function() {

  let idProducto = $(this).attr('idProducto');

  let datos = new FormData();
  datos.append('idProducto', idProducto);

  $.ajax({
    url:'ajax/productos.ajax.php',
		method:'POST',
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',
		success:function(respuesta) {

      let datosCategoria = new FormData();
      datosCategoria.append("idCategoria",respuesta["idCategoria"]);

      $.ajax({
        url:"ajax/categorias.ajax.php",
        method: "POST",
        data: datosCategoria,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta) {
          $("#editarCategoria").val(respuesta["id"]);
          $("#editarCategoria").html(respuesta["categoria"]);
        }

      })

      $("#editarCodigo").val(respuesta["codigo"]);
      $("#editarDescripcion").val(respuesta["descripcion"]);
      $("#editarStock").val(respuesta["stock"]);
      $("#editarPrecioCompra").val(respuesta["precioCompra"]);
      $("#editarPrecioVenta").val(respuesta["precioVenta"]);

      if (respuesta["imagen"] != "") {

        $("#imagenActual").val(respuesta["imagen"]);
        $(".previsualizar").attr("src",  respuesta["imagen"]);

      } else { $(".previsualizar").attr("src", 'vistas/img/productos/default/anonymous.png'); }

    }

  })

})

/* ------------------------- End of EDITAR PRODUCTO ------------------------- */

/* -------------------------------------------------------------------------- */
/*                              ELIMINAR PRODUCTO                             */
/* -------------------------------------------------------------------------- */

$('.tablaProductos tbody').on('click', 'button.btnEliminarProducto', function() {

  var idProducto = $(this).attr("idProducto");
  var codigo = $(this).attr("codigo");
  var imagen = $(this).attr("imagen");

  Swal.fire({
    title: '¿Está seguro de borrar el producto?',
    text: "Si no lo está puede cancelar la accíón",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar producto'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;
    }
  })

})

/* ------------------------ End of ELIMINAR PRODUCTO ------------------------ */