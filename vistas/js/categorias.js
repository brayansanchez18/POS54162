/* -------------------------------------------------------------------------- */
/*                    CARGAR LA TABLA DINÁMICA DE PRODUCTOS                   */
/* -------------------------------------------------------------------------- */

// $.ajax({
//   url: 'ajax/gestorCategorias.ajax.php',
//   success:function(respuesta) {
//     console.log('%cMyProject%cline:7%crespuesta', 'color:#fff;background:#ee6f57;padding:3px;border-radius:2px', 'color:#fff;background:#1f3c88;padding:3px;border-radius:2px', 'color:#fff;background:rgb(1, 77, 103);padding:3px;border-radius:2px', respuesta)
//   }
// })

$('.tablaCategorias').DataTable( {
  "ajax": "ajax/gestorCategorias.ajax.php",
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

})

/* -------------- End of CARGAR LA TABLA DINÁMICA DE PRODUCTOS -------------- */

/* -------------------------------------------------------------------------- */
/*                          EVITAR REPETIR CATEGORIAS                         */
/* -------------------------------------------------------------------------- */

$(".nuevaCategoria").change(function() {

  $(".alert").remove();
  let categoria = $(this).val();

  let datos = new FormData();
  datos.append("validarcategoria", categoria);

  $.ajax({
    url:"ajax/categorias.ajax.php",
    method:"POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success:function(respuesta) {

      if (respuesta) {
        $(".nuevaCategoria").parent().after('<div class="alert alert-warning">Esta categoria ya existe, intente con un nombre diferente</div>');
        $(".nuevaCategoria").val("");
      }

    }

  })

});

/* -------------------- End of EVITAR REPETIR CATEGORIAS -------------------- */

/* -------------------------------------------------------------------------- */
/*                              EDITAR CATEGORIA                              */
/* -------------------------------------------------------------------------- */

$(".tablaCategorias").on("click", ".btnEditarCategoria", function() {

  let idCategoria = $(this).attr("idCategoria");

  let datos = new FormData();
  datos.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success: function(respuesta) {
      $("#editarCategoria").val(respuesta["categoria"]);
      $("#idCategoria").val(respuesta["id"]);
    }

  })

})

/* ------------------------- End of EDITAR CATEGORIA ------------------------ */

/* -------------------------------------------------------------------------- */
/*                             ELIMINAR CATEGORIA                             */
/* -------------------------------------------------------------------------- */

$(".tablaCategorias").on("click", ".btnEliminarCategoria", function() {

  let idCategoria = $(this).attr("idCategoria");

  Swal.fire({
    title: '¿Está seguro de borrar la categoría?',
    text: "Si no lo está puede cancelar la accíón",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar categoría'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
    }
  })

})

/* ------------------------ End of ELIMINAR CATEGORIA ----------------------- */