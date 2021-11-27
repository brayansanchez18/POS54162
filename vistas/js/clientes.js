/* -------------------------------------------------------------------------- */
/*                    CARGAR LA TABLA DINAMICA DE CLIENTES                    */
/* -------------------------------------------------------------------------- */

// $.ajax({
// 	url: "ajax/gestorClientes.ajax.php",
// 	success:function(respuesta){
//     console.log('%cMyProject%cline:8%crespuesta', 'color:#fff;background:#ee6f57;padding:3px;border-radius:2px', 'color:#fff;background:#1f3c88;padding:3px;border-radius:2px', 'color:#fff;background:rgb(3, 38, 58);padding:3px;border-radius:2px', respuesta)
// 	}
// })

$('.tablaClientes').DataTable( {
  "ajax": "ajax/gestorClientes.ajax.php",
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

/* --------------- End of CARGAR LA TABLA DINAMICA DE CLIENTES -------------- */

/* -------------------------------------------------------------------------- */
/*                               EDITAR CLIENTE                               */
/* -------------------------------------------------------------------------- */

$('.tablaClientes').on('click', '.btnEditarCliente', function() {

	let idCliente = $(this).attr('idCliente');

	let datos = new FormData();
	datos.append('idCliente', idCliente);

	$.ajax({
		url:'ajax/clientes.ajax.php',
		method:'POST',
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:'json',
		success:function(respuesta) {
			$('#idCliente').val(respuesta['id']);
			$('#editarCliente').val(respuesta['nombre']);
			$('#editarEmail').val(respuesta['email']);
			$('#editarTelefono').val(respuesta['telefono']);
		}

	})

})

/* -------------------------- End of EDITAR CLIENTE ------------------------- */

/* -------------------------------------------------------------------------- */
/*                              ELIMINAR CLIENTE                              */
/* -------------------------------------------------------------------------- */

$('.tablaClientes').on('click', '.btnEliminarCliente', function() {

  let idCliente = $(this).attr('idCliente');

  Swal.fire({
    title: '¿Está seguro de borrar el cliente?',
    text: "Si no lo está puede cancelar la accíón",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar cliente'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=clientes&idCliente="+idCliente;
    }
  })

})

/* ------------------------- End of ELIMINAR CLIENTE ------------------------ */