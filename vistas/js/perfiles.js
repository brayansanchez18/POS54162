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

  let imagen = this.files[0];

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

    let datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event) {
      let rutaImagen = event.target.result;
      $(".previsualizar").attr("src", rutaImagen);
    })

  }

  /* -------------------- End of PREVISUALIZAMOS LA IMAGEN -------------------- */

})

/* ------------------- End of SUBIENDO LA FOTO DEL USUARIO ------------------ */

/* -------------------------------------------------------------------------- */
/*                               ACTIVAR USUARIO                              */
/* -------------------------------------------------------------------------- */

$(document).on("click", ".btnActivar", function() {

  let idUsuario = $(this).attr("idUsuario");
  let estadoUsuario = $(this).attr("estadoUsuario");

  let datos = new FormData();
  datos.append("activarId", idUsuario);
  datos.append("activarUsuario", estadoUsuario);

  $.ajax({
    url:"ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta) {

      if (window.matchMedia("(max-width:767px)").matches) {

        Swal.fire({
          text: "El usuario ha sido actualizado",
          icon: "success",
          confirmButtonText: "Cerrar",
          closeOnConfirm: false,
        }).then((isConfirm) => {
          if (isConfirm) {
            window.location = "perfiles";
          }
        })

      }

    }

  })

  if (estadoUsuario == 0) {
    $(this).removeClass('btn-success');
    $(this).addClass('btn-danger');
    $(this).html('Desactivado');
    $(this).attr('estadoUsuario',1);
  } else {
    $(this).addClass('btn-success');
    $(this).removeClass('btn-danger');
    $(this).html('Activado');
    $(this).attr('estadoUsuario',0);
  }

})

/* ------------------------- End of ACTIVAR USUARIO ------------------------- */

/* -------------------------------------------------------------------------- */
/*                  REVISAR SI EL USUARIO YA ESTÁ REGISTRADO                  */
/* -------------------------------------------------------------------------- */

$("#nuevoUsuario").change(function() {

  $(".alert").remove();

  let usuario = $(this).val();

  let datos = new FormData();
  datos.append("validarUsuario", usuario);

  $.ajax({
    url:"ajax/usuarios.ajax.php",
    method:"POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success:function(respuesta) {

      if (respuesta) {
        $("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe, por favor intente con uno diferente</div>');
        $("#nuevoUsuario").val("");
      }

    }

})

})

/* ------------- End of REVISAR SI EL USUARIO YA ESTÁ REGISTRADO ------------ */

/* -------------------------------------------------------------------------- */
/*                               EDITAR USUARIO                               */
/* -------------------------------------------------------------------------- */

$(document).on("click", ".btnEditarUsuario", function() {

  let idUsuario = $(this).attr("idUsuario");

  let datos = new FormData();
  datos.append("idUsuario", idUsuario);

  $.ajax({
    url:"ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      $("#editarNombre").val(respuesta["nombre"]);
      $("#editarUsuario").val(respuesta["usuario"]);
      $("#editarPerfil").html(respuesta["perfil"]);
      $("#editarPerfil").val(respuesta["perfil"]);
      $("#fotoActual").val(respuesta["foto"]);
      $("#passwordActual").val(respuesta["pass"]);

      if (respuesta["foto"] != "") {
        $(".previsualizar").attr("src", respuesta["foto"]);
      } else {
        $(".previsualizar").attr("src", 'vistas/img/usuarios/default/anonymous.png');
      }

    }

  })

})

/* -------------------------- End of EDITAR USUARIO ------------------------- */

/* -------------------------------------------------------------------------- */
/*                              ELIMINAR USUARIO                              */
/* -------------------------------------------------------------------------- */

$(document).on("click", ".btnEliminarUsuario", function() {

  let idUsuario = $(this).attr("idUsuario");
  let fotoUsuario = $(this).attr("fotoUsuario");
  let usuario = $(this).attr("usuario");

  Swal.fire({
    title: '¿Está seguro de borrar el usuario?',
    text: "Si no lo está puede cancelar la accíón",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar usuario'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=perfiles&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
    }
  })

})

/* ------------------------- End of ELIMINAR USUARIO ------------------------ */