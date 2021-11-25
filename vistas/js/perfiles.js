/* -------------------------------------------------------------------------- */
/*                        CARGAMOS LA TABLA DE PERFILES                       */
/* -------------------------------------------------------------------------- */

$(".tablaUsuarios").DataTable({

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

/* ------------------ End of CARGAMOS LA TABLA DE PERFILES ------------------ */

/* -------------------------------------------------------------------------- */
/*                        SUBIENDO LA FOTO DEL USUARIO                        */
/* -------------------------------------------------------------------------- */

$('.nuevaFoto').change(function() {

  var imagen = this.files[0];

  /* -------------------------------------------------------------------------- */
  /*               VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG              */
  /* -------------------------------------------------------------------------- */

  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

      $(".nuevaFoto").val("");

      Swal.fire({
        title: "¡ERROR!",
        text: "La imagen debe estar en formato JPG o PNG",
        icon: "error",
        confirmButtonText: "Cerrar",
        closeOnConfirm: false,
      })

    }

  /* --------- End of VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG --------- */

  /* -------------------------------------------------------------------------- */
  /*                      VALIDAMOS EL TAMAÑO DE LA IMAGEN                      */
  /* -------------------------------------------------------------------------- */

  else if(imagen["size"] > 5000000) {

    $(".nuevaFoto").val("");

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

    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event) {
      var rutaImagen = event.target.result;
      $(".previsualizar").attr("src", rutaImagen);
    })

    }

  /* -------------------- End of PREVISUALIZAMOS LA IMAGEN -------------------- */

})

/* ------------------- End of SUBIENDO LA FOTO DEL USUARIO ------------------ */